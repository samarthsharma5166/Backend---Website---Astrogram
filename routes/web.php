<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\KundaliController;

require_once __DIR__ . '/Admin.php';

Route::get('', [HomeController::class, 'index']);
Route::get('index', [HomeController::class, 'index']);
Route::get('about', [HomeController::class, 'about']);
Route::get('contact', [HomeController::class, 'contact']);
Route::post('contact', [HomeController::class, '_contact']);
Route::get('privacy', [HomeController::class, 'privacy']);
Route::get('terms', [HomeController::class, 'term']);

Route::group(['middleware' => 'auth'], function(){

Route::get('info', [HomeController::class, 'info']);
Route::post('info', [HomeController::class, '_info']);

//Chat
Route::get('chat/{astro_id}', [ChatController::class, 'index']);
Route::post('chatStart', [ChatController::class, 'chatStart']);
Route::post('sendMsg', [ChatController::class, 'sendMsg']);
Route::get('chatEnd', [ChatController::class, 'chatEnd']);
Route::get('history', [ChatController::class, 'history']);

//Kundali
Route::get('kundali', [KundaliController::class, 'kundali']);
Route::post('kundali', [KundaliController::class, '_kundali']);

Route::get('predication', [KundaliController::class, 'predication']);
Route::post('predication', [KundaliController::class, '_predication']);

Route::get('horoscope', [KundaliController::class, 'horoscope']);
Route::post('horoscope', [KundaliController::class, '_horoscope']);

Route::get('match', [KundaliController::class, 'match']);
Route::post('match', [KundaliController::class, '_match']);

Route::get('baby', [KundaliController::class, 'baby']);
Route::post('baby', [KundaliController::class, '_baby']);

//MyAccount
Route::get('account', [AccountController::class, 'index']);
Route::post('addBalance', [AccountController::class, 'addBalance']);
Route::get('stripeSuccess', [AccountController::class, 'stripeSuccess']);
Route::post('razorpayVerify', [AccountController::class, 'razorpayVerify']);
Route::get('logout', [AccountController::class, 'logout']);


});