<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupportController extends Controller
{
    public function index(Request $request)
    {
        //$items = Person::all();
        $items = Support::all();
        //$items = Generaluser::select('select * from generalusers');
        $param = ['input' => '','items' => $items];
        return view('support.index', $param);
    }

    public function find(Request $request)
    {
        //$item = Person::where('name',$request->input)->first();
        $item = Support::where('support_num',$request->input)->first();
        return view('support.show', ['item' => $item]);
    }

    public function show(Request $request)
    {
        //$item = Person::where('id', $request->id)->first();
        $item = Support::where('support_num', $request->support_num)->first();
        return view('support.show', ['item' => $item]);
    }

    public function add(Request $request)
    {
        return view('support.add');
    }

    public function create(Request $request)
    {
        $this->validate($request, Support::$rules);
        //$person = new Person;
        $support = new Support;
        $form = $request->all();
        unset($form['_token']);
        //$person->fill($form)->save();
        $support->fill($form)->save();
        return redirect('/support');
    }
    public function edit(Request $request)
    {
        //$item = Person::find($request->id);
        $item = Support::find($request->support_num);
        return view('support.edit', ['item' => $item]);
    }

    public function update(Request $request)
    {
        //$this->validate($request, Person::$rules);
        $this->validate($request, Support::$rules);
        //$person = Person::find($request->id);
        $support = Support::find($request->support_num);
        $form = $request->all();
        unset($form['_token']);
        //$person->fill($form)->save();
        $support->fill($form)->save();
        return redirect('/support');
    }

    public function del(Request $request)
    {
        //$item = Person::find($request->id);
        //$item = Support::find($request->support_num);
        $item = Support::where('support_num', $request->support_num)->first();
        return view('support.del', ['item' => $item]);
    }

    public function remove(Request $request)
    {
        //Person::find($request->id)->delete();
        //Support::find($request->support_num)->delete();
        $item = Support::where('support_num', $request->support_num)->delete();
        return redirect('/support');
    }
}
