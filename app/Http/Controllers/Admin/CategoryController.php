<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Category;
use App\Models\User;
use DB;
use Validator;
use Redirect;
class CategoryController extends Controller {
	
	/*
	|---------------------------------
	|Index page showing all data
	|----------------------------------
	*/
	public function index()
	{
		$category = new Category;
		
		$data = [
		
		'data'	 => $category->getAll(),
		'link'	 => Asset(env('admin').'/category'),
		'title'	 => 'Manage Category'

		
		];
				
		return View('admin.category.index',$data);
	}
	
	/*
	|---------------------------------
	|Add new page
	|----------------------------------
	*/
	public function show()
	{				
		return View('admin.category.add',[
        
        'data'          => new Category,
        'form_url'      => Asset(env('admin').'/category')
        
        ]);
	}
	
	/*
	|---------------------------------
	|Add new page, Save in DB
	|----------------------------------
	*/
	public function store(Request $Request)
	{				
		$data = new Category;	
		$data->addNew($Request->all(),"add");

		return Redirect(env('admin').'/category')->with('message','New category Added Successfully.');
	}
	
	/*
	|---------------------------------
	|Edit Page
	|----------------------------------
	*/
	public function edit($id)
	{	        
		return View('admin.category.edit',[
        
        'data'          => Category::find($id),
        'form_url' 	    => Asset(env('admin').'/category/'.$id),
        
        ]);
	}
	
	/*
	|---------------------------------
	|Edit Update Data in DB
	|----------------------------------
	*/
	public function update(Request $Request,$id)
	{				
		$data       = Category::find($id);	
		$data->addNew($Request->all(),$id);

		return Redirect(env('admin').'/category')->with('message','category Updated Successfully.');
	}
	
	/*
	|---------------------------------
	|Delete Data
	|----------------------------------
	*/
	public function delete()
	{				
		$data = Category::find($_GET['id'])->delete();	
			
		return Redirect(env('admin').'/category')->with('message','category Deleted Successfully.');
	}

	public function status()
    {
        $res            = Category::find($_GET['id']);
        $res->status    = $res->status == 0 ? 1 : 0;
        $res->save();

		return Redirect::back()->with('message','Status Changed Successfully.');

    }
}