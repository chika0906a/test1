<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ingredient;
use App\Models\Generaluser;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    public function getAuth(Request $request)
    {
        $msg = 'ログインしてください。';
        return view('fresh.generallogin', ['msg' => $msg]);
    }

    public function postAuth(Request $request)
    {
        $mail = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $mail, 'password' => $password])){
            return view('fresh.generalmypage');
        } else {
            return view('fresh.generalmypage');
        }
    }

    public function mypage()
    {
        return view('fresh.generalmypage');
    }

    public function orderstop(Request $request)
    {
        $param = ['mail' => $request->mail];
        $items = DB::select('select * from orders inner join ingredients on orders.ingredients_id = ingredients.ingredients_id where orders.mail = :mail', $param);
        return view('fresh.orderstop', ['items' => $items]);
    }

    public function ordersadd(Request $request)
    {
        $mail = $request->mail;
        return view('fresh.ordersadd', ['mail' => $mail]);
    }

    public function ordersaddchoice(Request $request)
    {
        if($request->vegetable){
            $mail = $request->mail;
            $items = DB::select('select * from ingredients where ingredients_category = "野菜"');
            return view('fresh.vegetable2')->with(['items' => $items, 'mail' => $mail]);
        } elseif($request->meat){
            $mail = $request->mail;
            $items = DB::select('select * from ingredients where ingredients_category = "肉"');
            return view('fresh.meat2')->with(['items' => $items, 'mail' => $mail]);
        } elseif($request->fish){
            $mail = $request->mail;
            $items = DB::select('select * from ingredients where ingredients_category = "魚"');
            return view('fresh.fish2')->with(['items' => $items, 'mail' => $mail]);
        } elseif($request->dairy){
            $mail = $request->mail;
            $items = DB::select('select * from ingredients where ingredients_category = "乳製品"');
            return view('fresh.dairy2')->with(['items' => $items, 'mail' => $mail]);
        } elseif($request->other) {
            $mail = $request->mail;
            $items = DB::select('select * from ingredients where ingredients_category = "その他"');
            return view('fresh.other2')->with(['items' => $items, 'mail' => $mail]);
        }
    }

    public function ordercreate(Request $request)
    {
        $items = $request->input('itemsarray');
        foreach((array)$items as $item){
            $param = [
                'mail' => $request->mail,
                'ingredients_id' => $item,
                'quantity' => $request->quantity[$item],
            ];
            DB::table('orders')->insert($param);
        }
        return redirect('fresh/orders?mail=aiueo@mail');
    }

    public function ordersdel(Request $request)
    {
        $param = ['mail' => $request->mail];
        $items = DB::select('select * from orders inner join ingredients on orders.ingredients_id = ingredients.ingredients_id where orders.mail = :mail', $param);
        return view('fresh.ordersdel', ['items' => $items]);
    }

    public function ordersremove(Request $request)
    {
        $mail = $request->mail;
        $items2 = $request->input('itemsarray');
        foreach($items2 as $item2){
            DB::delete("delete from orders where ingredients_id = '$item2'");
        }
        return redirect('/fresh/orders?mail=aiueo@mail');
    }

    public function stockaddtop(Request $request)
    {
        $mail = $request->mail;
        return view('fresh.stockadd', ['mail' => $mail]);
    }

    public function stockadd(Request $request)
    {
        if($request->vegetable){
            $mail = $request->mail;
            $items = DB::select('select * from ingredients where ingredients_category = "野菜"');
            return view('fresh.vegetable')->with(['items' => $items, 'mail' => $mail]);
        } elseif($request->meat){
            $mail = $request->mail;
            $items = DB::select('select * from ingredients where ingredients_category = "肉"');
            return view('fresh.meat')->with(['items' => $items, 'mail' => $mail]);
        } elseif($request->fish){
            $mail = $request->mail;
            $items = DB::select('select * from ingredients where ingredients_category = "魚"');
            return view('fresh.fish')->with(['items' => $items, 'mail' => $mail]);
        } elseif($request->dairy){
            $mail = $request->mail;
            $items = DB::select('select * from ingredients where ingredients_category = "乳製品"');
            return view('fresh.dairy')->with(['items' => $items, 'mail' => $mail]);
        } elseif($request->other) {
            $mail = $request->mail;
            $items = DB::select('select * from ingredients where ingredients_category = "その他"');
            return view('fresh.other')->with(['items' => $items, 'mail' => $mail]);
        }
    }

    public function stockcreate(Request $request)
    {
        $items = $request->input('itemsarray');
        foreach((array)$items as $item){
            $param = [
                'mail' => $request->mail,
                'ingredients_id' => $item,
                'quantity' => $request->quantity[$item],
            ];
            DB::table('stocks')->insert($param);
        }
        return redirect('fresh/stockaddtop?mail=aiueo@mail');
    }

    
    public function stocktop(Request $request)
    {
        $param = ['mail' => $request->mail];
        $items = DB::select('select * from stocks inner join ingredients on stocks.ingredients_id = ingredients.ingredients_id where stocks.mail = :mail', $param);
        return view('fresh.stocktop', ['items' => $items]);
    }

    public function stockedit(Request $request)
    {
        $param = ['mail' => $request->mail];
        $items = DB::select('select * from stocks inner join ingredients on stocks.ingredients_id = ingredients.ingredients_id where stocks.mail = :mail', $param);
        return view('fresh.stockedit', ['items' => $items]);
    }

    public function stockupdate(Request $request)
    {
        $items = $request->input('itemsarray');
        foreach((array)$items as $item){
            $param = [
                'ingredients_id' => $item,
                'quantity' => $request->quantity[$item],
            ];
            DB::table('stocks')->where('mail', $request->mail)->update($param);
        }
        return redirect('fresh/stocktop?mail=aiueo@mail');
    }

    public function stockdel(Request $request)
    {
        $param = ['mail' => $request->mail];
        $items = DB::select('select * from stocks inner join ingredients on stocks.ingredients_id = ingredients.ingredients_id where stocks.mail = :mail', $param);
        return view('fresh.stockdel', ['items' => $items]);
    }

    public function stockremove(Request $request)
    {
        $mail = $request->mail;
        $items2 = $request->input('itemsarray');
        foreach($items2 as $item2){
            DB::delete("delete from stocks where ingredients_id = '$item2'");
        }
        return redirect('/fresh/stocktop?mail=aiueo@mail');
    }
}
