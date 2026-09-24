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
use Twilio\Rest\Client;
class AuthController extends Controller {
	
	public function login(Request $Request)
    {
        User::where('country',$Request->get('country'))->where('phone',$Request->get('phone'))->where('status',0)->delete();

        $res        = User::where('country',$Request->get('country'))->where('phone',$Request->get('phone'))->where('status',1)->first();
        $setting    = getSetting();

        if(!isset($res->id))
        {
            $otp                    = rand(1111,9999);
            $res                    = new User;
            $res->id                = time().rand(1111,99999);
            $res->country           = $Request->get('country');
            $res->phone             = $Request->get('phone');
            $res->free_minute       = getSetting()->free_chat_minute;
            $res->vcode             = $otp;
            $res->save();
        }
       
        if($setting->verify_type == 1)
        {
            $res->status = 1;
            $res->save();
            
            $token = $res->createToken($res->phone)->plainTextToken;

            return response()->json([
                
            'msg'       => 'done',
            'user_data' => ['id' => $res->id,'name' => $res->name,'phone' => $res->country.$res->phone],
            'token'     => $token
            
            ]);
        }
        else
        {
            $this->sendOtp($res,$setting);

            return response()->json(['msg' => 'otp','user_id' => $res->id,'phone' => $res->country.$res->phone]);
        }
    }

    public function resendCode(Request $Request)
    {
        $res            = User::find($Request->get('user_id'));
        $setting        = getSetting();

        $this->sendOtp($res,$setting);
        
        return response()->json(['user_id' => $res->id,'phone' => $res->country.$res->phone]);
    }

    public function verifyCode(Request $request)
    {
        $user = User::find($request->get('user_id'));

        if (!$user) {
            return response()->json([
                'msg'   => 'error',
                'error' => 'User not found'
            ], 404);
        }

        // Check OTP expiry
        if (!$user->otp_expires_at || now()->greaterThan($user->otp_expires_at)) {
            return response()->json([
                'msg'   => 'error',
                'error' => 'OTP expired. Please request a new one.'
            ], 403);
        }

        // Check max attempts (3 recommended)
        if ($user->otp_attempts >= 3) {
            return response()->json([
                'msg'   => 'error',
                'error' => 'Too many invalid attempts. Please request a new OTP.'
            ], 429);
        }

        //Verify OTP (constant-time)
        if (!hash_equals(
            $user->vcode,
            hash('sha256', $request->get('vcode'))
        )) {
            $user->increment('otp_attempts');

            return response()->json([
                'msg'   => 'error',
                'error' => 'Invalid OTP. Please try again.'
            ], 401);
        }

        //OTP is valid
        $user->status = 1;

        //Invalidate OTP
        $user->vcode = null;
        $user->otp_expires_at = null;
        $user->otp_attempts = 0;

        $user->save();

        // Web login if needed
        if ($request->get('is_web')) {
            Auth::login($user);
        }

        //Create API token
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

    public function sendOtp($res,$setting)
    {
       $otp = random_int(1000, 9999);

        if($setting->verify_type == 2)
        {
            $client = new Client($setting->t_sid,$setting->t_auth);

            $client->messages->create("+".$res->country.$res->phone, [
            'from' => $setting->t_from,
            'body' => 'Your AstroTalky OTP is '.$otp.'. Please use it to verify your mobile number.'
            ]);

            $res->vcode             = hash('sha256', $otp);
            $res->otp_expires_at    = now()->addMinutes(5);
            $res->otp_attempts      = 0;
            $res->save();
        }
        else
        {
            $msg = 'Your AstroTalky OTP is '.$otp.'. Please use it to verify your mobile number.';
            $msg = urlencode($msg);
            $url = $setting->sms_api;
            $url = str_replace(['{num}','{msg}','{other}'],[$res->phone,$msg,""], $url);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec ($ch);
            $info = curl_getinfo($ch);
            $http_result = $info ['http_code'];
            curl_close ($ch);
        }

        return true;
    }
}
