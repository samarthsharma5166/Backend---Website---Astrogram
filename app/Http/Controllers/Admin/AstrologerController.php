<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Category;
use App\Models\Astrologer;
use App\Models\AstroCate;
use App\Models\User;
use DB;
use Validator;
use Redirect;
class AstrologerController extends Controller {
	
	/*
	|---------------------------------
	|Index page showing all data
	|----------------------------------
	*/
	public function index()
	{
		$Astrologer = new Astrologer;
		
		$data = [
		
		'data'	 => $Astrologer->getAll(),
		'link'	 => Asset(env('admin').'/astrologer'),
		'title'	 => 'Manage Astrologer'

		
		];
				
		return View('admin.astrologer.index',$data);
	}
	
	/*
	|---------------------------------
	|Add new page
	|----------------------------------
	*/
	public function show()
	{				
		$cate = new Category;

        return View('admin.astrologer.add',[
        
        'data'          => new Astrologer,
        'form_url'      => Asset(env('admin').'/astrologer'),
        'cates'         => $cate->getAll(),
		'array'			=> []
        
        ]);
	}
	
	/*
	|---------------------------------
	|Add new page, Save in DB
	|----------------------------------
	*/
	public function store(Request $Request)
	{				
		$data = new Astrologer;	
		$data->addNew($Request->all(),"add");

		return Redirect(env('admin').'/astrologer')->with('message','New Astrologer Added Successfully.');
	}
	
	/*
	|---------------------------------
	|Edit Page
	|----------------------------------
	*/
	public function edit($id)
	{	        
        $cate = new Category;

		return View('admin.astrologer.edit',[
        
        'data'          => Astrologer::find($id),
        'form_url' 	    => Asset(env('admin').'/astrologer/'.$id),
        'cates'         => $cate->getAll(),
        'array'         => AstroCate::where('astro_id',$id)->pluck('cate_id')->toArray()
        
        ]);
	}
	
	/*
	|---------------------------------
	|Edit Update Data in DB
	|----------------------------------
	*/
	public function update(Request $Request,$id)
	{				
		$data       = Astrologer::find($id);	
		$data->addNew($Request->all(),$id);

		return Redirect(env('admin').'/astrologer')->with('message','Astrologer Updated Successfully.');
	}
	
	/*
	|---------------------------------
	|Delete Data
	|----------------------------------
	*/
	public function delete()
	{				
		$data = Astrologer::find($_GET['id'])->delete();	

		AstroCate::where('astro_id',$_GET['id'])->delete();
			
		return Redirect(env('admin').'/astrologer')->with('message','Astrologer Deleted Successfully.');
	}

	public function status()
    {
        $res            = Astrologer::find($_GET['id']);
        $res->status    = $res->status == 0 ? 1 : 0;
        $res->save();

		return Redirect::back()->with('message','Status Changed Successfully.');

    }
}