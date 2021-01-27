<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GeneralUser;

class HelloController extends Controller
{
  
   public function index() 
   {
      $data = [
         'msg' => 'This is Vue.js application.',
      ];
      return view('hello.index', $data);
   }

   public function json($id = -1)
   {
      if ($id == -1)
      {
         return GeneralUser::get()->toJson();
      }
      else
      {
         return GeneralUser::find($id)->json();
      }
   }
}