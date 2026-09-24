<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Config;

class Category extends Authenticatable
{
    protected $table = 'category';	

    public $incrementing = false;

    public function getKeyName()
    {
        return 'id';
    }
	
	public function addNew($data,$type)
    {
        $add            = $type == "add" ? new Category : Category::find($type);
        $add->name      = isset($data['name']) ? $data['name'] : null;
        $add->sort_no   = isset($data['sort_no']) ? $data['sort_no'] : 0;
        $add->status    = isset($data['status']) ? $data['status'] : 0;

        if($type == "add")
        {
            $add->id    = rand(111,999).time().rand(111,999);
        }

        if(isset($data['img']))
        {
            $filename   = time().rand(111,699).'.' .$data['img']->getClientOriginalExtension(); 
            $data['img']->move("upload/category/", $filename);   
            $add->img = $filename;   
        }

        $add->save();
    }

    public function getAll($type = "all")
    {
        return Category::where(function($query) use($type){

            if($type != "all")
            {
                $query->where('status',$type);
            }

        })->orderBy('sort_no',"ASC")->get();
    }

    public function getAppData()
    {
        $data = [];

        foreach($this->getAll(0) as $row)
        {
            $data[] = [

            'id'    => $row->id,
            'name'  => $row->name,
            'img'   => $row->img ? Asset('upload/category/'.$row->img) : null,

            ];
        }

        return $data;
    }

}
