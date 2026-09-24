<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Config;

class Push extends Authenticatable
{
    protected $table = 'push';	
	
	public function addNew($data)
    {
        
        $add            = new Push;
        $add->user_id   = isset($data['user_id']) ? $data['user_id'] : null;
        $add->title     = $data['title'];
        $add->text      = $data['desc'];
        $add->img       = $data['img'];
        $add->Save();
    }

    public function getAll($user_id = null)
    {
        $res =  Push::where(function($query) use($user_id){

            if($user_id) 
            {
                $query->where(function ($q) use ($user_id) {
                    $q->where('user_id', $user_id)
                    ->orWhereNull('user_id');
                });
           }

        })->orderBy('id','DESC')->take(25)->get();

        $data = [];

        foreach($res as $row)
        {
            $data[] = [

            'id'        => $row->id,
            'title'     => $row->title,
            'text'      => $row->text,
            'img'       => $row->img ? Asset('upload/push/'.$row->img) : null,
            'date'      => date('d-M-Y h:i:A',strtotime($row->created_at))

            ];
        }

        return $data;
    }
}
