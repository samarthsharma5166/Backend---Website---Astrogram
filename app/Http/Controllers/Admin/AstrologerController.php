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
		'link'	 => adminUrl('astrologer'),
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
        'form_url'      => adminUrl('astrologer'),
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

		return Redirect(adminPrefix().'/astrologer')->with('message','New Astrologer Added Successfully.');
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
        'form_url' 	    => adminUrl('astrologer/'.$id),
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
		$data = Astrologer::find($id);	
		if ($data) {
			$data->addNew($Request->all(),$id);
		}

		return Redirect(adminUrl('astrologer'))->with('message','Astrologer Updated Successfully.');
	}
	
	/*
	|---------------------------------
	|Delete Data
	|----------------------------------
	*/
	public function delete()
	{				
		$id = request('id');
		$astro = Astrologer::find($id);
		if ($astro) {
			$astro->delete();
			AstroCate::where('astro_id', $id)->delete();
		}
			
		return Redirect(adminUrl('astrologer'))->with('message','Astrologer Deleted Successfully.');
	}

	public function status()
    {
        $id = request('id');
        $res = Astrologer::find($id);
        if ($res) {
            $res->status = $res->status == 0 ? 1 : 0;
            $res->save();
        }

		return Redirect::back()->with('message','Status Changed Successfully.');

    }
}