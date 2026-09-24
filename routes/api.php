<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\KundaliController;

Route::get('welcome', [ApiController::class, 'welcome'])->middleware('throttle:60,1');
Route::post('login', [AuthController::class, 'login'])->middleware('throttle:5,1');
Route::post('resendCode', [AuthController::class, 'resendCode'])->middleware('throttle:3,1');
Route::post('verifyCode', [AuthController::class, 'verifyCode'])->middleware('throttle:5,1');
Route::get('getApiKeys', [AccountController::class, 'getApiKeys'])->middleware('throttle:10,1');

Route::group(['middleware' => 'auth:sanctum'],function(){

Route::get('astrologer', [ApiController::class, 'astrologer']);

//Homepage
Route::get('homepageData', [ApiController::class, 'homepageData']);

//Chat
Route::post('chat/start', [ChatController::class, 'startChat']);
Route::post('chat/send', [ChatController::class, 'sendMessage']);
Route::get('chat/end', [ChatController::class, 'chatEnd']);
Route::get('chat/history', [ChatController::class, 'history']);
Route::get('chat/session', [ChatController::class, 'sessionHistory']);

//Kundali and Other moduel
Route::post('kundali', [KundaliController::class, 'createKundali']);
Route::post('predication', [KundaliController::class, 'predication']);
Route::post('horoscope', [KundaliController::class, 'horoscope']);
Route::post('match', [KundaliController::class, 'match']);
Route::post('baby', [KundaliController::class, 'baby']);

//account
Route::get('account', [AccountController::class, 'account']);
Route::post('accountUpdate', [AccountController::class, 'accountUpdate']);
Route::get('wallet', [AccountController::class, 'wallet']);
Route::post('addWallet', [AccountController::class, 'addWallet']);
Route::post('wallet/stripe-intent', [AccountController::class, 'createPaymentIntent']);
Route::post('wallet/razorpay', [AccountController::class, 'createRazorpayOrder']);
Route::get('getPush', [AccountController::class, 'getPush']);
Route::get('logout', [AccountController::class, 'logout']);
Route::post('deleteAccount', [AccountController::class, 'deleteAccount']);
Route::post('contact', [AccountController::class, 'contact']);


});