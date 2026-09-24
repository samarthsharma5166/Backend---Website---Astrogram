<?php namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use App\Models\Setting;
use App\Models\Astrologer;
use App\Models\Category;
use App\Models\ChatMessage;
use App\Models\ChatSession;
use App\Models\User;
use App\Services\Chat;
use DB;
use Validator;
use Redirect;
use Stripe;
use Mail;
use Str;
class ChatController extends Controller {
	
	public function startChat(Request $Request)
    {
        $astro  		= Astrologer::find($Request->get('astro_id'));
		$promptTemplate = getPromp('chat');
		$info   		= $Request->get('user_info');
        $userName   	= $info['name']   ?? 'Not Provided';
        $dob        	= $info['dob']    ?? 'Not Provided';
        $tob        	= $info['tob']    ?? 'Not Provided';
        $pob        	= $info['pob']    ?? 'Not Provided';
        $userGender 	= $info['gender'] ?? 'Not Provided';
        $topic      	= $Request->get('topic') ?? 'general life guidance';
		$user 			= Auth::user();

		$systemPrompt = str_replace(['{{user_name}}','{{dob}}','{{tob}}','{{pob}}','{{user_gender}}','{{astro_name}}','{{astro_gender}}','{{astro_lang}}','{date}'],
        [$userName,$dob,$tob,$pob,$userGender,$astro->name,$astro->gender,$astro->language,date('Y-m-d H:i:s')],$promptTemplate);
		
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

	public function sendMessage(Request $Request)
	{
		$Request->validate([
			'session_id' => 'required|exists:chat_sessions,id',
			'message'    => 'required|string',
		]);

		$session = ChatSession::with('messages')->findOrFail($Request->session_id);

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
			'message'         => $Request->message,
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

	public function chatEnd(Request $request)
	{
		$session = ChatSession::with('messages')->findOrFail($request->session_id);
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

        $this->sendPush("Chat ended 💬","Your chat with ".$astro->name." has been ended. have a good day 🎉",Auth::user()->id);

		return response()->json([
			'message'        => 'Chat session ended successfully',
			'total_seconds' => $totalSeconds,
			'summary'       => $summary,
		]);
	}

	public function history()
	{
		$res = ChatSession::join('astrologer','chat_sessions.astrologer_id','=','astrologer.id')
						  ->select('astrologer.name as astro_name','astrologer.img','chat_sessions.*')
						  ->where('chat_sessions.user_id',Auth::user()->id)
						  ->orderBy('chat_sessions.id','DESC')
						  ->get();

		$data = [];

		foreach($res as $row)
		{
			$data[] = [

			'session_id' => $row->id,
			'astro_name' => $row->astro_name,
			'img'		 => Asset('upload/astrologer/'.$row->img),
			'date'	 	 => $row->created_at->format('d M,Y h:i:A'),
			'status'	 => $row->status,
			'minute'	 => $row->status == "ended" ? $this->formatSecondsToMinute($row->total_seconds) : null,
			'summary'	 => $row->summary 

			];
		}

		return response()->json(['data' => $data]);
	}

	public function sessionHistory(Request $request)
	{
		$sessionId  = $request->query('session_id');
		$res 		= ChatMessage::where('chat_session_id', $sessionId)->orderBy('id')->get();
		$session 	= ChatSession::find($sessionId);
		$output 	= [];

		foreach ($res as $row) {

			$parts = array_filter(array_map('trim', explode('|', $row->message)));

			foreach ($parts as $text) {
				$output[] = [
					'id' 			=> $row->id,
					'message'      	=> $text,
					'sender'    	=> $row->sender,
					'created_at'	=> $row->created_at?->format('h:i A'),
				];
			}
		}

    return response()->json(['data' => $output,'session_started_at' => $session->started_at]);
	}

	private function formatSecondsToMinute($seconds): string
	{
		if (!$seconds || $seconds <= 0) {
			return '0:00';
		}

		$minutes = floor($seconds / 60);
		$remainingSeconds = $seconds % 60;

		return sprintf('%d:%02d', $minutes, $remainingSeconds);
	}

    
}
