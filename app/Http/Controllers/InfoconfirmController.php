<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\models\info;
use Validator;

class InfoconfirmController extends Controller
{
    public function index(Request $request)
    {
        //$items = DB::select('select station_name from stations' );
        //return view('infoconfirm.input', ['items' => $items]);
        $data = [
            'msg'=>'',
        ];
        return view('infoconfirm.input', $data);

    }

    public function info(Request $request)
    {

        $param = [
            'mail' => $request->mail,
            'day' => $request->day,
            'info_title' => $request->info_title,
            'info_text' => $request->info_text,
            'station_id' => $request->station_id,
        ];
        DB::table('info')->insert($param);

        return view('infofinish.input');
    }





    public function image(Request $request, User $user) {

        // バリデーション省略
        $originalImg = $request->user_image;
      
          if($originalImg->isValid()) {
            $filePath = $originalImg->store('public');
            $user->image = str_replace('public/', '', $filePath);
            $user->save();
            return redirect("/user/{$user->id}")->with('user', $user);
      
      }
    }
    public function post(Request $request)
    {
        $rules = [
            'name' => 'required|max:10',
            'adress' => 'required|max:20',
            'login_id' => 'required|numeric|digits_between:8,16',
            'password' => 'required|between:8,16',
        ];
        $messages = [
            'name.required' => '名前は必ず入力して下さい。',
            'name.max' => '名前は10文字以内で入力して下さい。',
            'adress.required'  => '住所は必ず入力して下さい。',
            'adress.max'  => '住所は20文字以内で入力して下さい。',
            'login_id.required' => 'ログインIDは必ず入力して下さい。',
            'login_id.numeric' => 'ログインIDは数字で入力して下さい。',
            'login_id.digits_between' => 'ログインIDは8文字以上16文字以内で入力して下さい。',
            'password.required' => 'パスワードは必ず入力して下さい。',
            'password.between' => 'パスワードは8文字以上16文字以内で入力して下さい。',
        ];
        //$validator = Validator::make($request->all(),$rules,$message);
        //if ($validator->fails()) {
        //    return redirect('/infoconfirm')
        //        ->withErrors($validator)
        //        ->withInput();
       // }

        //全データの取得
        $data = $request->all();

        return view('infoconfirm.output', ['data' => $data]);
    }

}

