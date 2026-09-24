<?php
namespace App\Services;

use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Setting;
use App\Models\Astrologer;
use App\Models\Category;
use App\Models\ChatSession;
use App\Models\User;
use App\Services\Push;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class Chat
{
    public function startChat($data)
    {
        $astro  		= Astrologer::find($data['astro_id']);
		$promptTemplate = getPromp('chat');
		$info   		= $data['user_info'];
        $userName   	= $info['name']   ?? 'Not Provided';
        $dob        	= $info['dob']    ?? 'Not Provided';
        $tob        	= $info['tob']    ?? 'Not Provided';
        $pob        	= $info['pob']    ?? 'Not Provided';
        $userGender 	= $info['gender'] ?? 'Not Provided';
        $topic      	= $data['topic'] ?? 'general life guidance';
		$user 			= Auth::user();

		$systemPrompt = str_replace(['{{user_name}}','{{dob}}','{{tob}}','{{pob}}','{{user_gender}}','{{astro_name}}','{{astro_gender}}','{{astro_lang}}'],
        [$userName,$dob,$tob,$pob,$userGender,$astro->name,$astro->gender,$astro->language],$promptTemplate);
		
			$firstUserMessage = "My name is {$userName}. My date of birth is {$dob}, "
            . "time {$tob}, place {$pob}. "
            . "I want guidance related to {$topic}.Please guide me step by step and ask me questions if needed.";

		$session = ChatSession::create([
            'user_id'         => auth()->id(),
            'astrologer_id'   => $astro->id,
            'rate_per_minute' => $astro->cost_per_minute,
            'status'          => 'active',
            'started_at'      => now(),
            'last_billed_at'  => now(),
        ]);

		$session->startChatBilling();

		ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender'          => 'user',
            'message'         => $firstUserMessage,
        ]);

		$response = Http::withToken(Setting::first()->open_ai_key)->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => $systemPrompt,
                    ],
                    [
                        'role' => 'user',
                        'content' => $firstUserMessage,
                    ],
                ],
                'temperature' => 0.7,
                'max_tokens'  => 300,
        ]);
	
		$astroReply = $response['choices'][0]['message']['content'] ?? null;

        if ($astroReply) {
            ChatMessage::create([
                'chat_session_id' => $session->id,
                'sender'          => 'astrologer',
                'message'         => $astroReply,
            ]);
        }

        return response()->json([
            'session_id' 		=> $session->id,
            'astrologer_reply' 	=> $astroReply,
        ]);
    }

    public function sendMsg($data)
    {
		$session = ChatSession::with('messages')->findOrFail($data['session_id']);

		if ($session->status !== 'active') {
			return response()->json(['error' => 'Chat session ended'], 400);
		}

		if (!$session->billUser()) {
		return response()->json([
			'error' => 'Insufficient wallet balance. Chat ended.'
		], 402);
		}

		ChatMessage::create([
			'chat_session_id' => $session->id,
			'sender'          => 'user',
			'message'         => $data['message'],
		]);

		$messages = [];

		$messages[] = [
        'role' 		=> 'system',
        'content'	 => getPromp('chat'),
    	];

		$history = $session->messages()->orderBy('id', 'desc')->limit(12)->get()->reverse();

		foreach ($history as $msg) {
			$messages[] = [
				'role'    => $msg->sender === 'user' ? 'user' : 'assistant',
				'content' => $msg->message,
			];
		}

		$response = Http::withToken(Setting::first()->open_ai_key)->post('https://api.openai.com/v1/chat/completions', [
				'model' => 'gpt-4o',
				'messages' => $messages,
				'temperature' => 0.7,
				'max_tokens'  => 700,
			]);

		$astroReply = $response['choices'][0]['message']['content'] ?? null;

		if ($astroReply) {
			ChatMessage::create([
				'chat_session_id' => $session->id,
				'sender'          => 'astrologer',
				'message'         => $astroReply,
			]);
		}

		return response()->json(['message' => $astroReply,'balance' => User::find(Auth::user()->id)->wallet]);
    }

    public function chatEnd($data)
    {
        $session = ChatSession::with('messages')->findOrFail($data['session_id']);
		$session->billUser();
		
		if ($session->status !== 'active') {
			return response()->json([
				'message' => 'Chat session already ended'
			], 400);
		}

		$startTime 		= $session->created_at;
		$endTime   		= now();
		$totalSeconds 	= $startTime->diffInSeconds($endTime);

		$summaryMessages = [];

		foreach ($session->messages as $msg) {
			$summaryMessages[] = [
				'role' => $msg->sender === 'user' ? 'user' : 'assistant',
				'content' => $msg->message,
			];
		}

		
		array_unshift($summaryMessages, [
			'role' => 'system',
			'content' =>
				'Summarize this astrology chat in 4 to 6 short lines. ' .
				'Plain text only. No markdown. No emojis. No symbols. ' .
				'Do not give predictions. Just summarize discussion and guidance.'
		]);

		$summary = null;

		$response = Http::withToken(Setting::first()->open_ai_key)
				->post('https://api.openai.com/v1/chat/completions', [
					'model' => 'gpt-4o',
					'messages' => $summaryMessages,
					'temperature' => 0.3,
					'max_tokens' => 200,
		]);

		$summary = $response['choices'][0]['message']['content'];

		$session->update([
			'status'        => 'ended',
			'ended_at'      => $endTime,
			'total_seconds' => $totalSeconds,
			'summary'       => $summary,
		]);

		$astro = Astrologer::find($session->astrologer_id);

		$push = new Push;
		$push->sendPush("Chat ended 💬","Your chat with {$astro->name} has been ended. have a good day 🎉",Auth::id());

		return response()->json([
			'message'        => 'Chat session ended successfully',
			'total_seconds' => $totalSeconds,
			'summary'       => $summary,
		]);
    }
}
