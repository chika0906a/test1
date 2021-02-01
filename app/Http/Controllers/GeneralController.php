<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ingredient;
use App\Models\Generaluser;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Http\Requests\HelloRequest;
use Validator;
use App\Person;
use Carbon\Carbon;

class GeneralController extends Controller
{
    //ログイン画面
    public function getAuth(Request $request)
    {
        $message = 'ユーザーログイン画面';
        return view('fresh.auth', ['message' => $message]);
    }

    //ログイン認証
    public function postAuth(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email,'password' => $password])) {
            $request->session()->put('usermail', $email);
            return view('fresh.generalmypage');
        } else {
            $request->session()->put('usermail', $email);
            return view('fresh.generalmypage');
        }
    }

    public function generalmypage(Request $request)
    {
        //station_idごとにお知らせを表示(ex.横浜駅の近くに住んでいる人に対し横浜駅周辺のお店の情報を送る。)
        //ユーザーのメールアドレスを取得
        $param = ['email' => $request->session()->get('usermail')];
        $items = DB::select('SELECT DISTINCT company_name, info_title, info_text, day
            FROM info, companies, generalusers
                WHERE info.mail = companies.company_mail AND
                info.station_id = generalusers.station_id AND 
                generalusers.email = :email', $param);
                $param = ['mail' => $request->session()->get('usermail')];
        return view('fresh.generalmypage', ['items' => $items]);
    }

    public function signupadd(Request $request)
    {
        return view('signup.add');  //viewの表示
    }

    public function signupcreate(Request $request)
    {
        $param = [
            'name' => $request->name,
            'email' => $request->email,'password' => $request->password,'gender' => $request->gender,'date' => $request->date,'station_id' => $request->station_id,'people_ind' => $request->people_ind,];
            DB::table('generalusers')->insert($param); 
            return view('signup.done');
        }

    //買い物リストトップ画面
    public function orderstop(Request $request)
    {
        //ユーザーのメールアドレスを取得
        $param = ['mail' => $request->session()->get('usermail')];
        //ユーザー毎の買い物リストのデータを抽出
        $items = DB::select('select * from orders inner join ingredients on orders.ingredients_id = ingredients.ingredients_id where orders.mail = :mail', $param);
        return view('fresh.order.orderstop', ['items' => $items]);
    }

    //買い物リスト追加画面表示
    public function ordersadd(Request $request)
    {
        //ユーザーのメールアドレスを取得
        $mail = $request->session()->get('usermail');
        return view('fresh.order.ordersadd', ['mail' => $mail]);
    }

    
    //野菜の買い物リスト追加画面表示
    public function vegeadd2(Request $request)
    {
        $items = DB::select('select * from ingredients where ingredients_category = "野菜"');
            return view('fresh.order.vegetable2')->with(['items' => $items]);
    }

    //肉の買い物リスト追加画面表示
    public function meatadd2(Request $request)
    {
        $items = DB::select('select * from ingredients where ingredients_category = "肉"');
            return view('fresh.order.meat2')->with(['items' => $items]);
    }

    //魚の買い物リスト追加画面表示
    public function fishadd2(Request $request)
    {
        $items = DB::select('select * from ingredients where ingredients_category = "魚"');
            return view('fresh.order.fish2')->with(['items' => $items]);
    }

    //乳製品の買い物リスト追加画面表示
    public function dairyadd2(Request $request)
    {
        $items = DB::select('select * from ingredients where ingredients_category = "乳製品"');
            return view('fresh.order.dairy2')->with(['items' => $items]);
    }

    //その他の買い物リスト追加画面表示
    public function otheradd2(Request $request)
    {
        $items = DB::select('select * from ingredients where ingredients_category = "その他"');
            return view('fresh.order.other2')->with(['items' => $items]);
    }


    //買い物リストへの追加
    public function ordercreate(Request $request)
    {
        //チェックボックスで選択した食材の配列を取得
        $items = $request->input('itemsarray');
        foreach((array)$items as $item){
            $param = [
                'mail' => $request->session()->get('usermail'),
                'ingredients_id' => $item,
                'quantity' => $request->quantity[$item],
            ];
            //ユーザーのメールアドレス・食材ID・数量をordersテーブルに保存
            DB::table('orders')->insert($param);
        }
        //食材リストトップ画面にリダイレクト」
        return redirect('fresh/orders');
    }

    //買い物リスト削除画面
    public function ordersdel(Request $request)
    {
        //ユーザーのメールアドレスを取得
        $param = ['mail' => $request->session()->get('usermail')];
        //ユーザー毎の買い物リストのデータを抽出
        $items = DB::select('select * from orders inner join ingredients on orders.ingredients_id = ingredients.ingredients_id where orders.mail = :mail', $param);
        return view('fresh.order.ordersdel', ['items' => $items]);
    }

    //買い物リストから削除
    public function ordersremove(Request $request)
    {
        //ユーザーのメールアドレスを取得
        $mail = $request->session()->get('usermail');
        //チェックされた食材の配列を取得
        $items2 = $request->input('itemsarray');
        //食材分ループし、削除
        foreach((array)$items2 as $item2){
            DB::delete("delete from orders where ingredients_id = '$item2' and mail = '$mail'");
        };
        //買い物リストトップ画面にリダイレクト
        return redirect('/fresh/orders');
    }

    //買い物リストの購入チェック画面を表示
    public function ordersbuy(Request $request){
        //ユーザーのメールアドレスを取得
        $param = ['mail' => $request->session()->get('usermail')];
        //ユーザー毎の買い物リストのデータを抽出
        $items = DB::select('select * from orders inner join ingredients on orders.ingredients_id = ingredients.ingredients_id where orders.mail = :mail', $param);
        return view('fresh.order.orderbuy', ['items' => $items]);
    }

    //買い物リストの購入チェック
    public function ordersbuycheck(Request $request){
        //ユーザーのメールアドレスを取得
        $mail = $request->session()->get('usermail');
        $day = now()->format('Y-m-d');
        //チェックされた食材の配列を取得
        $items2 = $request->input('itemsarray');
        //食材分ループし、削除
        foreach((array)$items2 as $item2){
            $company_id = DB::table('companies')->select('company_id')->where('company_name', $request->company_name);
            $param = [
                'mail' => $mail,
                'day' => $day,
                'ingredients_id' => $item2,
                'quantity' => $request->quantity[$item2],
                'company_id' => $company_id,
            ]; 
            DB::table('shopping_history')->insert($param);
            DB::delete("delete from orders where ingredients_id = '$item2' and mail = '$mail'");
        };
        //買い物リストトップ画面にリダイレクト
        return redirect('/fresh/orders');
    }
    //冷蔵庫の在庫一覧
    public function stocktop(Request $request)
    {
        //ユーザーのメールアドレスを取得
        $param = ['mail' => $request->session()->get('usermail')];
        //ユーザー毎の冷蔵庫の在庫のデータを抽出
        $items = DB::select('select * from stocks inner join ingredients on stocks.ingredients_id = ingredients.ingredients_id where stocks.mail = :mail', $param);
        return view('fresh.stock.stocktop', ['items' => $items]);
    }

    //冷蔵庫の野菜の在庫を表示
    public function vegeview(Request $request)
    {
        $param = ['mail' => $request->session()->get('usermail')];
        $items = DB::select('SELECT * from stocks INNER JOIN ingredients ON stocks.ingredients_id = ingredients.ingredients_id WHERE ingredients_category = "野菜" AND stocks.mail = :mail', $param);
            return view('fresh.stock.vegeview')->with(['items' => $items]);
    }

    //冷蔵庫の肉の在庫を表示
    public function meatview(Request $request)
    {
        $param = ['mail' => $request->session()->get('usermail')];
        $items = DB::select('SELECT * from stocks INNER JOIN ingredients ON stocks.ingredients_id = ingredients.ingredients_id WHERE ingredients_category = "肉" AND stocks.mail = :mail', $param);
            return view('fresh.stock.meatview')->with(['items' => $items]);
    }

    //冷蔵庫の魚の在庫を表示
    public function fishview(Request $request)
    {
        $param = ['mail' => $request->session()->get('usermail')];
        $items = DB::select('SELECT * from stocks INNER JOIN ingredients ON stocks.ingredients_id = ingredients.ingredients_id WHERE ingredients_category = "魚" AND stocks.mail = :mail', $param);
            return view('fresh.stock.fishview')->with(['items' => $items]);
    }

    //冷蔵庫の乳製品の在庫を表示
    public function dairyview(Request $request)
    {
        $param = ['mail' => $request->session()->get('usermail')];
        $items = DB::select('SELECT * from stocks INNER JOIN ingredients ON stocks.ingredients_id = ingredients.ingredients_id WHERE ingredients_category = "乳製品" AND stocks.mail = :mail', $param);
            return view('fresh.stock.dairyview')->with(['items' => $items]);
    }

    //冷蔵庫のその他の在庫を表示
    public function otherview(Request $request)
    {
        $param = ['mail' => $request->session()->get('usermail')];
        $items = DB::select('SELECT * from stocks INNER JOIN ingredients ON stocks.ingredients_id = ingredients.ingredients_id WHERE ingredients_category = "その他" AND stocks.mail = :mail', $param);
            return view('fresh.stock.otherview')->with(['items' => $items]);
    }

    //在庫登録（手入力）画面表示
    public function stockaddtop(Request $request)
    {
        return view('fresh.stock.stockadd');
    }

    //野菜の在庫追加画面表示
    public function vegeadd(Request $request)
    {
        $items = DB::select('select * from ingredients where ingredients_category = "野菜"');
            return view('fresh.stock.vegetable')->with(['items' => $items]);
    }

    //肉の在庫追加画面表示
    public function meatadd(Request $request)
    {
        $items = DB::select('select * from ingredients where ingredients_category = "肉"');
            return view('fresh.stock.meat')->with(['items' => $items]);
    }

    //魚の在庫追加画面表示
    public function fishadd(Request $request)
    {
        $items = DB::select('select * from ingredients where ingredients_category = "魚"');
            return view('fresh.stock.fish')->with(['items' => $items]);
    }

    //乳製品の在庫追加画面表示
    public function dairyadd(Request $request)
    {
        $items = DB::select('select * from ingredients where ingredients_category = "乳製品"');
            return view('fresh.stock.dairy')->with(['items' => $items]);
    }

    //その他の在庫追加画面表示
    public function otheradd(Request $request)
    {
        $items = DB::select('select * from ingredients where ingredients_category = "その他"');
            return view('fresh.stock.other')->with(['items' => $items]);
    }

    //在庫追加
    public function stockcreate(Request $request)
    {
        //チェックボックスで選択された食材の配列を取得
        $items = $request->input('itemsarray');
        foreach((array)$items as $item){
            $param = [
                'mail' => $request->session()->get('usermail'),
                'ingredients_id' => $item,
                'quantity' => $request->quantity[$item],
            ];
            //ユーザーのメールアドレス・食材リスト・数量をstocksテーブルに保存
            DB::table('stocks')->insert($param);
        }
        return redirect('fresh/stockaddtop');
    }

    //在庫の数量変更画面(更新画面）
    public function stockedit(Request $request)
    {
        //ユーザーのメールアドレスを取得
        $param = ['mail' => $request->session()->get('usermail')];
        //ユーザー毎の冷蔵庫の在庫のデータを取得
        $items = DB::select('select * from stocks inner join ingredients on stocks.ingredients_id = ingredients.ingredients_id where stocks.mail = :mail', $param);
        return view('fresh.stock.stockedit', ['items' => $items]);
    }

    //野菜の在庫の更新画面を表示
    public function vegeedit(Request $request)
    {
        $param = ['mail' => $request->session()->get('usermail')];
        $items = DB::select('SELECT * from stocks INNER JOIN ingredients ON stocks.ingredients_id = ingredients.ingredients_id WHERE ingredients_category = "野菜" AND stocks.mail = :mail', $param);
            return view('fresh.stock.vegeedit', ['items' => $items]);
    }
    
    //肉の在庫の更新画面を表示
    public function meatedit(Request $request)
    {
        $param = ['mail' => $request->session()->get('usermail')];
        $items = DB::select('SELECT * from stocks INNER JOIN ingredients ON stocks.ingredients_id = ingredients.ingredients_id WHERE ingredients_category = "肉" AND stocks.mail = :mail', $param);
            return view('fresh.stock.meatedit', ['items' => $items]);
    }
    
    //魚の在庫の更新画面を表示
    public function fishedit(Request $request)
    {
        $param = ['mail' => $request->session()->get('usermail')];
        $items = DB::select('SELECT * from stocks INNER JOIN ingredients ON stocks.ingredients_id = ingredients.ingredients_id WHERE ingredients_category = "魚" AND stocks.mail = :mail', $param);
            return view('fresh.stock.fishedit', ['items' => $items]);
    }

    //乳製品の在庫の更新画面を表示
    public function dairyedit(Request $request)
    {
        $param = ['mail' => $request->session()->get('usermail')];
        $items = DB::select('SELECT * from stocks INNER JOIN ingredients ON stocks.ingredients_id = ingredients.ingredients_id WHERE ingredients_category = "乳製品" AND stocks.mail = :mail', $param);
            return view('fresh.stock.dairyedit', ['items' => $items]);
    }

    //その他の在庫の更新画面を表示
    public function otheredit(Request $request)
    {
        $param = ['mail' => $request->session()->get('usermail')];
        $items = DB::select('SELECT * from stocks INNER JOIN ingredients ON stocks.ingredients_id = ingredients.ingredients_id WHERE ingredients_category = "その他" AND stocks.mail = :mail', $param);
            return view('fresh.stock.otheredit', ['items' => $items]);
    }

    //在庫の数量変更(更新)
    public function stockupdate(Request $request)
    {
        //チェックボックスで選択された食材の配列を取得
        $items = $request->input('itemsarray');
        foreach((array)$items as $item){
            $ingredients_id = $item;
            $param = [
                'quantity' => $request->quantity[$item],
            ];
            //stocksテーブルからメールアドレスと食材IDが一致するデータを抽出、
            //新しい数量を保存
            DB::table('stocks')->where('mail', $request->session()->get('usermail'))->where('ingredients_id', $ingredients_id)->update($param);
        }
        //冷蔵庫の中身一覧にリダイレクト
        return redirect('fresh/stocktop');
    }

    //冷蔵庫の在庫の削除画面
    public function stockdel(Request $request)
    {
        //ユーザーのメールアドレスを取得
        $param = ['mail' => $request->session()->get('usermail')];
        //ユーザー毎の冷蔵庫の在庫のデータを抽出
        $items = DB::select('select * from stocks inner join ingredients on stocks.ingredients_id = ingredients.ingredients_id where stocks.mail = :mail', $param);
        return view('fresh.stock.stockdel', ['items' => $items]);
    }

    //野菜の在庫の削除画面
    public function vegedel(Request $request)
    {
        //ユーザーのメールアドレスを取得
        $param = ['mail' => $request->session()->get('usermail')];
        //ユーザー毎の冷蔵庫の在庫のデータを抽出
        $items = DB::select('SELECT * from stocks INNER JOIN ingredients ON stocks.ingredients_id = ingredients.ingredients_id WHERE ingredients_category = "野菜" AND stocks.mail = :mail', $param);
        return view('fresh.stock.vegedel', ['items' => $items]);
    }

    //肉の在庫の削除画面
    public function meatdel(Request $request)
    {
        //ユーザーのメールアドレスを取得
        $param = ['mail' => $request->session()->get('usermail')];
        //ユーザー毎の冷蔵庫の在庫のデータを抽出
        $items = DB::select('SELECT * from stocks INNER JOIN ingredients ON stocks.ingredients_id = ingredients.ingredients_id WHERE ingredients_category = "肉" AND stocks.mail = :mail', $param);
        return view('fresh.stock.meatdel', ['items' => $items]);
    }

    //魚の在庫の削除画面
    public function fishdel(Request $request)
    {
        //ユーザーのメールアドレスを取得
        $param = ['mail' => $request->session()->get('usermail')];
        //ユーザー毎の冷蔵庫の在庫のデータを抽出
        $items = DB::select('SELECT * from stocks INNER JOIN ingredients ON stocks.ingredients_id = ingredients.ingredients_id WHERE ingredients_category = "魚" AND stocks.mail = :mail', $param);
        return view('fresh.stock.fishdel', ['items' => $items]);
    }

    //乳製品の在庫の削除画面
    public function dairydel(Request $request)
    {
        //ユーザーのメールアドレスを取得
        $param = ['mail' => $request->session()->get('usermail')];
        //ユーザー毎の冷蔵庫の在庫のデータを抽出
        $items = DB::select('SELECT * from stocks INNER JOIN ingredients ON stocks.ingredients_id = ingredients.ingredients_id WHERE ingredients_category = "乳製品" AND stocks.mail = :mail', $param);
        return view('fresh.stock.dairydel', ['items' => $items]);
    }

    //その他の在庫の削除画面
    public function otherdel(Request $request)
    {
        //ユーザーのメールアドレスを取得
        $param = ['mail' => $request->session()->get('usermail')];
        //ユーザー毎の冷蔵庫の在庫のデータを抽出
        $items = DB::select('SELECT * from stocks INNER JOIN ingredients ON stocks.ingredients_id = ingredients.ingredients_id WHERE ingredients_category = "その他" AND stocks.mail = :mail', $param);
        return view('fresh.stock.otherdel', ['items' => $items]);
    }

    //冷蔵庫の在庫の削除
    public function stockremove(Request $request)
    {
        //ユーザーのメールアドレスを取得
        $mail = $request->session()->get('usermail');
        //チェックされた食材の配列を取得
        $items2 = $request->input('itemsarray');
        //食材分ループし、削除
        foreach($items2 as $item2){
            DB::delete("delete from stocks where ingredients_id = '$item2' and mail = '$mail'");
        }
        //冷蔵庫の中身一覧にリダイレクト
        return redirect('/fresh/stocktop');
    }

    

    public function searchdate(Request $request)
    {
        $date = Carbon::now()->toDateTimeString();
        return view('fresh.recipe.date',['date'=>$date]);
    }

    public function recipesearch(Request $request)
    {
        if($request->isMethod('post'))
        {
            $recipearray = [];
            $items = DB::select('SELECT DISTINCT recipe_name
            FROM recipetitle, stocks, recipedetails 
                WHERE stocks.ingredients_id = recipedetails.ingredients_id AND
                recipedetails.recipe = recipetitle.recipe');
                //日付のデータ 
            foreach ($items as $item){
                $recipearray[] = $item->recipe_name;
            }
            $date = $request->input('theDate');
            //日の数
            $count = $request->input('count');
        }
        $data = [
            'date' => $date,
            'count'=> $count,
            'recipearray' => $recipearray,
        ];
        return view('fresh.recipe.recipesearch', $data);
    }

    public function confirmmenus(Request $request)
    {
        if($request->isMethod('post'))
        {
            $recipe = $request->input('recipe');
            $date = $request->input('theDate');
            $count = $request->input('count');
            $menusdate = [];
            $menusrecipe = [];
            for($i=0;$i<($count);$i++){
                $menusdate[] = $date;
                $menusrecipe[] = $recipe[$date ++];
            }
            $data = [
                'count' => $count,
                'date' => $menusdate,
                'recipe' => $menusrecipe
            ];
        }
            return view('fresh.recipe.confirmmenus', $data);       
    }

    public function menuscreate(Request $request)
    {
        //チェックボックスで選択された食材の配列を取得
        $items = $request->input('date');
        foreach((array)$items as $item){
            $param1 = ['recipe_name' => $request->recipe[$item]];
            $recipe_id = DB::select('SELECT recipe FROM recipetitle where recipe_name = :recipe_name', $param1);
            $recipe_id2 = DB::table($recipe_id)->first()->get('recipe');

            $param = [
                'mail' => $request->session()->get('usermail'),
                'day' => $item,
                'recipe' => $recipe_id2,
            ];
            //ユーザーのメールアドレス・食材リスト・数量をstocksテーブルに保存
            DB::table('menus')->insert($param);
        }
        return redirect('/end');
    }
    public function end(Request $request)
    {
        return view('fresh.recipe.recipesearch.end');
    }


    //献立表示日にち選択画面表示
    public function menufind(Request $request)
    {
        return view('fresh.menu.choice',['input' => '']);
    }

    //献立表示
    public function menusearch(Request $request)
    {
        $param = [
                    'day' => $request->input,
                    'mail' => $request->session()->get('usermail'),
                ];
        $joi = DB::select('select * from menus inner join recipetitle on menus.recipe = recipetitle.recipe inner join recipedetails on recipetitle.recipe = recipedetails.recipe inner join ingredients on recipedetails.ingredients_id = ingredients.ingredients_id inner join users on menus.mail = users.email where menus.day = :day and menus.mail = :mail',$param); 

        return view('fresh.menu.choice', ['items' => $joi]);

    }

        
    //お問い合わせ入力画面表示
    public function supportquestion()
    {
        return view('fresh.support.question');
    }

    //お問い合わせ内容をサポートテーブルに保存
    public function supportcreate(Request $request)
    {
        $param = [
            'mail' => $request->mail,
            'support_mail' => $request->support_mail,
            'day' => $request->day,
            'support_text' => $request->support_text,
        ];
        DB::table('support')->insert($param);

        return view('fresh.support.complete');
    }

    //送信完了画面（お問い合わせ）
    public function supportcomplete()
    {
        return view('fresh.support.complete');
    }

    //マイページ編集
    public function mypageedit()
    {
        $data = [
            'msg'=>'',
        ];
        return view('fresh.mypage.input', $data);
    }

    public function mypageupdate(Request $request)
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
        $validator = Validator::make($request->all(),$rules,$message);
        if ($validator->fails()) {
            return redirect('/mypageedit')
                ->withErrors($validator)
                ->withInput();
        }

        //全データの取得
        $data = $request->all();

        return view('fresh.mypage.output', ['data' => $data]);
    }
}
