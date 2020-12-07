<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\SupportRequest;
use App\Http\Requests\ResetmailRequest;
use Illuminate\Support\Facades\Auth;
use App\User;


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

    public function signup() 
    {
        return view('fresh.signup');
    }

    public function signupconfirm(SignupRequest $request)
    {
        $data = $request->all();
        return view('fresh.signupconfirm', ['data' => $data]);
    }

    public function signupfinish(SignupRequest $request)
    {
        return view('fresh.signupfinish');
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