<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public $incrementing = false;

    protected $casts = [
    'info' => 'array',
    ];

    protected $guarded = ['_token'];

    public function getKeyName()
    {
        return 'id';
    }

    protected $fillable = [];

   public function getAll()
   {
     return User::where(function($query){

        if(isset($_GET['q']) && $_GET['q'] != "")
        {
            $search = $_GET['q'];
            $query->where(function ($q) use ($search) {
            $q->whereRaw('LOWER(users.name) LIKE ?', ['%' . strtolower($search) . '%'])
                ->orWhereRaw('LOWER(users.phone) LIKE ?', ['%' . strtolower($search) . '%']);
            });
        }

        $query->where('status',1);

        })->orderBy('uid','DESC')->paginate(50)->withQueryString();
   }

    public function countChat($id)
    {
        return ChatSession::where('user_id',$id)->count();
    }
}
