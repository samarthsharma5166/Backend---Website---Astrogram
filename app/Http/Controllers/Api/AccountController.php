<?php namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Setting;
use App\Models\Astrologer;
use App\Models\User;
use App\Models\ChatSession;
use App\Models\Wallet;
use App\Models\Push;
use DB;
use Validator;
use Redirect;
use Mail;
use Str;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Razorpay\Api\Api;
class AccountController extends Controller {
	
	public function account()
    {
        $user       = Auth::user();
        $total_chat = ChatSession::where('user_id',$user->id)->count();
        $setting    = getSetting();

        return response()->json([

        'user'      => $user,
        'chat'      => $total_chat,
        'wallet'    => getSetting()->currency.number_format($user->wallet,2),
        'contact'   => ['faq' => json_decode($setting->faq),'email' => $setting->contact_email,'whatsapp' => $setting->whatsapp_no]
        ]);
    }

    public function accountUpdate(Request $Request)
    {
        $res            = User::find(Auth::user()->id);
        $res->name      = $Request->get('name');
        $res->email     = $Request->get('email');
        $res->save();

        return response()->json(['msg' => 'done']);
    }

    public function wallet()
    {
        $wallet  = new Wallet;
        $setting = getSetting();

        return response()->json([

        'currency'  => $setting->currency,
        'quick_add' => [50,100,200,500],
        'trans'     => $wallet->getAll(),
        'keys'      => $this->getApiKeys($setting),
        'balance'   => number_format(Auth::user()->wallet,2)

        ]);
    }

    public function getApiKeys($setting = null)
    {
        $setting = $setting ? $setting : getSetting();

        return [

        'stripe_key'        => $setting->stripe_key,
        'razorpay_key'      => $setting->razorpay_key,
        'push_id'           => $setting->push_user_app_id

        ];
    }

    public function createPaymentIntent(Request $request)
    {
        $setting = getSetting();
        
        Stripe::setApiKey($setting->stripe_sec);

        $paymentIntent = PaymentIntent::create([
            'amount'                => $request->amount * 100,
            'currency'              => $setting->currency_code,
            'payment_method_types'  => ['card'],
        ]);

        return response()->json(['clientSecret' => $paymentIntent->client_secret]);
    }

    public function createRazorpayOrder(Request $request)
    {
        $setting = getSetting();
        $api     = new Api($setting->razorpay_key,$setting->razorpay_sec);

        $order = $api->order->create([
            'receipt'         => uniqid(),
            'amount'          => $request->amount * 100,
            'currency'        => $setting->currency_code,
            'payment_capture' => 1,
        ]);

        return response()->json($order);
    }

    public function addWallet(Request $Request)
    {
        $res     = new Wallet;
        $balance = $res->addNew($Request->all());

        $this->sendPush("💵 Wallet recharged successfully ✅","Your wallet is recharged of 💵 ".\getSetting()->currency.$Request->get('amount'),Auth::user()->id);

       return response()->json(['data' => $res->getAll(),'balance' => $balance]);
    }

    public function getPush()
    {
        $res = new Push;

        return response()->json(['data' => $res->getAll(Auth::user()->id)]);
    }

   public function logout()
    {
        $user = User::find(Auth::user()->id);

        $user->tokens()->delete();

        return response()->json(['msg' => 'done']);
    }

    public function deleteAccount(Request $Request)
    {
        if($Request->get('delete') === "DELETE")
        {
            $user->tokens()->delete();
            return response()->json(['msg' => 'done']);
        }
        else
        {
            return response()->json(['msg' => 'error','error' => 'Please write DELETE in capital latter to delete your account.']);
            exit;
        }
    }

    public function contact(Request $Request)
    {
        emailSetup();

        $setting = getSetting();

        Mail::send('email.contact',['data' => $Request->all(),'user' => Auth::user()], function($message) use($setting)
        {     
            $message->to($setting->contact_email)->subject("AstroTalky - Email from contact us form");                        
        }); 

        return response()->json(['msg' => 'done']);
    }
}
