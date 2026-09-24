<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use App\Models\User;
use App\Models\Category;
use App\Models\Astrologer;
use App\Models\ChatSession;
use App\Models\ChatMessage;
use App\Services\Chat;
use App\Http\Controllers\Api\ChatController as API;
use DB;
use Validator;
use Redirect;
use Session;
use Mail;
use Str;

class ChatController extends Controller
{
    public function index(Request $request,$astro_id)
    {
        if(!$request->has('session_id'))
        {
            $chk = ChatSession::where('astrologer_id',$astro_id)->where('status','active')->first();

            if(isset($chk->id))
            {
                return Redirect('chat/'.$astro_id.'?session_id='.$chk->id);
            }
        }

        return View('chat.index',[

        'astro'     => Astrologer::find($astro_id),
        'info'      => Auth::user()->info,
        'session'   => !$request->has('session_id') ? $this->sessionHistory() : [],
        'setting'   => getSetting()

        ]);
    }

    public function chatStart(Request $Request)
    {
        $chat = new API();

        return $chat->startChat($Request);
    }

    public function sendMsg(Request $Request)
    {
        $chat = new API();

        return $chat->sendMessage($Request);
    }

    public function chatEnd(Request $Request)
    {
        $chat = new API();

        $chat->chatEnd($Request);

        return Redirect("history")->with('message','You chat ended successfully. Have a good day.');
    }

    public function history()
    {
        $res = ChatSession::join('astrologer','chat_sessions.astrologer_id','=','astrologer.id')
						  ->select('astrologer.name as astro_name','astrologer.img','chat_sessions.*')
						  ->where('chat_sessions.user_id',Auth::user()->id)
						  ->orderBy('chat_sessions.id','DESC')
						  ->get();

        return View('chat.history',['data' => $res]);
    }

    public function sessionHistory(Request $request)
    {
        $sessionId  = $request->query('session_id');
        $res 		= ChatMessage::where('chat_session_id', $sessionId)->orderBy('id')->get();
		$session 	= ChatSession::find($sessionId);
		$output 	= [];

		foreach ($res as $row) {

			$parts = array_filter(array_map('trim', explode('|', $row->message)));

			foreach ($parts as $text) {
				$output[] = [
					'id' 			=> $row->id,
					'message'      	=> $text,
					'sender'    	=> $row->sender,
					'created_at'	=> $row->created_at?->format('h:i A'),
				];
			}
		}

        return [

        'data'                  => $output,
        'session_started_at'    => $session->started_at,
        'status'                => $session->status,
        'total'                 => $session->status == "ended" ? $session->secToMin($session->total_seconds) : 0

        ];
    }
}
