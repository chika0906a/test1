<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\HelloRequest;
use Validator;
use App\Person;

class HelloController extends Controller
{
  
public function index(Request $request) 
   {
    $user = Auth::user();
    //$sort = $request->sort;
    $sort = 'mail';
    //$items=Person::orderBy($sort, 'asc')
    //->simplePaginate(5);
   // $items=Generaluser::all()->simplePaginate(5);
    //$param = ['items' => $items, 'sort' => $sort,
  //'user' => $user];
    //return view('hello.index');
   }

   public function getAuth(Request $request)
   {
     $param =['message' => '管理者用ログイン画面'];
     return view('hello.auth', $param);
   }

   public function postAuth(Request $request)
   {
     $email = $request->email;
     $password = $request->password;
     if (Auth::attempt(['email' => $email,'password' => $password])) {
       $msg = 'ログインしました。(' . Auth::user()->name . ')';
     } else {
       $msg = 'ログインに失敗しました。';
     }
     return view('hello.auth', ['message' => $msg]);
   }
}