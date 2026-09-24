<?php
use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Setting;

function showAdminAmount($amount)
{
   $admin = getAdmin();

   return $admin->currency.number_format($amount,2);
}

function getAdmin()
{
   return Admin::where('role_id',1)->first();
}

function showDate($date)
{
   return date('d-M-Y',strtotime($date));
}

function getSetting()
{
   return Setting::find(1);
}

function getAsset($type)
{
   $admin   = getSetting();

   return Asset('upload/admin/'.$admin->$type);
}

 function getPromp($type)
 {
   return DB::table("promp")->where('type',$type)->first()->text;
 }

function emailSetup()
{
   $setting = getSetting();

   config([
      'mail.default' => 'smtp',
      'mail.mailers.smtp.host'       => $setting->email_host,
      'mail.mailers.smtp.port'       => $setting->email_port,
      'mail.mailers.smtp.username'   => $setting->email_username,
      'mail.mailers.smtp.password'   => $setting->email_password,
      'mail.mailers.smtp.encryption' => $setting->email_enc,
      'mail.from.address'            => $setting->email_from,
      'mail.from.name'               => $setting->email_from_name,
   ]);

   // Reset cached mailer
   app()->forgetInstance('mail.manager');
   app()->forgetInstance('mailer');

   return true;
}
