<?php

namespace App\Http\Controllers;

use App\Person;
//use App\Generaluser;
use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class Jissyu6_3Controller extends Controller
{
    public function index(Request $request)
    {
        //$items = Person::all();
        //$items = Generaluser::all();
        //$items = Generaluser::select('select * from generalusers');
        $items = User::all();
        $param = ['input' => '','items' => $items];
        return view('jissyu6_3.index', $param);
    }

    public function find(Request $request)
    {
        //$item = Person::where('name',$request->input)->first();
        $item = User::where('mail',$request->input)->first();
        return view('jissyu6_3.show', ['item' => $item]);
    }

    public function show(Request $request)
    {
        //$item = Person::where('id', $request->id)->first();
        $item = User::where('id', $request->id)->first();
        return view('jissyu6_3.show', ['item' => $item]);
    }

    public function add(Request $request)
    {
        return view('jissyu6_3.add');
    }

    public function create(Request $request)
    {
        $this->validate($request, User::$rules);
        //$person = new Person;
        $user = new User;
        $form = $request->all();
        unset($form['_token']);
        //$person->fill($form)->save();
        $user->fill($form)->save();
        return redirect('/jissyu14');
    }
    public function edit(Request $request)
    {
        //$item = Person::find($request->id);
        //$item = Generaluser::find($request->mail);
        $item = User::where('id', $request->id)->first();
        return view('jissyu6_3.edit', ['item' => $item]);
    }

    public function update(Request $request)
    {
        //$this->validate($request, Person::$rules);
        $this->validate($request, User::$rules);
        //$person = Person::find($request->id);
        //$generaluser = Generaluser::find($request->mail);
        $user = User::where('id', $request->id)->first();
        $form = $request->all();
        unset($form['_token']);
        //$person->fill($form)->save();
        $user->fill($form)->save();
        return redirect('/jissyu14');
    }

    public function del(Request $request)
    {
        //$item = Person::find($request->id);
        //$item = Generaluser::find($request->mail);
        $item = User::where('id', $request->id)->first();
        return view('jissyu6_3.del', ['item' => $item]);
    }

    public function remove(Request $request)
    {
        //Person::find($request->id)->delete();
        User::where('id',$request->id)->delete();
        return redirect('/jissyu14');
    }
}
