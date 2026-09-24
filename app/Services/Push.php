<?php
namespace App\Services;

use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Setting;
use App\Models\Astrologer;
use App\Models\Category;
use App\Models\ChatSession;
use App\Models\Push as PushNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class Push
{
    function sendPush($title, $description, $uid = 0, $filename = null)
	{
		if($uid > 0)
		{
			$push 			= new PushNotification;
			$push->user_id 	= $uid;
			$push->title 	= $title;
			$push->text 	= $description;
			$push->save();
		}
		
		$appId = getSetting()->push_user_app_id;   
		$restKey = trim(getSetting()->push_user_reset_id);

		$content = ['en' => $description];
		$headings = ['en' => $title];

		$payload = [
			'app_id' => $appId,
			'contents' => $content,
			'headings' => $headings,
			'data' => ['foo' => 'bar'],
			'priority' => 10,
			'content_available' => true
		];

		if ($uid > 0) {
			$payload['filters'] = [
				[
					'field' => 'tag',
					'key' => 'user_id',
					'relation' => '=',
					'value' => (string)$uid
				]
			];
		} else {
			$payload['included_segments'] = ['All'];
		}

		if ($filename) {
			$url = asset('upload/push/'.$filename); 
			$payload['big_picture'] = $url;
			$payload['ios_attachments'] = $url;
		}

		$ch = curl_init();
		curl_setopt_array($ch, [
			CURLOPT_URL => "https://onesignal.com/api/v1/notifications",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => json_encode($payload),
			CURLOPT_HTTPHEADER => [
				"Authorization: Key $restKey",
				"Content-Type: application/json"
			],
			CURLOPT_SSL_VERIFYPEER => false
		]);

		$response = curl_exec($ch);
		$err = curl_error($ch);
		curl_close($ch);

		if ($err) {
			return "cURL Error #: " . $err;
		}

	
		return $response;
	}
}
