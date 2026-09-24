<?php namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use App\Models\Setting;
use App\Models\Astrologer;
use App\Models\Wallet;
use App\Models\ChatMessage;
use App\Models\ChatSession;
use DB;
use Validator;
use Redirect;
use Stripe;
use Mail;
use Str;
class KundaliController extends Controller {
	
	public function createKundali(Request $request)
    {
        $user    = Auth::user();
        $setting = getSetting();

        //Wallet balance check
        if ($user->wallet < $setting->kundali_cost)
        {
            return response()->json([
                'status'  => false,
                'message' => 'Insufficient wallet balance'
            ], 400);
        }

        //User info
        $info           = $request->get('user_info', []);
        $name           = $info['name']     ?? '';
        $dob            = $info['dob']      ?? '';
        $tob            = $info['tob']      ?? '';
        $pob            = $info['pob']      ?? '';
        $gender         = $info['gender']   ?? '';
        $language       = $info['language'] ?? 'Hinglish';
        $systemPrompt   = getPromp('kundali');

        $systemPrompt = str_replace(
            ['{{name}}', '{{dob}}', '{{tob}}', '{{pob}}', '{{gender}}', '{{language}}','{date}'],
            [$name, $dob, $tob, $pob, $gender, $language,date('Y-m-d H:i:s')],
            $systemPrompt
        );

        //Debit wallet
        $user->decrement('wallet', $setting->kundali_cost);

        Wallet::create([
            'user_id'        => $user->id,
            'amount'         => $setting->kundali_cost,
            'type'           => 'Debit',
            'payment_method' => 'Wallet',
            'notes'          => 'Kundali generation'
        ]);

        try {
            $response = Http::withToken($setting->open_ai_key)->timeout(120)->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-4o',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => $systemPrompt,
                        ],
                        [
                            'role' => 'user',
                            'content' => 'Generate the complete kundali report now in '.$language,
                        ],
                    ],
                    'temperature' => 0.6,
                    'max_tokens'  => 1800,
                ]);

            $astroReply = $response['choices'][0]['message']['content'] ?? null;
            $astroReply = trim($astroReply);
            $astroReply = preg_replace('/^```html/i', '', $astroReply);
            $astroReply = preg_replace('/^```/i', '', $astroReply);
            $astroReply = preg_replace('/```$/', '', $astroReply);
            $astroReply = trim($astroReply);

            if (!$astroReply) {
                throw new \Exception('Empty AI response');
            }

            $this->sendPush("📖 ✨ Hello ".Auth::user()->name." Kundali is ready!","Your Kundali genrated successfully.Read it & Have a good day 🎉",Auth::user()->id);


            return response()->json([
                'status' => true,
                'data'   => $astroReply
            ]);

        } catch (\Exception $e) {

            $user->increment('wallet', $setting->kundali_cost);

            return response()->json([
                'status'  => false,
                'message' => 'Kundali generation failed',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function predication(Request $request)
    {
        $user    = Auth::user();
        $setting = getSetting();

        //Wallet balance check
        if ($user->wallet < $setting->predication_cost)
        {
            return response()->json([
                'status'  => false,
                'message' => 'Insufficient wallet balance'
            ], 400);
        }

        //User info
        $info           = $request->get('user_info', []);
        $name           = $info['name']     ?? '';
        $dob            = $info['dob']      ?? '';
        $tob            = $info['tob']      ?? '';
        $pob            = $info['pob']      ?? '';
        $gender         = $info['gender']   ?? '';
        $language       = $info['language'] ?? 'Hinglish';
        $category       = $info['category'] ?? 'Career';
        $timeline       = $info['timeline'] ?? 'timeline';
        $systemPrompt   = getPromp('predication');

        $systemPrompt = str_replace(
            ['{{name}}', '{{dob}}', '{{tob}}', '{{pob}}', '{{gender}}', '{{language}}','{{category}}','{{timeline}}','{date}'],
            [$name, $dob, $tob, $pob, $gender, $language,$category,$timeline,date('Y-m-d H:i:s')],
            $systemPrompt
        );

        //Debit wallet
        $user->decrement('wallet', $setting->predication_cost);

        Wallet::create([
            'user_id'        => $user->id,
            'amount'         => $setting->predication_cost,
            'type'           => 'Debit',
            'payment_method' => 'Wallet',
            'notes'          => 'Predication generation'
        ]);

        try {
            $response = Http::withToken($setting->open_ai_key)->timeout(120)->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => $systemPrompt,
                    ],
                    [
                        'role' => 'user',
                        'content' => 'Generate the complete future prediction report now in '.$language.' Return RAW HTML only.',
                    ],
                ],
                'temperature' => 0.55,
                'max_tokens'  => 2000,
                'top_p'       => 0.9,
            ]);

            $astroReply = $response['choices'][0]['message']['content'] ?? null;
            $astroReply = trim($astroReply);
            $astroReply = preg_replace('/^```html/i', '', $astroReply);
            $astroReply = preg_replace('/^```/i', '', $astroReply);
            $astroReply = preg_replace('/```$/', '', $astroReply);
            $astroReply = trim($astroReply);

            if (!$astroReply) {
                throw new \Exception('Empty AI response');
            }

            $this->sendPush("📖 ✨ Hello ".Auth::user()->name." Your Predication is ready!","Your Predication genrated successfully.Read it & Have a good day 🎉",Auth::user()->id);

            return response()->json([
                'status' => true,
                'data'   => $astroReply
            ]);

        } catch (\Exception $e) {

            $user->increment('wallet', $setting->predication_cost);

            return response()->json([
                'status'  => false,
                'message' => 'Kundali generation failed',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function horoscope(Request $request)
    {
        $user    = Auth::user();
        $setting = getSetting();

        //Wallet balance check
        if ($user->wallet < $setting->horoscope_cost)
        {
            return response()->json([
                'status'  => false,
                'message' => 'Insufficient wallet balance'
            ], 400);
        }

        //User info
        $info           = $request->get('user_info', []);
        $name           = $info['name']     ?? '';
        $dob            = $info['dob']      ?? '';
        $tob            = $info['tob']      ?? '';
        $pob            = $info['pob']      ?? '';
        $gender         = $info['gender']   ?? '';
        $language       = $info['language'] ?? 'Hinglish';
        $timeline       = $info['timeline'] ?? 'timeline';
        $systemPrompt   = getPromp('horoscope');

        $systemPrompt = str_replace(
            ['{{name}}', '{{dob}}', '{{tob}}', '{{pob}}', '{{gender}}', '{{language}}','{{timeline}}','{date}'],
            [$name, $dob, $tob, $pob, $gender, $language,$timeline,date('Y-m-d H:i:s')],
            $systemPrompt
        );

        //Debit wallet
        $user->decrement('wallet', $setting->horoscope_cost);

        Wallet::create([
            'user_id'        => $user->id,
            'amount'         => $setting->horoscope_cost,
            'type'           => 'Debit',
            'payment_method' => 'Wallet',
            'notes'          => 'horoscope generation'
        ]);

        try {
            $response = Http::withToken($setting->open_ai_key)->timeout(120)->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => $systemPrompt,
                    ],
                    [
                        'role' => 'user',
                        'content' => 'Generate the complete horoscope report now in '.$language.' Return RAW HTML only.',
                    ],
                ],
                'temperature' => 0.55,
                'max_tokens'  => 1800,
                'top_p'       => 0.9,
            ]);

            $astroReply = $response['choices'][0]['message']['content'] ?? null;
            $astroReply = trim($astroReply);
            $astroReply = preg_replace('/^```html/i', '', $astroReply);
            $astroReply = preg_replace('/^```/i', '', $astroReply);
            $astroReply = preg_replace('/```$/', '', $astroReply);
            $astroReply = trim($astroReply);

            if (!$astroReply) {
                throw new \Exception('Empty AI response');
            }

            $this->sendPush("📖 ✨ Hello ".Auth::user()->name." Your Horoscope is ready!","Your Horoscope genrated successfully.Read it & Have a good day 🎉",Auth::user()->id);


            return response()->json([
                'status' => true,
                'data'   => $astroReply
            ]);

        } catch (\Exception $e) {

            $user->increment('wallet', $setting->horoscope_cost);

            return response()->json([
                'status'  => false,
                'message' => 'Kundali generation failed',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function match(Request $request)
    {
        $user    = Auth::user();
        $setting = getSetting();

        //Wallet balance check
        if ($user->wallet < $setting->match_cost)
        {
            return response()->json([
                'status'  => false,
                'message' => 'Insufficient wallet balance'
            ], 400);
        }

        $systemPrompt   = getPromp('match');

        //User info
        $my       = $request->get('my_info', []);
        $partner  = $request->get('partner_info', []);

        $myName     = $my['name']   ?? '';
        $myDob      = $my['dob']    ?? '';
        $myTob      = $my['tob']    ?? '';
        $myPob      = $my['pob']    ?? '';
        $myGender   = $my['gender'] ?? '';

        $partnerName    = $partner['name']   ?? '';
        $partnerDob     = $partner['dob']    ?? '';
        $partnerTob     = $partner['tob']    ?? '';
        $partnerPob     = $partner['pob']    ?? '';
        $partnerGender  = $partner['gender'] ?? '';
        $language       = $partner['language'] ?? 'Hinglish';
        
        $systemPrompt = str_replace(['{{my_name}}','{{my_dob}}','{{my_tob}}','{{my_pob}}','{{my_gender}}','{{partner_name}}','{{partner_dob}}','{{partner_tob}}','{{partner_pob}}','{{partner_gender}}','{{language}}','{date}'],[$myName,$myDob,$myTob,$myPob,$myGender,$partnerName,$partnerDob,$partnerTob,$partnerPob,$partnerGender,$language,date("Y-m-d H:i:s")],$systemPrompt);

        //Debit wallet
        $user->decrement('wallet', $setting->match_cost);

        Wallet::create([
            'user_id'        => $user->id,
            'amount'         => $setting->match_cost,
            'type'           => 'Debit',
            'payment_method' => 'Wallet',
            'notes'          => 'Match making generation'
        ]);

        try {
            $response = Http::withToken($setting->open_ai_key)->timeout(120)->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => $systemPrompt,
                    ],
                    [
                        'role' => 'user',
                        'content' => 'Generate the complete match making report now in '.$language.' Return RAW HTML only.',
                    ],
                ],
                'temperature' => 0.55,
                'max_tokens'  => 2000,
                'top_p'       => 0.9,
            ]);

            $astroReply = $response['choices'][0]['message']['content'] ?? null;
            $astroReply = trim($astroReply);
            $astroReply = preg_replace('/^```html/i', '', $astroReply);
            $astroReply = preg_replace('/^```/i', '', $astroReply);
            $astroReply = preg_replace('/```$/', '', $astroReply);
            $astroReply = trim($astroReply);

            if (!$astroReply) {
                throw new \Exception('Empty AI response');
            }

            $this->sendPush("Hello ".Auth::user()->name." 💑","Your Match making process is successfully completed.Read it & Have a good day 🎉",Auth::user()->id);


            return response()->json([
                'status' => true,
                'data'   => $astroReply
            ]);

        } catch (\Exception $e) {

            $user->increment('wallet', $setting->match_cost);

            return response()->json([
                'status'  => false,
                'message' => 'Kundali generation failed',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function baby(Request $request)
    {
        $user    = Auth::user();
        $setting = getSetting();

        //Wallet balance check
        if ($user->wallet < $setting->name_cost)
        {
            return response()->json([
                'status'  => false,
                'message' => 'Insufficient wallet balance'
            ], 400);
        }

        $info           = $request->get('user_info', []);
        $dob            = $info['dob']      ?? '';
        $tob            = $info['tob']      ?? '';
        $pob            = $info['pob']      ?? '';
        $gender         = $info['gender']   ?? '';
        $language       = $info['language'] ?? 'Hinglish';
        $systemPrompt   = getPromp('baby');

        $systemPrompt = str_replace(
            ['{{dob}}', '{{tob}}', '{{pob}}', '{{gender}}', '{{language}}'],
            [$dob, $tob, $pob, $gender, $language],
            $systemPrompt
        );

        //Debit wallet
        $user->decrement('wallet', $setting->name_cost);

        Wallet::create([
            'user_id'        => $user->id,
            'amount'         => $setting->name_cost,
            'type'           => 'Debit',
            'payment_method' => 'Wallet',
            'notes'          => 'Baby name generation'
        ]);

        try {
            $response = Http::withToken($setting->open_ai_key)->timeout(120)->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => $systemPrompt,
                    ],
                    [
                        'role' => 'user',
                        'content' => 'Generate the complete baby name astrology report now in '.$language.' Return RAW HTML only.',
                    ],
                ],
                'temperature' => 0.55,
                'max_tokens'  => 2000,
                'top_p'       => 0.9,
            ]);

            $astroReply = $response['choices'][0]['message']['content'] ?? null;
            $astroReply = trim($astroReply);
            $astroReply = preg_replace('/^```html/i', '', $astroReply);
            $astroReply = preg_replace('/^```/i', '', $astroReply);
            $astroReply = preg_replace('/```$/', '', $astroReply);
            $astroReply = trim($astroReply);

            if (!$astroReply) {
                throw new \Exception('Empty AI response');
            }

            $this->sendPush("Congratulations ".Auth::user()->name." 👶","Baby names are genrated successfully.Check them & Have a good day 🎉",Auth::user()->id);

            return response()->json([
                'status' => true,
                'data'   => $astroReply
            ]);

        } catch (\Exception $e) {

            $user->increment('wallet', $setting->name_cost);

            return response()->json([
                'status'  => false,
                'message' => 'Kundali generation failed',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
