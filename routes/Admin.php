<?php
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AstrologerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['prefix' => config('app.admin', env('admin', 'backendLoginPanel'))], function(){

Route::get('', [AuthController::class, 'index'])->name('adminLogin');
Route::get('login', [AuthController::class, 'index'])->name('adminLogin');
Route::post('login', [AuthController::class, 'login']);
Route::get('forgot',[AuthController::class,'forgot']);
Route::post('forgot',[AuthController::class,'_forgot']);
Route::get('resetPassword',[AuthController::class,'resetPassword']);
Route::post('resetPassword',[AuthController::class,'_resetPassword']);

Route::group(['middleware' => 'auth:admin'], function(){

/*
|-------------------------------------
|Dashboard,Profile Setting
|-------------------------------------
*/
Route::get('home', [DashboardController::class, 'home']);
Route::get('setLang', [DashboardController::class, 'setLang']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('key', [AuthController::class, 'verifyKey']);
Route::get('keyVerify', [AuthController::class, 'verifyKey']);
Route::post('verifyKey', [AuthController::class, '_verifyKey']);
Route::get('frontEnd', [DashboardController::class, 'frontEnd']);
Route::post('frontEnd', [DashboardController::class, '_frontEnd']);
Route::get('push', [DashboardController::class, 'push']);
Route::post('push', [DashboardController::class, '_push']);
Route::get('appUser', [DashboardController::class, 'appUser']);
Route::post('updateWallet', [DashboardController::class, 'updateWallet']);
Route::get('appUserEdit', [DashboardController::class, 'appUserEdit']);
Route::post('appUserEdit', [DashboardController::class, '_appUserEdit']);
Route::get('viewUser', [DashboardController::class, 'viewUser']);

/*
|-----------------------------------------
|Account Setting
|-----------------------------------------
*/

Route::get('setting', [SettingController::class, 'index']);
Route::post('setting', [SettingController::class, 'update']);


/*
|-------------------------------------
|Manage Category
|-------------------------------------
*/
Route::resource('category',CategoryController::class);
Route::get('category_delete', [CategoryController::class, 'delete']);
Route::get('category_status', [CategoryController::class, 'status']);

/*
|-------------------------------------
|Manage Astrologer
|-------------------------------------
*/
Route::resource('astrologer',AstrologerController::class);
Route::get('astrologer_delete', [AstrologerController::class, 'delete']);
Route::get('astrologer_status', [AstrologerController::class, 'status']);

});
});

