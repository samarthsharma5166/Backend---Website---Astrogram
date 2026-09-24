<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Config;
use Auth;
class Wallet extends Authenticatable
{
    protected $table = 'wallet';

    protected $fillable = [
    'user_id',
    'amount',
    'type',
    'payment_method',
    'notes',
    ];
    
    public function getAll()
    {
        $res     = Wallet::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        $data    = [];
        $setting = getSetting();

        foreach($res as $row)
        {
            $data[] = [

            'id'        => $row->id,
            'amount'    => $setting->currency.number_format($row->amount,2),
            'type'      => $row->type,
            'notes'     => $row->notes,
            'date'      => $row->created_at->format('d M, Y h:i:A')

            ];
        }

        return $data;
    }

    public function addNew($data)
    {
        $add                        = new Wallet;
        $add->user_id               = Auth::user()->id;
        $add->amount                = $data['amount'];
        $add->type                  = "Credit";
        $add->payment_method        = $data['payment_method'];
        $add->notes                 = "Wallet recharge";
        $add->save();

        $user                       = User::find(Auth::user()->id);
        $user->wallet              += $add->amount;
        $user->save();

        return $user->wallet;
    }
}
