<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Plan;
use App\Models\User;
use App\Models\UserPlan;
use App\Models\Admin;
use App\Exports\NewSub;
use App\Exports\ExpireSub;
use DB;
use Validator;
use Redirect;
use Excel;
use Stripe;
class AdminController extends Controller {
    
    public $folder = "admin.admin.";
    public $url    = "/admin";

	/*
	|---------------------------------
	|Index page showing all data
	|----------------------------------
	*/
	public function index()
	{
		$bank = new Admin;
		
		$data = [
		
		'data'	 => $bank->getAll(),
		'link'	 => Asset(env('admin').$this->url),
		'title'  => "Manage Staff Users",
		
		];
				
		return View($this->folder.'index',$data);
	}

	/*
	|---------------------------------
	|Add new page
	|----------------------------------
	*/
	public function show()
	{	
		return View($this->folder.'add',[
		
		'data' 		=> new Admin,
		'path' 		=> $this->folder,
		'form_url' 	=> Asset(env('admin').$this->url),
		
		]);
	}
	
	/*
	|---------------------------------
	|Add new page, Save in DB
	|----------------------------------
	*/
	public function store(Request $Request)
	{
		$data = new Admin;	

        $chk  = Admin::where('email',$Request->get('email'))->count();

        if($chk > 0)
        {   
            return Redirect::back()->with('error','Sorry! This email is already exists.');

            exit;
        }

		$add  = $data->updateData($Request->all(),"add");

		return Redirect(env('admin').$this->url)->with('message','New Staff User Added Successfully.');
	}

	/*
	|---------------------------------
	|Edit Page
	|----------------------------------
	*/
	public function edit($id)
	{				
		$res = Admin::find($id);
		
		return View($this->folder.'edit',[
		
			'data' 		=> $res,
			'path' 		=> $this->folder,
			'form_url' 	=> Asset(env('admin').$this->url.'/'.$id),
		
		]);
	}
	
	/*
	|---------------------------------
	|Edit Update Data in DB
	|----------------------------------
	*/
	public function update(Request $Request,$id)
	{	
		$data       = Admin::find($id);	

        $chk  = Admin::where('id','!=',$id)->where('email',$Request->get('email'))->count();

        if($chk > 0)
        {   
            return Redirect::back()->with('error','Sorry! This email is already exists.');

            exit;
        }

		$data->updateData($Request->all(),$id);

		return Redirect(env('admin').$this->url)->with('message','Staff User Updated Successfully.');
	}
	
	/*
	|---------------------------------
	|Delete Data
	|----------------------------------
	*/
	public function delete()
	{				
		$data = Admin::find($_GET['id'])->delete();	
			
		return Redirect(env('admin').$this->url)->with('message','Staff User Deleted Successfully.');
	}

    public function status()
    {
        $res            = Admin::find($_GET['id']);
        $res->status    = $res->status == 0 ? 1 : 0;
        $res->save();

		return Redirect(env('admin').$this->url)->with('message','Staff User Status Changed Successfully.');

    }

	public function adminPerm(Request $Request)
	{
		$update 		= Admin::find($Request->get('id'));
		$update->perm 	= implode(",",$Request->get('perm'));
		$update->save();

		return Redirect(env('admin').$this->url)->with('message','Staff Permission Assigned Successfully.');
	}
}
