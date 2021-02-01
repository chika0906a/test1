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
//ログイン画面表示
Route::get('fresh/generallogin', 'App\Http\Controllers\GeneralController@getAuth');
//ログイン認証
Route::post('fresh/generallogin', 'App\Http\Controllers\GeneralController@postAuth');
//マイページ表示
Route::get('fresh/generalmypage', 'App\Http\Controllers\GeneralController@generalmypage');

//一般ユーザー新規登録
Route::get('signup/add', 'App\Http\Controllers\GeneralController@signupadd');
Route::post('post/create', 'App\Http\Controllers\GeneralController@signupcreate');

//買い物リストトップ画面表示
Route::get('fresh/orders', 'App\Http\Controllers\GeneralController@orderstop');
//買い物リスト追加画面表示
Route::get('fresh/ordersadd', 'App\Http\Controllers\GeneralController@ordersadd');
//野菜の買い物リスト追加画面
Route::get('fresh/vegeadd2', 'App\Http\Controllers\GeneralController@vegeadd2');
//肉の買い物リスト画面
Route::get('fresh/meatadd2', 'App\Http\Controllers\GeneralController@meatadd2');
//魚の買い物リスト追加画面
Route::get('fresh/fishadd2', 'App\Http\Controllers\GeneralController@fishadd2');
//乳製品の買い物リスト追加画面
Route::get('fresh/dairyadd2', 'App\Http\Controllers\GeneralController@dairyadd2');
//その他の買い物リスト追加画面
Route::get('fresh/otheradd2', 'App\Http\Controllers\GeneralController@otheradd2');
//買い物リストに追加
Route::post('fresh/ordercreate', 'App\Http\Controllers\GeneralController@ordercreate');
//買い物リスト削除画面表示
Route::get('fresh/ordersdel', 'App\Http\Controllers\GeneralController@ordersdel');
//買い物リストから削除
Route::post('fresh/ordersdel', 'App\Http\Controllers\GeneralController@ordersremove');
//買い物リスト購入チェック画面表示
Route::get('fresh/ordersbuy','App\Http\Controllers\GeneralController@ordersbuy');
//買い物リストの購入チェック
Route::post('fresh/ordersbuy','App\Http\Controllers\GeneralController@ordersbuycheck');


//冷蔵庫の在庫登録トップ画面表示
Route::get('fresh/stockaddtop', 'App\Http\Controllers\GeneralController@stockaddtop');
//野菜の追加画面
Route::get('fresh/vegeadd', 'App\Http\Controllers\GeneralController@vegeadd');
//肉の追加画面
Route::get('fresh/meatadd', 'App\Http\Controllers\GeneralController@meatadd');
//魚の追加画面
Route::get('fresh/fishadd', 'App\Http\Controllers\GeneralController@fishadd');
//乳製品の追加画面
Route::get('fresh/dairyadd', 'App\Http\Controllers\GeneralController@dairyadd');
//その他の追加画面
Route::get('fresh/otheradd', 'App\Http\Controllers\GeneralController@otheradd');

//冷蔵庫の在庫登録
Route::post('fresh/stockcreate', 'App\Http\Controllers\GeneralController@stockcreate');

//冷蔵庫の在庫一覧表示
Route::get('fresh/stocktop', 'App\Http\Controllers\GeneralController@stocktop');
//冷蔵庫の野菜の在庫を表示
Route::get('fresh/vegeview', 'App\Http\Controllers\GeneralController@vegeview');
//冷蔵庫の肉の在庫を表示
Route::get('fresh/meatview', 'App\Http\Controllers\GeneralController@meatview');
//冷蔵庫の魚の在庫を表示
Route::get('fresh/fishview', 'App\Http\Controllers\GeneralController@fishview');
//冷蔵庫の乳製品の在庫を表示
Route::get('fresh/dairyview', 'App\Http\Controllers\GeneralController@dairyview');
//冷蔵庫のその他の在庫を表示
Route::get('fresh/otherview', 'App\Http\Controllers\GeneralController@otherview');
//冷蔵庫の在庫の削除画面表示
Route::get('fresh/stockdel', 'App\Http\Controllers\GeneralController@stockdel');
//野菜の在庫の削除画面表示
Route::get('fresh/vegedel', 'App\Http\Controllers\GeneralController@vegedel');
//肉の在庫の削除画面表示
Route::get('fresh/meatdel', 'App\Http\Controllers\GeneralController@meatdel');
//魚の在庫の削除画面表示
Route::get('fresh/fishdel', 'App\Http\Controllers\GeneralController@fishdel');
//乳製品の在庫の削除画面表示
Route::get('fresh/dairydel', 'App\Http\Controllers\GeneralController@dairydel');
//その他の在庫の削除画面表示
Route::get('fresh/otherdel', 'App\Http\Controllers\GeneralController@otherdel');
//冷蔵庫の在庫から削除
Route::post('fresh/stockdel', 'App\Http\Controllers\GeneralController@stockremove');
//冷蔵庫の中身の数量変更画面表示
Route::get('fresh/stockedit', 'App\Http\Controllers\GeneralController@stockedit');
//野菜の在庫の数量変更画面表示
Route::get('fresh/vegeedit', 'App\Http\Controllers\GeneralController@vegeedit');
//肉の在庫の数量変更画面表示
Route::get('fresh/meatedit', 'App\Http\Controllers\GeneralController@meatedit');
//魚の在庫の数量変更画面表示
Route::get('fresh/fishedit', 'App\Http\Controllers\GeneralController@fishedit');
//乳製品の在庫の数量変更画面表示
Route::get('fresh/dairyedit', 'App\Http\Controllers\GeneralController@dairyedit');
//その他の在庫の数量変更画面表示
Route::get('fresh/otheredit', 'App\Http\Controllers\GeneralController@otheredit');
//冷蔵庫の中身の数量変更(更新)
Route::post('fresh/stockedit', 'App\Http\Controllers\GeneralController@stockupdate');

//日付の入力画面にアクセス
Route::get('fresh/date','App\Http\Controllers\GeneralController@searchdate');
//入力した日付とDBから取得したデータを表示するページ
Route::post('fresh/search','App\Http\Controllers\GeneralController@recipesearch');
Route::post('menus','App\Http\Controllers\GeneralController@confirmmenus');
Route::post('save','App\Http\Controllers\GeneralController@menuscreate');
Route::get('end','App\Http\Controllers\GeneralController@end');





Route::get('fresh/menu', 'App\Http\Controllers\GeneralController@menufind');
Route::post('fresh/menu', 'App\Http\Controllers\GeneralController@menusearch');


//お問い合わせ入力
Route::get('fresh/support', 'App\Http\Controllers\GeneralController@supportquestion');
Route::post('post/create', 'App\Http\Controllers\GeneralController@supportcreate');

//送信完了画面（お問い合わせ）
Route::get('general/complete', 'App\Http\Controllers\GeneralController@supportcomplete');

//マイページ編集
Route::get('fresh/mypageedit', 'App\Http\Controllers\GeneralController@mypageedit');
Route::post('fresh/mypageedit', 'App\Http\Controllers\GeneralController@mypageupdate');
//マイページ編集完了
Route::get('jissyu8', 'App\Http\Controllers\Jissyu4_3Controller@index');
Route::post('jissyu8', 'App\Http\Controllers\Jissyu4_3Controller@post');





//企業ユーザー
Route::get('fresh/login', 'App\Http\Controllers\TeamcController@getAuth');
Route::post('fresh/login', 'App\Http\Controllers\TeamcController@postAuth');
Route::get('fresh/companymypage', 'App\Http\Controllers\TeamcController@mypage');
Route::post('fresh/companymypage', 'App\Http\Controllers\TeamcController@mypage');

//企業ユーザー新規登録
Route::get('new', 'App\Http\Controllers\TeamcController@new');
Route::post('post/create2', 'App\Http\Controllers\TeamcController@create2');


Route::get('fresh/infocomfirm', 'App\Http\Controllers\InfoController@index');
Route::post('fresh/infocomfirm', 'App\Http\Controllers\InfoController@post');

Route::get('fresh/info', 'App\Http\Controllers\InfoconfirmController@index');
Route::post('post/info', 'App\Http\Controllers\InfoconfirmController@info');

Route::get('fresh/infofinish', 'App/Http/Controllers/InfofinishController@index');
Route::post('fresh/infofinish', 'App/Http/Controllers/InfofinishController@post');

Route::get('fresh/signup', 'App\Http\Controllers\TeamcController@signup');
Route::post('fresh/signupconfirm', 'App\Http\Controllers\TeamcController@signupconfirm');
Route::post('fresh/signupfinish', 'App\Http\Controllers\TeamcController@signupfinish');

Route::get('fresh/companysupport', 'App\Http\Controllers\TeamcController@companysupport');
Route::post('fresh/companysupportconfirm', 'App\Http\Controllers\TeamcController@companysupportconfirm');
Route::post('fresh/companysupportfinish', 'App\Http\Controllers\TeamcController@companysupportfinish');

Route::get('fresh/resetmail', 'App\Http\Controllers\TeamcController@resetmail');
Route::post('fresh/resetmailconfirm', 'App\Http\Controllers\TeamcController@resetmailconfirm');
Route::post('fresh/resetmailfinish', 'App\Http\Controllers\TeamcController@resetmailfinish');
Route::get('fresh/areachoice', 'App\Http\Controllers\TeamcController@areachoice');
Route::post('fresh/areachoice', 'App\Http\Controllers\TeamcController@areaview');

//パスワードリセット
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');



Route::get('hello', 'App\Http\Controllers\HelloController@index');
Route::get('/hello/json', 'App\Http\Controllers\HelloController@json');
Route::get('/hello/json/{id}', 'App\Http\Controllers\HelloController@json');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//お知らせ送信履歴を表示する画面
Route::get('fresh/infohistory', 'App\Http\Controllers\TeamcController@infohistory');
Route::post('fresh/infohistory', 'App\Http\Controllers\TeamcController@infohistory');


//全ユーザー
Route::get('jissyu14', 'App\Http\Controllers\Jissyu6_3Controller@index');
Route::post('jissyu14/find', 'App\Http\Controllers\Jissyu6_3Controller@find');

Route::get('jissyu14/show', 'App\Http\Controllers\Jissyu6_3Controller@show');
Route::get('jissyu14/add', 'App\Http\Controllers\Jissyu6_3Controller@add');
Route::post('jissyu14/create','App\Http\Controllers\Jissyu6_3Controller@create');

Route::get('jissyu14/edit', 'App\Http\Controllers\Jissyu6_3Controller@edit');
Route::post('jissyu14/update', 'App\Http\Controllers\Jissyu6_3Controller@update');

Route::get('jissyu14/del', 'App\Http\Controllers\Jissyu6_3Controller@del');
Route::post('jissyu14/remove', 'App\Http\Controllers\Jissyu6_3Controller@remove');



//お問い合わせ一覧(一般ユーザー)
Route::get('support', 'App\Http\Controllers\SupportController@index');
Route::post('support/find', 'App\Http\Controllers\SupportController@find');

Route::get('support/show', 'App\Http\Controllers\SupportController@show');
Route::get('support/add', 'App\Http\Controllers\SupportController@add');
Route::post('support/create','App\Http\Controllers\SupportController@create');

Route::get('support/edit', 'App\Http\Controllers\SupportController@edit');
Route::post('support/update', 'App\Http\Controllers\SupportController@update');

Route::get('support/del', 'App\Http\Controllers\SupportController@del');
Route::post('support/remove', 'App\Http\Controllers\SupportController@remove');


//お問い合わせ一覧(企業ユーザー)
Route::get('companysupport', 'App\Http\Controllers\CompanysupportController@index');
Route::post('companysupport/find', 'App\Http\Controllers\CompanysupportController@find');

Route::get('companysupport/show', 'App\Http\Controllers\CompanysupportController@show');
Route::get('companysupport/add', 'App\Http\Controllers\CompanysupportController@add');
Route::post('companysupport/create','App\Http\Controllers\CompanysupportController@create');

Route::get('companysupport/edit', 'App\Http\Controllers\CompanysupportController@edit');
Route::post('companysupport/update', 'App\Http\Controllers\CompanysupportController@update');

Route::get('companysupport/del', 'App\Http\Controllers\CompanysupportController@del');
Route::post('companysupport/remove', 'App\Http\Controllers\CompanysupportController@remove');














