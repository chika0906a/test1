<?php
//管理側のコントローラー
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\HelloRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Generaluser;
use App\Company;
use App\Companysupport;
use App\Support;

class ManagementController extends Controller
{
    //ログイン
    public function getAuth(Request $request)
   {
     $param =['message' => '管理者用ログイン画面'];
     return view('fresh.hello.auth', $param);
   }

   public function postAuth(Request $request)
   {
     $email = $request->email;
     $password = $request->password;
     if (Auth::attempt(['email' => $email,'password' => $password])) {
       $msg = 'ログインしました。(' . Auth::user()->name . ')';
       return view('fresh.hello.top', ['message' => $msg]);
     } else {
       $msg = 'ログインに失敗しました。';
     }
     //return view('hello.auth', ['message' => $msg]);
   }

   //トップページ
    public function top(Request $request) 
    {
    return view('fresh.hello.top');
    //$sort = $request->sort;
    //$items=Person::orderBy($sort, 'asc')
    //->simplePaginate(5);
    // $items=Generaluser::all()->simplePaginate(5);
    //$param = ['items' => $items, 'sort' => $sort,
    //'user' => $user];
    //return view('hello.index');
    }

    //一般ユーザーのメソッド
    public function generaluserindex(Request $request)
    {
        $items = Generaluser::all();
        //$items = User::all();
        $param = ['input' => '','items' => $items];
        return view('fresh.generaluser.index', ['items' => $items]);
    }

    public function generaluserfind(Request $request)
    {
        //$item = Person::where('name',$request->input)->first();
        $item = Generaluser::where('id',$request->input)->first();
        return view('fresh.generaluser.show', ['item' => $item]);
    }

    public function generalusershow(Request $request)
    {
        //$item = Person::where('id', $request->id)->first();
        $item = Generaluser::where('id', $request->id)->first();
        return view('fresh.generaluser.show', ['item' => $item]);
    }

    public function generaluseradd(Request $request)
    {
        return view('fresh.generaluser.add');
    }

    public function generalusercreate(Request $request)
    {
        $this->validate($request, Generaluser::$rules);
        //$person = new Person;
        $generaluser = new Generaluser;
        $form = $request->all();
        unset($form['_token']);
        //$person->fill($form)->save();
        $generaluser->fill($form)->save();
        return redirect('fresh/generaluser');
    }
    public function generaluseredit(Request $request)
    {
        //$item = Person::find($request->id);
        $item = Generaluser::find($request->id);
        return view('fresh.generaluser.edit', ['item' => $item]);
    }

    public function generaluserupdate(Request $request)
    {
        //$this->validate($request, Person::$rules);
        $this->validate($request, Generaluser::$rules);
        //$person = Person::find($request->id);
        $generaluser = Generaluser::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        //$person->fill($form)->save();
        $generaluser->fill($form)->save();
        return redirect('fresh/generaluser');
    }

    public function generaluserdel(Request $request)
    {
        //$item = Person::find($request->id);
        $item = Generaluser::where('id', $request->id)->first();
        return view('fresh.generaluser.del', ['item' => $item]);
    }

    public function generaluserremove(Request $request)
    {
        //Person::find($request->id)->delete();
        Company::where('id',$request->id)->delete();
        return redirect('fresh/generaluser');
    }



    //企業ユーザーのメソッド
    public function companyindex(Request $request)
    {
        //$items = Person::all();
        $items = Company::all();
        //$items = Generaluser::select('select * from generalusers');
        $param = ['input' => '','items' => $items];
        return view('fresh.company.index', $param);
    }

    public function companyfind(Request $request)
    {
        //$item = Person::where('name',$request->input)->first();
        $item = Company::where('company_id',$request->input)->first();
        return view('fresh.company.show', ['item' => $item]);
    }

    public function companyshow(Request $request)
    {
        //$item = Person::where('id', $request->id)->first();
        $item = Company::where('company_id', $request->company_id)->first();
        return view('fresh.company.show', ['item' => $item]);
    }

    public function companyadd(Request $request)
    {
        return view('fresh.company.add');
    }

    public function companycreate(Request $request)
    {
        $this->validate($request, Company::$rules);
        //$person = new Person;
        $company = new Company;
        $form = $request->all();
        unset($form['_token']);
        //$person->fill($form)->save();
        $company->fill($form)->save();
        return redirect('fresh/company');
    }
    public function companyedit(Request $request)
    {
        //$item = Person::find($request->id);
        $item = Company::find($request->company_id);
        return view('fresh.company.edit', ['item' => $item]);
    }

    public function companyupdate(Request $request)
    {
        //$this->validate($request, Person::$rules);
        $this->validate($request, Company::$rules);
        //$person = Person::find($request->id);
        $company = Company::find($request->company_id);
        $form = $request->all();
        unset($form['_token']);
        //$person->fill($form)->save();
        $company->fill($form)->save();
        return redirect('fresh/company');
    }

    public function companydel(Request $request)
    {
        //$item = Person::find($request->id);
        $item = Company::where('company_id', $request->company_id)->first();
        return view('fresh.company.del', ['item' => $item]);
    }

    public function companyremove(Request $request)
    {
        //Person::find($request->id)->delete();
        Company::where('company_id',$request->company_id)->delete();
        return redirect('fresh/company');
    }


    //お問い合わせ(企業ユーザー)のメソッド
    public function companysupportindex(Request $request)
    {
        //$items = Person::all();
        $items = Companysupport::all();
        //$items = Generaluser::select('select * from generalusers');
        $param = ['input' => '','items' => $items];
        return view('fresh.companysupport.index', $param);
    }

    public function companysupportfind(Request $request)
    {
        //$item = Person::where('name',$request->input)->first();
        $item = Companysupport::where('support_num',$request->input)->first();
        return view('fresh.companysupport.show', ['item' => $item]);
    }

    public function companysupportshow(Request $request)
    {
        //$item = Person::where('id', $request->id)->first();
        $item = Companysupport::where('support_num', $request->support_num)->first();
        return view('fresh.companysupport.show', ['item' => $item]);
    }

    public function companysupportadd(Request $request)
    {
        return view('fresh.companysupport.add');
    }

    public function companysupportcreate(Request $request)
    {
        $this->validate($request, Companysupport::$rules);
        //$person = new Person;
        $companysupport = new Companysupport;
        $form = $request->all();
        unset($form['_token']);
        //$person->fill($form)->save();
        $companysupport->fill($form)->save();
        return redirect('fresh/companysupport');
    }
    public function companysupportedit(Request $request)
    {
        //$item = Person::find($request->id);
        $item = Companysupport::find($request->support_num);
        return view('fresh.companysupport.edit', ['item' => $item]);
    }

    public function companysupportupdate(Request $request)
    {
        //$this->validate($request, Person::$rules);
        $this->validate($request, Companysupport::$rules);
        //$person = Person::find($request->id);
        $companysupport = Companysupport::find($request->support_num);
        $form = $request->all();
        unset($form['_token']);
        //$person->fill($form)->save();
        $companysupport->fill($form)->save();
        return redirect('fresh/companysupport');
    }

    public function companysupportdel(Request $request)
    {
        //$item = Person::find($request->id);
        $item = Companysupport::where('support_num', $request->support_num)->first();
        return view('fresh.companysupport.del', ['item' => $item]);
    }

    public function companysupportremove(Request $request)
    {
        //Person::find($request->id)->delete();
        Companysupport::where('support_num', $request->support_num)->delete();
        return redirect('fresh/companysupport');
    }

    //お問い合わせ(一般ユーザー)のメソッド
    public function supportindex(Request $request)
    {
        //$items = Person::all();
        $items = Support::all();
        //$items = Generaluser::select('select * from generalusers');
        $param = ['input' => '','items' => $items];
        return view('fresh.support.index', $param);
    }

    public function supportfind(Request $request)
    {
        //$item = Person::where('name',$request->input)->first();
        $item = Support::where('support_num',$request->input)->first();
        return view('fresh.support.show', ['item' => $item]);
    }

    public function supportshow(Request $request)
    {
        //$item = Person::where('id', $request->id)->first();
        $item = Support::where('support_num', $request->support_num)->first();
        return view('fresh.support.show', ['item' => $item]);
    }

    public function supportadd(Request $request)
    {
        return view('fresh.support.add');
    }

    public function supportcreate(Request $request)
    {
        $this->validate($request, Support::$rules);
        //$person = new Person;
        $support = new Support;
        $form = $request->all();
        unset($form['_token']);
        //$person->fill($form)->save();
        $support->fill($form)->save();
        return redirect('fresh/support');
    }
    public function supportedit(Request $request)
    {
        //$item = Person::find($request->id);
        $item = Support::find($request->support_num);
        return view('fresh.support.edit', ['item' => $item]);
    }

    public function supportupdate(Request $request)
    {
        //$this->validate($request, Person::$rules);
        $this->validate($request, Support::$rules);
        //$person = Person::find($request->id);
        $support = Support::find($request->support_num);
        $form = $request->all();
        unset($form['_token']);
        //$person->fill($form)->save();
        $support->fill($form)->save();
        return redirect('fresh/support');
    }

    public function supportdel(Request $request)
    {
        //$item = Person::find($request->id);
        //$item = Support::find($request->support_num);
        $item = Support::where('support_num', $request->support_num)->first();
        return view('fresh.support.del', ['item' => $item]);
    }

    public function supportremove(Request $request)
    {
        //Person::find($request->id)->delete();
        //Support::find($request->support_num)->delete();
        $item = Support::where('support_num', $request->support_num)->delete();
        return redirect('fresh/support');
    }
}
