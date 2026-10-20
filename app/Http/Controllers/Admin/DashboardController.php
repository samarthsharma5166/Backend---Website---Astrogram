<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use App\Models\User;
use App\Models\Company;
use App\Models\Push;
use App\Models\Wallet;
use DB;
use Validator;
use Redirect;
use Session;

class DashboardController extends Controller
{
	public function home()
	{
		$res  = new Admin;

		return View('admin.dashboard.home',[

        'overview'      => $res->getOverview(),
        'months'        => $res->getMonth(),
        'userChart'     => $res->userChartData(),
        'earningChart'  => $res->earningChart(),
        'total_earning' => Wallet::where('type','Credit')->sum('amount'),
        'today_earning' => Wallet::where('type','Credit')->whereDate('created_at',date('Y-m-d'))->sum('amount'),
        'total_users'   => User::where('status',1)->count()

        ]);
	}

	public function setLang(Request $request)
	{
		$lang = $request->query('lang', 'en');
		$flag = $request->query('flag', 'circle-flags:uk');
		Session::put('locale', $lang);
		Session::put('flag', $flag);
    		
		return Redirect::back()->with('message', 'Language Changed Successfully.');
	}

	public function frontEnd()
	{
		return view('admin.dashboard.front',['data' => Auth::guard('admin')->user(),'form_url' => adminUrl('frontEnd')]);
	}

	public function _frontEnd(Request $Request)
	{
		$res 					= Admin::find(Auth::guard('admin')->user()->id);
		$res->web_title 		= $Request->get('web_title');
		$res->sub_heading 		= $Request->get('sub_heading');
		$res->main_desc 		= $Request->get('main_desc');
		$res->android_app_link 	= $Request->get('android_app_link');
		$res->ios_app_link 		= $Request->get('ios_app_link');
		$res->footer_desc 		= $Request->get('footer_desc');
		$res->twitter 			= $Request->get('twitter');
		$res->instagram 		= $Request->get('instagram');
		$res->linkdin 			= $Request->get('linkdin');
		$res->youtube 			= $Request->get('youtube');
		$res->facebook 			= $Request->get('facebook');

		if($Request->file('head_img'))
		{
			$filename   = time().rand(111,699).'.' .$Request->file('head_img')->getClientOriginalExtension(); 
            $Request->file('head_img')->move("upload/admin/", $filename);   
            $res->head_img = $filename;
		}

		$res->save();

		return Redirect::back()->with('message', 'Updated Successfully.');

	}

	public function push()
	{
		return View('admin.dashboard.push');
	}

	public function _push(Request $Request)
    {
        $filename = null;

        if($Request->has('file'))
        {
            $filename   = time().rand(111,699).'.' .$Request->file('file')->getClientOriginalExtension(); 
            $Request->file('file')->move("upload/push/", $filename);     
        }

        $this->sendPush($Request->get('title'),$Request->get('desc'),0,$filename);

        $push           = new Push;
        $data           = $Request->all();
        $data['img']    = $filename;

        $push->addNew($data);

        return Redirect::back()->with('message','Push Notification Sent Successfully.');
    }

	public function appUser()
    {
		$res = new User;

        return View('admin.dashboard.appUser',['data' => $res->getAll(),'q' => request('q'),'setting' => getSetting()]);
    }

	public function appUserEdit(Request $request)
    {        
        $user = User::find($request->query('id'));
        if (!$user) {
            return Redirect::back()->with('error', 'User not found.');
        }
        return View('admin.dashboard.userEdit',['data' => $user]);
    }

    public function _appUserEdit(Request $Request)
    {        
        $res = User::find($Request->get('id'));
        if (!$res) {
            return Redirect::back()->with('error', 'User not found.');
        }
        $res->name      = $Request->get('name');
        $res->phone     = $Request->get('phone');
        $res->email     = $Request->get('email');
        $res->country   = $Request->get('country');
        $res->save();

        return Redirect::back()->with('message','App User Updated Successfully.');
    }

    public function updateWallet(Request $Request)
    {
        $res = User::find($Request->get('user_id'));
        if (!$res) {
            return Redirect::back()->with('error', 'User not found.');
        }

        $amount = (float)$Request->get('amount');
        if($Request->get('type') == "Credit")
        {
            $res->wallet = ($res->wallet ?? 0) + $amount;
        }
        else
        {
            $res->wallet = max(0, ($res->wallet ?? 0) - $amount);
        }

        $res->save();

        $wallet                  = new Wallet;
        $wallet->user_id         = $res->id;
        $wallet->amount          = $amount;
        $wallet->type            = $Request->get('type');
        $wallet->payment_method  = "Admin";
        $wallet->notes           = "Admin updated wallet";
        $wallet->save();

        return Redirect::back()->with('message','Wallet Updated Successfully.');
    }

    public function viewUser(Request $request)
    {        
        $userId = $request->query('user_id');
        $res = User::find($userId);
        if (!$res) {
            return Redirect::back()->with('error', 'User not found.');
        }

        return View('admin.dashboard.view_user',[
            'user'    => $res,
            'trans'   => Wallet::where('user_id', $userId)->orderBy('id','DESC')->get(),
            'setting' => getSetting()
        ]);
    }
}
