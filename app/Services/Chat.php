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
		$info   		= $data['user_info'] ?? [];
        $userName   	= $info['name']   ?? 'Not Provided';
        $dob        	= $info['dob']    ?? 'Not Provided';
        $tob        	= $info['tob']    ?? 'Not Provided';
        $pob        	= $info['pob']    ?? 'Not Provided';
        $userGender 	= $info['gender'] ?? 'Not Provided';
        $topic      	= $data['topic'] ?? 'general life guidance';
		$user 			= Auth::user();

		$currentDate = date('l, F j, Y');
		$currentYear = date('Y');
		$dateStr     = date('Y-m-d H:i:s') . " (Current Year: {$currentYear})";

		$systemPrompt = str_replace(
			['{{user_name}}','{{dob}}','{{tob}}','{{pob}}','{{user_gender}}','{{astro_name}}','{{astro_gender}}','{{astro_lang}}','{date}'],
			[$userName, $dob, $tob, $pob, $userGender, $astro->name ?? 'Astrologer', $astro->gender ?? 'Male', $astro->language ?? 'Hindi + English', $dateStr],
			$promptTemplate
		);

		$temporalNotice = "CURRENT REAL-TIME CONTEXT:\n"
			. "- Today's Date: {$currentDate}\n"
			. "- Current Year: {$currentYear}\n"
			. "- IMPORTANT: The current year is {$currentYear}. All astrological predictions, career/job timings, planetary transits, dasha analysis, and future events MUST be calculated strictly starting from {$currentDate} ({$currentYear}) and upcoming future years ({$currentYear}, " . ($currentYear + 1) . ", " . ($currentYear + 2) . ", etc.).\n"
			. "- NEVER give predictions or event timings in past years (such as 2023, 2024, or 2025).\n\n";

		$systemPrompt = $temporalNotice . $systemPrompt;
		
		$firstUserMessage = "My name is {$userName}. My date of birth is {$dob}, "
            . "time {$tob}, place {$pob}. "
            . "I want guidance related to {$topic}. Please guide me step by step and ask me questions if needed.";

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

		$astroReply = null;
		try {
			$setting = Setting::first();
			if ($setting && !empty($setting->open_ai_key)) {
				$response = Http::withToken($setting->open_ai_key)->timeout(30)->post('https://api.openai.com/v1/chat/completions', [
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
				$astroReply = $response->json('choices.0.message.content') ?? null;
			}
		} catch (\Exception $e) {
			\Log::error('Chat Service startChat error: ' . $e->getMessage());
		}

		if (!$astroReply) {
			$astroReply = "Namaste {$userName} ji 🙏 | Main aapki janam kundli ko dekh kar aapke sawalon ka jawab dene ke liye taiyar hoon |";
		}

        ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender'          => 'astrologer',
            'message'         => $astroReply,
        ]);

        return response()->json([
            'session_id' 		=> $session->id,
            'astrologer_reply' 	=> $astroReply,
        ]);
    }

    public function sendMsg($data)
    {
		$sessionId = $data['session_id'] ?? null;
		if (!$sessionId) {
			return response()->json(['error' => 'Session ID required'], 400);
		}

		$session = ChatSession::with('messages')->find($sessionId);
		if (!$session) {
			return response()->json(['error' => 'Chat session not found'], 404);
		}

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

		$astro = Astrologer::find($session->astrologer_id);
		$user  = Auth::user();
		$info  = $user && $user->info ? (is_array($user->info) ? $user->info : json_decode($user->info, true)) : [];

		$userName   = $info['name']   ?? $user->name ?? 'User';
		$dob        = $info['dob']    ?? '';
		$tob        = $info['tob']    ?? '';
		$pob        = $info['pob']    ?? '';
		$userGender = $info['gender'] ?? '';

		$currentDate = date('l, F j, Y');
		$currentYear = date('Y');
		$dateStr     = date('Y-m-d H:i:s') . " (Current Year: {$currentYear})";

		$promptTemplate = getPromp('chat');
		$systemPrompt   = str_replace(
			['{{user_name}}','{{dob}}','{{tob}}','{{pob}}','{{user_gender}}','{{astro_name}}','{{astro_gender}}','{{astro_lang}}','{date}'],
			[$userName, $dob, $tob, $pob, $userGender, $astro->name ?? 'Astrologer', $astro->gender ?? 'Male', $astro->language ?? 'Hindi + English', $dateStr],
			$promptTemplate
		);

		$temporalNotice = "CURRENT REAL-TIME CONTEXT:\n"
			. "- Today's Date: {$currentDate}\n"
			. "- Current Year: {$currentYear}\n"
			. "- IMPORTANT: The current year is {$currentYear}. All astrological predictions, career/job timings, planetary transits, dasha analysis, and future events MUST be calculated strictly starting from {$currentDate} ({$currentYear}) and upcoming future years ({$currentYear}, " . ($currentYear + 1) . ", " . ($currentYear + 2) . ", etc.).\n"
			. "- NEVER give predictions or event timings in past years (such as 2023, 2024, or 2025).\n\n";

		$systemPrompt = $temporalNotice . $systemPrompt;

		$messages = [];
		$messages[] = [
			'role' 	  => 'system',
			'content' => $systemPrompt,
		];

		$history = $session->messages()->orderBy('id', 'desc')->limit(12)->get()->reverse();

		foreach ($history as $msg) {
			$messages[] = [
				'role'    => $msg->sender === 'user' ? 'user' : 'assistant',
				'content' => $msg->message,
			];
		}

		$astroReply = null;
		try {
			$setting = Setting::first();
			if ($setting && !empty($setting->open_ai_key)) {
				$response = Http::withToken($setting->open_ai_key)->timeout(45)->post('https://api.openai.com/v1/chat/completions', [
					'model' => 'gpt-4o',
					'messages' => $messages,
					'temperature' => 0.7,
					'max_tokens'  => 700,
				]);
				$astroReply = $response->json('choices.0.message.content') ?? null;
			}
		} catch (\Exception $e) {
			\Log::error('Chat Service sendMsg error: ' . $e->getMessage());
		}

		if (!$astroReply) {
			$astroReply = "Ji {$userName} ji | Main aapki kundli dekh kar batana chahti hoon | Kripya thoda vistar se batayein |";
		}

		ChatMessage::create([
			'chat_session_id' => $session->id,
			'sender'          => 'astrologer',
			'message'         => $astroReply,
		]);

		return response()->json(['message' => $astroReply, 'balance' => User::find(Auth::user()->id)->wallet ?? 0]);
    }

    public function chatEnd($data)
    {
		$sessionId = $data['session_id'] ?? null;
		if (!$sessionId) {
			return response()->json(['message' => 'Session ID required', 'status' => 'ended'], 200);
		}

        $session = ChatSession::with('messages')->find($sessionId);
		if (!$session) {
			return response()->json(['message' => 'Session not found', 'status' => 'ended'], 200);
		}

		if ($session->status !== 'active') {
			return response()->json([
				'message'       => 'Chat session already ended',
				'status'        => 'ended',
				'total_seconds' => $session->total_seconds,
				'summary'       => $session->summary,
			], 200);
		}

		try {
			$session->billUser();
		} catch (\Exception $e) {
			\Log::warning('Chat Service chatEnd billing error: ' . $e->getMessage());
		}

		$startTime 		= $session->created_at ?? now();
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
		try {
			$setting = Setting::first();
			if ($setting && !empty($setting->open_ai_key) && count($summaryMessages) > 1) {
				$response = Http::withToken($setting->open_ai_key)
					->timeout(12)
					->post('https://api.openai.com/v1/chat/completions', [
						'model' => 'gpt-4o',
						'messages' => $summaryMessages,
						'temperature' => 0.3,
						'max_tokens' => 200,
					]);
				$summary = $response->json('choices.0.message.content') ?? null;
			}
		} catch (\Exception $e) {
			\Log::warning('Chat Service chatEnd summary error: ' . $e->getMessage());
		}

		if (!$summary) {
			$summary = 'Astrology consultation session completed successfully.';
		}

		$session->update([
			'status'        => 'ended',
			'ended_at'      => $endTime,
			'total_seconds' => $totalSeconds,
			'summary'       => $summary,
		]);

		try {
			$astro = Astrologer::find($session->astrologer_id);
			if ($astro && Auth::check()) {
				$push = new Push;
				$push->sendPush("Chat ended 💬", "Your chat with {$astro->name} has ended. Have a good day 🎉", Auth::id());
			}
		} catch (\Exception $e) {
			\Log::warning('Chat Service chatEnd push error: ' . $e->getMessage());
		}

		return response()->json([
			'message'       => 'Chat session ended successfully',
			'status'        => 'ended',
			'total_seconds' => $totalSeconds,
			'summary'       => $summary,
		], 200);
    }
}
