<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\SupportRequest;
use App\Http\Requests\ResetmailRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Carbon\Carbon;

class TeamcController extends Controller
{
    public function getAuth(Request $request)
    {
        $msg = 'ログインしてください。';
        return view('fresh.login', ['msg' => $msg]);
    }

    public function postAuth(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])){
            return view('fresh.companymypage');
        } else {
            return view('fresh.companymypage');
        }
    }

    public function mypage() {
        return view('fresh.companymypage');
    }

    public function new(Request $request)
    {
        return view('company.signup');
    }
    public function create2(Request $request)
    {
        $param = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,    
        ];
        DB::table('users')->insert($param);
        
        return view('signup.done');
    }

    public function areachoice()
    {
        $data = [
            'msg'=>'',
        ];
        return view('fresh.area.input', $data);
    }

    public function areaview(Request $request)
    {
        //選択した条件を取得
        $ingredients_id = $request->ingredients_id;
        $area_name = $request->area_name;
        $people_ind = $request->people_ind;
        $gender = $request->gender;

        //性別未選択の場合
        if($gender == 'noans'){
            $genderfree = true;
        }

        //同居人数未選択の場合
        if($people_ind == 0){
            $peoplefree = true;
        }

        //エリア未選択の場合
        if($area_name == "noarea")
        {
            $areafree = true;
        }

        //条件の年代が何歳から何歳までか計算
        $reqage1 = $request->agechoice;
        $reqage2 = $reqage1 + 10;
        //年代未選択の場合
        if($reqage1 == 0){
            $agefree = true;
        }
        //今日の日付を取得
        $age0 = Carbon::now();
        //条件の年代の誕生日を計算(age1～age2)
        $age1 = $age0->copy()->subYear($reqage1)->toDateString();
        $age2 = $age0->copy()->subYear($reqage2)->addDay()->toDateString();

        //開始日と終了日から日数を計算
        $date1 = new Carbon($request->startdate);
        $date2 = new Carbon($request->enddate);
        $count = $date1->diffInDays($date2);
        $i = 1;

        //shopping_historyテーブルからデータを取得
        $history = DB::table('shopping_history');

        //条件に合致するデータを購入日付を問わず抽出
        $item0 = $history
                ->join('users', 'shopping_history.mail', '=', 'users.email')
                ->join('areas', 'users.area_id', '=', 'areas.area_id')
                ->where('shopping_history.ingredients_id', $ingredients_id);

        if($genderfree && $areafree && $agefree && $peoplefree){
            //全部未選択
            $item99 = $item0;
        } elseif($genderfree && $areafree && $agefree && $peoplefree==false){
            //同居人数だけ選択
            $item99 = $item0->where('users.people_ind', $people_ind);
        } elseif($genderfree && $areafree && $agefree==false && $peoplefree){
            //年代だけ選択
            $item99 = $item0
                        ->where('users.date', '>=', $age2)
                        ->where('users.date', '<=', $age1);
        } elseif($genderfree && $areafree==false && $agefree && $peoplefree){
            //エリアだけ選択
            $item99 = $item0->where('areas.area_name', $area_name);
        } elseif($genderfree==false && $areafree && $agefree && $peoplefree){
            //性別だけ選択
            $item99 = $item0->where('users.gender', $gender);
        } elseif($genderfree && $areafree && $agefree==false && $peoplefree==false){
            //年代・同居人数を選択
            $item99 = $item0
                        ->where('users.people_ind', $people_ind)
                        ->where('users.date', '>=', $age2)
                        ->where('users.date', '<=', $age1);
        } elseif($genderfree && $areafree==false && $agefree && $peoplefree==false){
            //エリア・同居人数を選択
            $item99 = $item0
                        ->where('areas.area_name', $area_name)
                        ->where('users.people_ind', $people_ind);
        } elseif($genderfree==false && $areafree && $agefree && $peoplefree==false){
            //性別・同居人数を選択
            $item99 = $item0
                        ->where('users.gender', $gender)
                        ->where('users.people_ind', $people_ind);
        } elseif($genderfree && $areafree==false && $agefree==false && $peoplefree){
            //エリア・年代を選択
            $item99 = $item0
                        ->where('areas.area_name', $area_name)
                        ->where('users.date', '>=', $age2)
                        ->where('users.date', '<=', $age1);
        } 
        if($agefree){
            //年代だけ未選択
            $items99 = $history
                ->join('users', 'shopping_history.mail', '=', 'users.email')
                ->join('areas', 'users.area_id', '=', 'areas.area_id')
                ->where('shopping_history.ingredients_id', $ingredients_id)
                ->where('areas.area_name', $area_name)
                ->where('users.people_ind', $people_ind)
                ->where('users.gender', $gender);
        } else {
            //全部選択した場合
            $items99 = $history
                    ->join('users', 'shopping_history.mail', '=', 'users.email')
                    ->join('areas', 'users.area_id', '=', 'areas.area_id')
                    ->where('shopping_history.ingredients_id', $ingredients_id)
                    ->where('areas.area_name', $area_name)
                    ->where('users.people_ind', $people_ind)
                    ->where('users.gender', $gender)
                    ->where('users.date', '>=', $age2)
                    ->where('users.date', '<=', $age1);
        }
        









        //初日のみ格納
        $days[0] = $date1->toDateString();
        $items[0] = $items99->where('shopping_history.day', $date1)->sum('quantity');

        //購入日付ごとに足し、$items配列に格納
        while($i <= $count)
        {
            $day = $date1->addDay(1);
            $days[$i] = $day->toDateString();
            $items[$i] = $items99->where('shopping_history.day', $day)
                        ->sum('quantity');
            $i = $i + 1;
        }

        //食材IDから食材名を取得
        $param1 = ['ingredients_id' => $request->ingredients_id];
        $name = DB::select('SELECT ingredients_name FROM ingredients WHERE ingredients_id = :ingredients_id', $param1);

        return view('fresh.area.output', ['items' => $items, 'name' => $name, 'days' => $days]);
    }
    
    public function companysupport()
    {
        return view('fresh.companysupport');
    }

    public function companysupportconfirm(SupportRequest $request)
    {
        $data = $request->all();
        return view('fresh.companysupportconfirm', ['data' => $data]);
    }

    public function companysupportfinish(SupportRequest $request)
    {
        $data = $request->all();
        $day = now()->format('Y-m-d');
        $param = [
            'mail' => $request->company_mail,
            'support_mail' => $request->support_mail,
            'day' => $day,
            'support_text' => $request->support_text,
        ];
        DB::table('companysupports')->insert($param);
        return view('fresh.companysupportfinish', ['data' => $data]);
    }

    public function resetmail()
    {
        return view('fresh.resetmail');
    }

    public function resetmailconfirm(ResetmailRequest $request)
    {
        $data = $request->all();
        return view('fresh.resetmailconfirm', ['data' => $data]);
    }

    public function resetmailfinish()
    {
        return view('fresh.resetmailfinish');
    }
    
}