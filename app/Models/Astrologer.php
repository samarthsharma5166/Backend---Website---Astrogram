<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Config;

class Astrologer extends Authenticatable
{
    protected $table = 'astrologer';	

    public $incrementing = false;

    public function getKeyName()
    {
        return 'id';
    }
	
	public function addNew($data,$type)
    {
        $add                    = $type == "add" ? new Astrologer : Astrologer::find($type);
        $add->name              = isset($data['name']) ? $data['name'] : null;
        $add->description       = isset($data['description']) ? $data['description'] : null;
        $add->language          = isset($data['language']) ? $data['language'] : null;
        $add->type              = isset($data['type']) ? $data['type'] : null;
        $add->gender            = isset($data['gender']) ? $data['gender'] : "Male";
        $add->exp               = isset($data['exp']) ? $data['exp'] : "2";
        $add->cost_per_minute   = isset($data['cost_per_minute']) ? $data['cost_per_minute'] : "15";
       

        if($type == "add")
        {
            $add->id                = rand(111,999).time().rand(111,999);
            $add->start_from        = rand(111,9999);
        }

        if(isset($data['img']))
        {
            $filename   = time().rand(111,699).'.' .$data['img']->getClientOriginalExtension(); 
            $data['img']->move("upload/astrologer/", $filename);   
            $add->img = $filename;   
        }

        $add->save();

        $cate = new AstroCate;
        $cate->addNew($add->id,$data);
    }

    public function getAll($type = "all")
    {
        return Astrologer::where(function($query) use($type){

            if($type != "all")
            {
                $query->where('status',$type);
            }

        })->orderBy('uid',"DESC")->get();
    }

    public function getCate($id)
    {
        return AstroCate::join('category','astro_cate.cate_id','=','category.id')
                        ->select('category.name')
                        ->where('astro_cate.astro_id',$id)
                        ->get();

    }

    public function getAppData()
    {
        $data       = [];
        $setting    = Setting::find(1);

        foreach($this->getAll(0) as $row)
        {
            $cate_id   = AstroCate::where('astro_id',$row->id)->pluck('cate_id')->toArray();
            $cate_name = Category::whereIn('id',$cate_id)->pluck('name')->toArray();
            $total     = ChatSession::where('astrologer_id',$row->id)->count();
            $data[] = [

            'id'            => $row->id,
            'name'          => $row->name,
            'desc'          => $row->description,
            'language'      => "English, ".$row->language,
            'type'          => $row->type,
            'img'           => $row->img ? Asset('upload/astrologer/'.$row->img) : null,
            'cates'         => $cate_id,
            'cate_name'     => $cate_name,
            'gender'        => $row->gender,
            'price'         => $row->cost_per_minute,
            'exp'           => $row->exp,
            'currency'      => $setting->currency,
            'total_order'   => $row->start_from + $total,

            ];
        }

        return $data;
    }

    public function countChat($id)
    {
        return ChatSession::where('astrologer_id',$id)->count();
    }
}
