<?php namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Setting;
use App\Models\Astrologer;
use App\Models\Category;
use App\Models\ChatSession;
use DB;
use Validator;
use Redirect;
use Stripe;
use Mail;
use Str;
class ApiController extends Controller {
	
	public function welcome()
    {
        $setting = Setting::find(1);

        $data = [
        
            'logo'    => $setting->app_logo ? Asset("upload/admin/".$setting->app_logo) : null,
            'img'     => $setting->app_welcome_img ? Asset("upload/admin/".$setting->app_welcome_img) : null,
            'title'   => $setting->welcome_title,
            'desc'    => $setting->welcome_desc,
            'privacy' => Asset('privacy'),
            'terms'   => Asset('terms'),
            'country' => DB::table('country')->pluck('name','code')->toArray()
        ];

		return response()->json(['data' => $data]);
    }

    public function astrologer()
    {
        $cate    = new Category;
        $astro   = new Astrologer;
        $setting = getSetting();
        $chat    = new ChatSession;

        $data = [

        'cates'         => $cate->getAppData(),
        'astrologers'   => $astro->getAppData(),
        'language'      => explode(",",$setting->language),
        'types'         => array_unique(Astrologer::pluck('type')->toArray()),
        'active'        => $chat->getActive(),
        'wallet'        => Auth::user()->wallet,
        'free_minute'   => Auth::user()->free_minute

        ];

        return response()->json(['data' => $data]);
    }

    public function homepageData()
    {
        $chat    = new ChatSession;
        $setting = getSetting();
        $cost    = [

        'kundali_cost'      => $setting->kundali_cost,
        'predication_cost'  => $setting->predication_cost,
        'horoscope_cost'    => $setting->horoscope_cost,
        'match_cost'        => $setting->match_cost,
        'name_cost'         => $setting->name_cost,
        'wallet'            => Auth::user()->wallet,
        'currency'          => $setting->currency,
        'language'          => explode(",",$setting->language)

        ];

        return response()->json([

        'active'    => $chat->getActive(),
        'cost'      => $cost,
        'push_api'  => $setting->push_user_app_id,
        'user_id'   => Auth::user()->id      

        ]);
    }

}
