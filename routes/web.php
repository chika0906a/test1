<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//一般ユーザー
Route::get('fresh/generallogin', 'App\Http\Controllers\GeneralController@getAuth');
Route::post('fresh/generallogin', 'App\Http\Controllers\GeneralController@postAuth');
Route::get('fresh/generalmypage', 'App\Http\Controllers\GeneralController@mypage');

Route::get('fresh/orders', 'App\Http\Controllers\GeneralController@orderstop');
Route::get('fresh/ordersadd', 'App\Http\Controllers\GeneralController@ordersadd');
Route::post('fresh/ordersadd', 'App\Http\Controllers\GeneralController@ordersaddchoice');
Route::post('fresh/ordercreate', 'App\Http\Controllers\GeneralController@ordercreate');
Route::get('fresh/ordersdel', 'App\Http\Controllers\GeneralController@ordersdel');
Route::post('fresh/ordersdel', 'App\Http\Controllers\GeneralController@ordersremove');

Route::get('fresh/stockaddtop', 'App\Http\Controllers\GeneralController@stockaddtop');
// Route::get('fresh/stockadd', 'App\Http\Controllers\GeneralController@stockadd');
Route::post('fresh/stockadd1', 'App\Http\Controllers\GeneralController@stockadd');
Route::post('fresh/stockcreate', 'App\Http\Controllers\GeneralController@stockcreate');

Route::get('fresh/stocktop', 'App\Http\Controllers\GeneralController@stocktop');
Route::get('fresh/stockdel', 'App\Http\Controllers\GeneralController@stockdel');
Route::post('fresh/stockdel', 'App\Http\Controllers\GeneralController@stockremove');
Route::get('fresh/stockedit', 'App\Http\Controllers\GeneralController@stockedit');
Route::post('fresh/stockedit', 'App\Http\Controllers\GeneralController@stockupdate');

//企業ユーザー
Route::get('fresh/login', 'App\Http\Controllers\TeamcController@getAuth');
Route::post('fresh/login', 'App\Http\Controllers\TeamcController@postAuth');
Route::get('fresh/companymypage', 'App\Http\Controllers\TeamcController@mypage');
Route::post('fresh/companymypage', 'App\Http\Controllers\TeamcController@mypage');

Route::get('fresh/info', 'App\Http\Controllers\InfoController@index');
Route::post('fresh/info', 'App\Http\Controllers\InfoController@post');

Route::get('fresh/infoconfirm', 'App\Http\Controllers\InfoconfirmController@index');
Route::post('fresh/infoconfirm', 'App\Http\Controllers\InfoconfirmController@post');

Route::get('fresh/infofinish', 'App/Http/Controllers/InfofinishController@index');
Route::post('fresh/infofinish', 'App/Http/Controllers/InfofinishController@post');

//Route::get('fresh/companymypage', 'App\Http\Controllers\TeamcController@mypage');
//Route::post('fresh/companymypage', 'App\Http\Controllers\TeamcController@mypage');

Route::get('fresh/signup', 'App\Http\Controllers\TeamcController@signup');
Route::post('fresh/signupconfirm', 'App\Http\Controllers\TeamcController@signupconfirm');
Route::post('fresh/signupfinish', 'App\Http\Controllers\TeamcController@signupfinish');

Route::get('fresh/companysupport', 'App\Http\Controllers\TeamcController@companysupport');
Route::post('fresh/companysupportconfirm', 'App\Http\Controllers\TeamcController@companysupportconfirm');
Route::post('fresh/companysupportfinish', 'App\Http\Controllers\TeamcController@companysupportfinish');

Route::get('fresh/resetmail', 'App\Http\Controllers\TeamcController@resetmail');
Route::post('fresh/resetmailconfirm', 'App\Http\Controllers\TeamcController@resetmailconfirm');
Route::post('fresh/resetmailfinish', 'App\Http\Controllers\TeamcController@resetmailfinish');

//パスワードリセット
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('hello', 'App\Http\Controllers\HelloController@index');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');