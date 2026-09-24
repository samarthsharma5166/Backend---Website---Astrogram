<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use DB;
use Validator;
use Redirect;
use Session;
use Mail;
use Str;

class AuthController extends Controller
{
    public function index()
    {
		if(Auth::guard('admin')->check())
		{
			return Redirect(env('admin').'/home');
			exit;
		}

        return View('admin.auth.index',['form_url' => Asset(env('admin').'/login')]);
    }

    /*
	|------------------------------------------------------------------
	|Login attempt,check username & password
	|------------------------------------------------------------------
	*/
	public function login(Request $request)
	{
		$username = $request->input('email');
		$password = $request->input('password');

		if (Auth::guard('admin')->attempt(['email' => $username, 'password' => $password,'status' => 0]))
		{
			return Redirect::to(env('admin').'/home')->with('message', 'Welcome ! Your are logged in now.');
		}
		else
		{
			return Redirect::back()->with('error', 'Username password not match. Please try again.')->withInput();
		}
	}

	public function logout()
	{
		Auth::guard('admin')->logout();

		return Redirect(env('admin').'/login')->with('message', 'Logout Successfully.');

	}

	public function forgot()
	{
		return View('admin.auth.forgot',['form_url' => Asset(env('admin').'/forgot')]);
	}

	public function _forgot(Request $Request)
	{
		$chk = Admin::where('email',$Request->get('email'))->first();

		if(isset($chk->id))
		{
			$chk->reset_key = Str::random(7).time().Str::random(10).rand(111,9999);
			$chk->save();

			Mail::send('admin.auth.email_reset',['res' => $chk], function($message) use($chk)
			{     
				$message->to($chk->email)->subject("Reset your password");                        
			});
			
			return Redirect(env('admin').'/login')->with('message','Password reset link has been sent on your email. Please check your email.');
		}
		else
		{
			return Redirect::back()->with('error','Oops! This email is not registered with us.')->withInput();
		}
	}

	public function resetPassword()
	{
		$res = Admin::where('reset_key',$_GET['token'])->first();

		if(isset($res->id))
		{
			return View('admin.auth.reset',['form_url' => Asset(env('admin').'/resetPassword?token='.$_GET['token'])]);
		}
		else
		{
			return Redirect(env('admin').'/login')->with('error','Link is expired. Please try again.');
		}
	}

	public function _resetPassword(Request $Request)
	{
		$res = Admin::where('reset_key',$_GET['token'])->first();

		if(isset($res->id))
		{
			$res->password  = bcrypt($Request->get('password'));
			$res->reset_key = null; 
			$res->save();

			return Redirect(env('admin').'/login')->with('message','Success! Your password has been changed. Login for continue');
		}
		else
		{
			return Redirect(env('admin').'/login')->with('error','Link is expired. Please try again.');
		}
	}

	public function key()
	{
		return View('admin.auth.key');
	}

	public function verifyKey()
	{
		return View('admin.auth.key');
	}

	public function _verifyKey(Request $Request)
	{
		return View('admin.auth.key');
	}
}
