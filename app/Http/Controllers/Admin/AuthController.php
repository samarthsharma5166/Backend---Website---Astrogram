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
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class AuthController extends Controller
{
    public function index()
    {
		if(Auth::guard('admin')->check())
		{
			return Redirect(adminPrefix().'/home');
			exit;
		}

        return View('admin.auth.index',['form_url' => adminUrl('login')]);
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
			return Redirect::to(adminPrefix().'/home')->with('message', 'Welcome ! Your are logged in now.');
		}
		else
		{
			return Redirect::back()->with('error', 'Username password not match. Please try again.')->withInput();
		}
	}

	public function logout()
	{
		Auth::guard('admin')->logout();

		return Redirect(adminPrefix().'/login')->with('message', 'Logout Successfully.');

	}

	public function forgot()
	{
		return View('admin.auth.forgot',['form_url' => adminUrl('forgot')]);
	}

	public function _forgot(Request $Request)
	{
		$Request->validate([
			'email' => 'required|email'
		]);

		$chk = Admin::where('email', $Request->get('email'))->first();

		if (isset($chk->id))
		{
			// Ensure reset_key column exists in admin table
			try {
				if (Schema::hasTable('admin') && !Schema::hasColumn('admin', 'reset_key')) {
					Schema::table('admin', function (Blueprint $table) {
						$table->string('reset_key', 255)->nullable()->after('password');
					});
				}
			} catch (\Throwable $e) {
				\Log::warning('Could not ensure reset_key column on admin: ' . $e->getMessage());
			}

			$chk->reset_key = Str::random(7) . time() . Str::random(10) . rand(111, 9999);
			$chk->save();

			try {
				emailSetup();

				Mail::send('admin.auth.email_reset', ['res' => $chk], function($message) use($chk)
				{     
					$message->to($chk->email)->subject("Reset your password");                        
				});
			} catch (\Throwable $e) {
				\Log::error('Admin forgot password email error: ' . $e->getMessage());
				return Redirect::back()->with('error', 'Unable to send password reset email: ' . $e->getMessage())->withInput();
			}
			
			return Redirect(adminPrefix() . '/login')->with('message', 'Password reset link has been sent on your email. Please check your email.');
		}
		else
		{
			return Redirect::back()->with('error', 'Oops! This email is not registered with us.')->withInput();
		}
	}

	public function resetPassword(Request $request)
	{
		$token = $request->query('token');
		if (!$token) {
			return Redirect(adminPrefix() . '/login')->with('error', 'Invalid or missing reset token.');
		}

		$res = Admin::where('reset_key', $token)->first();

		if (isset($res->id))
		{
			return View('admin.auth.reset', ['form_url' => adminUrl('resetPassword?token=' . urlencode($token))]);
		}
		else
		{
			return Redirect(adminPrefix() . '/login')->with('error', 'Link is expired or invalid. Please try again.');
		}
	}

	public function _resetPassword(Request $Request)
	{
		$token = $Request->query('token') ?: $Request->input('token');
		if (!$token) {
			return Redirect(adminPrefix() . '/login')->with('error', 'Invalid or missing reset token.');
		}

		$Request->validate([
			'password' => 'required|min:6'
		]);

		$res = Admin::where('reset_key', $token)->first();

		if (isset($res->id))
		{
			$res->password  = bcrypt($Request->get('password'));
			$res->reset_key = null; 
			$res->save();

			return Redirect(adminPrefix() . '/login')->with('message', 'Success! Your password has been changed. Login to continue.');
		}
		else
		{
			return Redirect(adminPrefix() . '/login')->with('error', 'Link is expired or invalid. Please try again.');
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
