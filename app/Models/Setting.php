<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use DB;

class Setting extends Authenticatable
{
    protected $table = "setting";

    protected $fillable = [];

    protected $guarded = ['_token'];

    public function updateData($data)
    {
       $setting = Setting::find(1);

       foreach(['logo', 'favicon', 'cover','app_logo','app_welcome_img'] as $field)
       {
            if(isset($data[$field]) && $data[$field] instanceof \Illuminate\Http\UploadedFile)
            {
                $path       = 'upload/admin/';
                $filename   = rand(100000, 999999).'.' .$data[$field]->getClientOriginalExtension(); 
                $data[$field]->move(public_path($path), $filename);

                $data[$field] = $filename;
            } 
            else
            {
                unset($data[$field]);
            }
        }  
        
        $setting->update($data);

        return $setting;
    }

}
