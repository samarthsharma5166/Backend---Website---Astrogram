<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Category;
use App\Models\Astrologer;
use DB;
use Validator;
use Redirect;
use Session;
use Mail;
use Str;

class HomeController extends Controller
{
    public function index(Request $request)
	{
		$token = $request->query('authToken');

		if($token)
		{
			$accessToken = PersonalAccessToken::findToken($token);

			if(!$accessToken)
			{
       		 	abort(401, 'Invalid token');
    		}

			$user 		 = $accessToken->tokenable;
			Auth::login($user);
			return Redirect('info');
		}

		$cate 	= new Category;
		$astro 	= new Astrologer;

		return View('home.index',[

		'cates' 		=> $cate->getAppData(),
		'astrologer'	=> $astro->getAppData(),
		'setting'		=> getSetting(),
		'auth'			=> Auth::check() ? 1 : 0,
		'country'		=> DB::table('country')->get()

		]);
	}

	public function info()
	{
		return View('info.index',['data' => Auth::user()]);
	}

	public function _info(Request $Request)
	{
		$data = $Request->all();
		unset($data['_token']);

		Auth::user()->update(['info' => $data]);

		return Redirect('index');
	}

	public function about()
	{
		return View('page.about');
	}

	public function contact()
	{
		return View('page.contact',['setting' => getSetting()]);
	}

	public function _contact(Request $Request)
	{
		emailSetup();

        $setting = getSetting();

        Mail::send('email.contact',['data' => $Request->all(),'user' => null], function($message) use($setting)
        {     
            $message->to($setting->contact_email)->subject("AstroTalky - Email from contact us form");                        
        }); 

		return Redirect::back()->with('message','Thank You! We have received your message. We will contact you soon.');
	}

	public function privacy()
	{
		return View('page.privacy',['setting' => getSetting()]);
	}

	public function term()
	{
		return View('page.term',['setting' => getSetting()]);
	}
}
