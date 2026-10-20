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
		'link'	 => adminUrl('category'),
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
        'form_url'      => adminUrl('category')
        
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

		return Redirect(adminPrefix().'/category')->with('message','New category Added Successfully.');
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
        'form_url' 	    => adminUrl('category/'.$id),
        
        ]);
	}
	
	/*
	|---------------------------------
	|Edit Update Data in DB
	|----------------------------------
	*/
	public function update(Request $Request,$id)
	{				
		$data = Category::find($id);	
		if ($data) {
			$data->addNew($Request->all(),$id);
		}

		return Redirect(adminUrl('category'))->with('message','Category Updated Successfully.');
	}
	
	/*
	|---------------------------------
	|Delete Data
	|----------------------------------
	*/
	public function delete()
	{				
		$id = request('id');
		$cat = Category::find($id);
		if ($cat) {
			$cat->delete();
		}
			
		return Redirect(adminUrl('category'))->with('message','Category Deleted Successfully.');
	}

	public function status()
    {
        $id = request('id');
        $res = Category::find($id);
        if ($res) {
            $res->status = $res->status == 0 ? 1 : 0;
            $res->save();
        }

		return Redirect::back()->with('message','Status Changed Successfully.');

    }
}