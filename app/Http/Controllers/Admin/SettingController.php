<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use App\Models\Setting;
use DB;
use Validator;
use Redirect;
use Session;

class SettingController extends Controller
{

	public function index()
	{
		return view('admin.setting.index',[
            
        'data'      => Auth::guard('admin')->user(),
        'form_url'  => Asset(env('admin').'/setting'),
        'setting'   => Setting::find(1)
        
        ]);
	}

	public function update(Request $Request)
	{		
		if($Request->get('auth_setting'))
        {
            $admin = new Admin;

            $chk  = Admin::where('id','!=',Auth::guard('admin')->user()->id)->where('email',$Request->get('email'))->count();

            if($chk > 0)
            {   
                return Redirect::back()->with('error','Sorry! This email is already exists.');

                exit;
            }

            $admin->updateData($Request->all(),Auth::guard('admin')->user()->id);
        }
        else
        {
            $admin = new Setting;

		    $admin->updateData($Request->all());
        }
        
		return Redirect::back()->with('message','Account Information Updated Successfully.');
	}
}
