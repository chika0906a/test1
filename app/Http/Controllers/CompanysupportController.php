<?php

namespace App\Http\Controllers;

use App\Companysupport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanysupportController extends Controller
{
    public function index(Request $request)
    {
        //$items = Person::all();
        $items = Companysupport::all();
        //$items = Generaluser::select('select * from generalusers');
        $param = ['input' => '','items' => $items];
        return view('companysupport.index', $param);
    }

    public function find(Request $request)
    {
        //$item = Person::where('name',$request->input)->first();
        $item = Companysupport::where('support_num',$request->input)->first();
        return view('companysupport.show', ['item' => $item]);
    }

    public function show(Request $request)
    {
        //$item = Person::where('id', $request->id)->first();
        $item = Companysupport::where('support_num', $request->support_num)->first();
        return view('companysupport.show', ['item' => $item]);
    }

    public function add(Request $request)
    {
        return view('companysupport.add');
    }

    public function create(Request $request)
    {
        $this->validate($request, Companysupport::$rules);
        //$person = new Person;
        $companysupport = new Companysupport;
        $form = $request->all();
        unset($form['_token']);
        //$person->fill($form)->save();
        $companysupport->fill($form)->save();
        return redirect('/companysupport');
    }
    public function edit(Request $request)
    {
        //$item = Person::find($request->id);
        $item = Companysupport::find($request->support_num);
        return view('companysupport.edit', ['item' => $item]);
    }

    public function update(Request $request)
    {
        //$this->validate($request, Person::$rules);
        $this->validate($request, Companysupport::$rules);
        //$person = Person::find($request->id);
        $companysupport = Companysupport::find($request->support_num);
        $form = $request->all();
        unset($form['_token']);
        //$person->fill($form)->save();
        $companysupport->fill($form)->save();
        return redirect('/companysupport');
    }

    public function del(Request $request)
    {
        //$item = Person::find($request->id);
        $item = Companysupport::where('support_num', $request->support_num)->first();
        return view('companysupport.del', ['item' => $item]);
    }

    public function remove(Request $request)
    {
        //Person::find($request->id)->delete();
        Companysupport::where('support_num', $request->support_num)->delete();
        return redirect('/companysupport');
    }
}
