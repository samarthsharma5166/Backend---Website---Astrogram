<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
class ChatSession extends Model
{
    use HasFactory;

    protected $table = 'chat_sessions';

    protected $fillable = [
        'user_id',
        'astrologer_id',
        'started_at',
        'ended_at',
        'total_seconds',
        'rate_per_minute',
        'total_amount',
        'status',
        'summary',
        'last_billed_at'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'last_billed_at' => 'datetime',
        'ended_at'   => 'datetime',
        'total_seconds' => 'integer',
        'rate_per_minute' => 'float',
        'total_amount' => 'float',
        'status' => 'string'
    ];

    /* =====================
     | Relationships
     ===================== */

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function astrologer()
    {
        return $this->belongsTo(Astrologer::class);
    }

    /* =====================
     | Helpers
     ===================== */

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function calculateAmount(): float
    {
        return round(($this->total_seconds / 60) * $this->rate_per_minute, 2);
    }
    
    public function getActive()
    {
        $res =  ChatSession::join('astrologer','chat_sessions.astrologer_id','=','astrologer.id')
                          ->select('astrologer.name','astrologer.img','chat_sessions.*')
                          ->where('chat_sessions.user_id',Auth::user()->id)
                          ->where('chat_sessions.status','active')
                          ->get();
        $data = [];

        foreach($res as $row)
        {
            $data[] = [

            'session_id'    => $row->id,
            'astrologer_id' => $row->astrologer_id,
            'name'          => $row->name,
            'img'           => Asset('upload/astrologer/'.$row->img),
            'status'        => $row->status

            ];
        }

        return $data;
    }

    public function billUser()
    {
        return DB::transaction(function () {

            $this->refresh();

            $now        = now();
            $lastBilled = $this->last_billed_at;
            $seconds    = $lastBilled->diffInSeconds($now, false);

            if ($seconds < 60) {
                return true;
            }

            $minutes = intdiv($seconds, 60);
            $user    = $this->user;
            $astro   = $this->astrologer;
            $amount  = $minutes * $astro->cost_per_minute;

            // Use free minutes first
            if ($user->free_minute > 0) {
                if ($user->free_minute >= $minutes) {
                    // All minutes covered by free minutes
                    $user->decrement('free_minute', $minutes);

                    $this->update([
                        'last_billed_at' => $now
                    ]);

                    return true;
                } else {
                    
                    $minutes            -= $user->free_minute; 
                    $user->free_minute  = 0;
                    $user->save();
                    $amount             = $minutes * $astro->cost_per_minute;
                }
            }

            if($user->wallet < $amount)
            {
                $this->update(['status' => 'ended','last_billed_at' => $now]);
                return false;
            }

            $user->decrement('wallet', $amount);

            $this->update(['last_billed_at' => $now]);

            $add = new Wallet;
            $add->user_id        = $user->id;
            $add->amount         = $amount;
            $add->type           = "Debit";
            $add->payment_method = "Wallet";
            $add->notes          = "Chat with {$astro->name}";
            $add->save();

            return true;
        });
    }

    public function startChatBilling()
    {
        $user  = $this->user;
        $astro = $this->astrologer;

        if($user->free_minute > 0)
        {
            $user->decrement('free_minute', 1);

        } else {
           
            if ($user->wallet < $astro->cost_per_minute)
            {
                $this->update(['status' => 'ended']);
                return false;
            }

            $user->decrement('wallet', $astro->cost_per_minute);

            $add                 = new Wallet;
            $add->user_id        = $user->id;
            $add->amount         = $astro->cost_per_minute;
            $add->type           = "Debit";
            $add->payment_method = "Wallet";
            $add->notes          = "Chat with {$astro->name}";
            $add->save();
        }

        $this->update(['last_billed_at' => now()]);

        return true;
    }

    public function secToMin($seconds): string
	{
		if (!$seconds || $seconds <= 0) {
			return '0:00';
		}

		$minutes = floor($seconds / 60);
		$remainingSeconds = $seconds % 60;

		return sprintf('%d:%02d', $minutes, $remainingSeconds);
	}
}
