<?php namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Setting;
use App\Models\Astrologer;
use App\Models\User;
use DB;
use Validator;
use Redirect;
use Stripe;
use Mail;
use Str;
use Log;
use Twilio\Rest\Client;

class AuthController extends Controller {
	
	public function login(Request $Request)
    {
        $country = preg_replace('/[^0-9]/', '', (string)$Request->get('country'));
        $phone   = preg_replace('/[^0-9]/', '', (string)$Request->get('phone'));

        if (empty($phone)) {
            return response()->json(['msg' => 'error', 'error' => 'Phone number is required.'], 422);
        }

        // Clean unverified draft records
        User::where('country', $country)->where('phone', $phone)->where('status', 0)->delete();

        // Find active user if exists
        $res = User::where('country', $country)->where('phone', $phone)->where('status', 1)->first();
        $setting = getSetting();

        if (!isset($res->id))
        {
            $res              = new User;
            $res->id          = (string)(time() . rand(1111, 99999));
            $res->country     = $country;
            $res->phone       = $phone;
            $res->free_minute = $setting ? (float)$setting->free_chat_minute : 5;
            $res->status      = 0;
            $res->vcode       = rand(1000, 9999);
            $res->save();
        }
       
        if ($setting && $setting->verify_type == 1)
        {
            $res->status = 1;
            $res->vcode  = 0;
            $res->save();
            
            $token = $res->createToken($res->phone ?: 'auth_token')->plainTextToken;

            return response()->json([
                'msg'       => 'done',
                'user_data' => [
                    'id'    => $res->id,
                    'name'  => $res->name,
                    'phone' => $res->country . $res->phone
                ],
                'token'     => $token
            ]);
        }
        else
        {
            try {
                $this->sendOtp($res, $setting);

                return response()->json([
                    'msg'     => 'otp',
                    'user_id' => $res->id,
                    'phone'   => $res->country . $res->phone
                ]);
            } catch (\Exception $e) {
                Log::error('Twilio/SMS sendOtp error in login: ' . $e->getMessage());
                return response()->json([
                    'msg'   => 'error',
                    'error' => 'Failed to send OTP SMS: ' . $e->getMessage()
                ], 500);
            }
        }
    }

    public function resendCode(Request $Request)
    {
        $userId = $Request->get('user_id');
        $res = User::find($userId);

        if (!$res) {
            return response()->json(['msg' => 'error', 'error' => 'User not found.'], 404);
        }

        $setting = getSetting();

        try {
            $this->sendOtp($res, $setting);
            return response()->json([
                'msg'     => 'otp',
                'user_id' => $res->id,
                'phone'   => $res->country . $res->phone
            ]);
        } catch (\Exception $e) {
            Log::error('Twilio/SMS sendOtp error in resendCode: ' . $e->getMessage());
            return response()->json([
                'msg'   => 'error',
                'error' => 'Failed to resend OTP: ' . $e->getMessage()
            ], 500);
        }
    }

    public function verifyCode(Request $request)
    {
        $userId = $request->get('user_id');
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'msg'   => 'error',
                'error' => 'User not found'
            ], 404);
        }

        $submittedCode = trim((string)$request->get('vcode'));
        $storedCode    = (string)(int)$user->vcode;

        // Verify OTP matches
        if (empty($user->vcode) || $submittedCode !== $storedCode) {
            return response()->json([
                'msg'   => 'error',
                'error' => 'Invalid OTP code. Please try again.'
            ], 401);
        }

        // OTP is valid
        $user->status = 1;
        $user->vcode  = 0;
        $user->save();

        // Web login if needed
        if ($request->get('is_web')) {
            Auth::login($user);
        }

        // Create API token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'msg'       => 'done',
            'user_data' => [
                'id'    => $user->id,
                'name'  => $user->name,
                'phone' => $user->country . $user->phone
            ],
            'token' => $token
        ]);
    }

    public function sendOtp($res, $setting)
    {
        $otp = random_int(1000, 9999);
        $res->vcode = $otp;
        $res->save();

        if ($setting && $setting->verify_type == 2)
        {
            if (empty($setting->t_sid) || empty($setting->t_auth) || empty($setting->t_from)) {
                throw new \Exception('Twilio credentials (SID, Auth Token, or From number) are missing in Settings.');
            }

            $client = new Client($setting->t_sid, $setting->t_auth);
            $cleanCountry = preg_replace('/[^0-9]/', '', (string)$res->country);
            $cleanPhone   = preg_replace('/[^0-9]/', '', (string)$res->phone);
            $toPhone      = "+" . $cleanCountry . $cleanPhone;

            $client->messages->create($toPhone, [
                'from' => $setting->t_from,
                'body' => 'Your OTP is ' . $otp . '. Please use it to verify your mobile number.'
            ]);
        }
        else if ($setting && $setting->verify_type == 3 && !empty($setting->other_sms_api))
        {
            $msg = 'Your OTP is ' . $otp . '. Please use it to verify your mobile number.';
            $msg = urlencode($msg);
            $url = $setting->other_sms_api;
            $url = str_replace(['{num}', '{msg}', '{other}'], [$res->phone, $msg, ""], $url);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $output = curl_exec($ch);
            curl_close($ch);
        }

        return true;
    }
}

