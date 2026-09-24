<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\KundaliController as API;
use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use App\Models\User;
use App\Models\Category;
use App\Models\Astrologer;
use DB;
use Validator;
use Redirect;
use Session;
use Mail;
use Str;

class KundaliController extends Controller
{
    public function kundali()
    {
        $setting = getSetting();

        return View('kundali.kundali',[

        'user'          => Auth::user(),
        'setting'       => $setting,
        'haveBalance'   => Auth::user()->wallet > $setting->kundali_cost ? true : false

        ]);
    }

    public function _kundali(Request $Request)
    {
         $api   = new API();

         return $api->createKundali($Request);
    }

    public function predication()
    {
        $setting = getSetting();
        
        return View('kundali.predication',[

        'user'          => Auth::user(),
        'setting'       => $setting,
        'haveBalance'   => Auth::user()->wallet > $setting->predication_cost ? true : false

        ]);
    }

    public function _predication(Request $Request)
    {
         $api   = new API();

         return $api->predication($Request);
    }

    public function horoscope()
    {
        $setting = getSetting();
        
        return View('kundali.horoscope',[

        'user'          => Auth::user(),
        'setting'       => $setting,
        'haveBalance'   => Auth::user()->wallet > $setting->horoscope_cost ? true : false

        ]);
    }

    public function _horoscope(Request $Request)
    {
         $api   = new API();

         return $api->horoscope($Request);
    }

    public function match()
    {
        $setting = getSetting();
        
        return View('kundali.match',[

        'user'          => Auth::user(),
        'setting'       => $setting,
        'haveBalance'   => Auth::user()->wallet > $setting->match_cost ? true : false

        ]);
    }

    public function _match(Request $Request)
    {
         $api   = new API();

         return $api->match($Request);
    }

    public function baby()
    {
        $setting = getSetting();
        
        return View('kundali.baby',[

        'user'          => Auth::user(),
        'setting'       => $setting,
        'haveBalance'   => Auth::user()->wallet > $setting->name_cost ? true : false

        ]);
    }

    public function _baby(Request $Request)
    {
         $api   = new API();

         return $api->baby($Request);
    }
}
