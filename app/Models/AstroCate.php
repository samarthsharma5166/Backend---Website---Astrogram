<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Config;

class AstroCate extends Authenticatable
{
    protected $table = 'astro_cate';	

	public function addNew($id,$data)
    {
       AstroCate::where('astro_id',$id)->delete();

       $cate_id = isset($data['cate_id']) ? $data['cate_id'] : [];

       for($i=0;$i<count($cate_id);$i++)
       {
         $add           = new AstroCate;
         $add->cate_id  = $cate_id[$i];
         $add->astro_id = $id;
         $add->Save();
       }
    }
}
