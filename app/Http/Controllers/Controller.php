<?php

namespace App\Http\Controllers;
use App\Models\Push;

abstract class Controller
{
    public function sendSms($num,$msg,$temp_id = null)
    {
    	$msg = urlencode($msg);
    	$url = getSetting()->sms_api;
    	$url = str_replace(['{num}','{msg}','{other}'],[$num,$msg,$temp_id], $url);

    	$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec ($ch);
		$info = curl_getinfo($ch);
		$http_result = $info ['http_code'];
		curl_close ($ch);
    }

	function sendPush($title, $description, $uid = 0, $filename = null)
	{
		if($uid > 0)
		{
			$push 			= new Push;
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
