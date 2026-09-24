<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use DB;
use Carbon\Carbon;
class Admin extends Authenticatable
{
    protected $table = "admin";

    public function updateData($data,$type = "add")
    {
        $update                         = $type == "add" ? new Admin : Admin::find($type);
        $update->name                   = isset($data['name']) ? $data['name'] : null;
        $update->email                  = isset($data['email']) ? $data['email'] : null;
        
        if(isset($data['new_pass']))
        {
            $update->password           = bcrypt($data['new_pass']);
        }

        if(isset($data['phone']))
        {
            $update->phone              = $data['phone'];
        }

        if(isset($data['role_id']))
        {
            $update->role_id              = $data['role_id'];
        }

        $update->save();
    }

    public function getAll()
    {
        return Admin::where('role_id',2)->orderBy('id','DESC')->get();
    }

    public function getOverview()
    {
        $astro = Astrologer::count();
        $user  = User::count();
        $chat  = ChatSession::count();

        return [
        
        'astro' => $astro,
        'user'  => $user,
        'chat'  => $chat

        ];
    }

    public function getMonth()
    {
        $labels = [];
        $now = Carbon::now();

        for ($i = 0; $i < 6; $i++) {
            $labels[] = $now->copy()->subMonths($i)->format('M');
        }

        return $labels;
    }

    public function userChartData()
    {
        $now   = Carbon::now()->startOfMonth();
        $data  = [];

        for ($i = 0; $i < 6; $i++) {

            $start = $now->copy()->subMonths($i)->startOfMonth();
            $end   = $now->copy()->subMonths($i)->endOfMonth();
            $count = User::where('status',1)->whereBetween('created_at', [$start, $end])->count(); 
            $data[] = $count;
        }

        return $data;
    }

    public function earningChart()
    {
        $now   = Carbon::now()->startOfMonth();
        $data  = [];

        for ($i = 0; $i < 6; $i++) {

            $start = $now->copy()->subMonths($i)->startOfMonth();
            $end   = $now->copy()->subMonths($i)->endOfMonth();
            $count = Wallet::where('type','Credit')->whereBetween('created_at', [$start, $end])->sum('amount'); 
            $data[] = $count;
        }

        return $data;
    }
}
