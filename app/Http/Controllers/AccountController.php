<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use App\Models\User;
use App\Models\Category;
use App\Models\Astrologer;
use App\Models\Wallet;
use DB;
use Validator;
use Redirect;
use Mail;
use Str;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Razorpay\Api\Api;
class AccountController extends Controller
{
    public function index()
	{
		return View('account.index',[

        'user'      => Auth::user(),
        'trans'     => Wallet::where('user_id',Auth::user()->id)->orderBy('id','DESC')->paginate(15),
        'spent'     => Wallet::where('type','Debit')->where('user_id',Auth::user()->id)->sum('amount'),
        'setting'   => getSetting()

        ]);
	}

    public function addBalance(Request $Request)
    {
        if($Request->get('payment_method') == "card")
        {
            return $this->payStripe($Request->get('amount'));
        }
        else
        {
            return $this->payRazorpay($Request->get('amount'));
        }
    }

    public function payStripe($amount)
    {
        $setting = getSetting();

        Stripe::setApiKey($setting->stripe_sec);

        $session = Session::create([
            'payment_method_types' => ['card'],
            'mode' => 'payment',

            'line_items' => [[
                'price_data' => [
                    'currency' => $setting->currency_code,
                    'product_data' => [
                        'name' => 'Wallet Recharge',
                        'description' => 'Wallet recharge for AstroTalky chat',
                    ],
                    'unit_amount' => $amount * 100,
                ],
                'quantity' => 1,
            ]],

            'success_url' => Asset('stripeSuccess') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => Asset('account'),
            'metadata' => [
                'user_id' => auth()->id(),
            ],
        ]);

        return redirect($session->url);
    }

    public function stripeSuccess(Request $request)
    {
        $setting = getSetting();

        Stripe::setApiKey($setting->stripe_sec);

        $session = \Stripe\Checkout\Session::retrieve($request->session_id);

        if ($session->payment_status === 'paid') {


            $res     = new Wallet;
            $res->addNew([
            
            'amount' => $session->amount_total / 100,
            'payment_method' => "Card",

            ]);

            return Redirect('account')->with('message','Wallet recharged successfully');
        }
    }

    public function payRazorpay($amount)
    {
        $setting = getSetting();

        $api = new Api(
            $setting->razorpay_key,
            $setting->razorpay_sec
        );

        $amount = $amount * 100;

        $order = $api->order->create([
            'receipt' => 'rcpt_' . time(),
            'amount' => $amount,
            'currency' => 'INR',
        ]);

        return view('account.razorpay', [
            'order'   => $order,
            'amount'  => $amount,
            'setting' => $setting,
            'user'    => auth()->user(),
        ]);
    }

    public function razorpayVerify(Request $request)
    {
        $setting = getSetting();
        $api     = new Api($setting->razorpay_key,$setting->razorpay_sec);

        try {
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id'=> $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ]);

            $payment = $api->payment->fetch($request->razorpay_payment_id);
            $amount  = $payment->amount / 100;

            $res     = new Wallet;
            $res->addNew(['amount' => $amount,'payment_method' => "Card"]);

            return Redirect('account')->with('message','Wallet recharged successfully');

        } catch (\Exception $e) {

            return Redirect('account')->with('error','Something went wrong.');
        }
    }

    public function logout()
    {
        Auth::logout();

        return Redirect('index');
    }
}
