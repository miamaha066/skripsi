<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\User;
use Storage;
use File;
use Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Alert;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */



 public function ConfirmLogin(Request $request)
 {

    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'password' => 'required',
    ]);

    if ($validator->fails()) {
        return back()
        ->withErrors($validator) //data kosong dia erorr kembali ke login
        ->withInput();
    } else {

        $userdata = array(
            'name'     => $request->input('name'),
            'password'  => $request->input('password')
        );

        if (Auth::attempt($userdata)) {
            if(Auth::user()->role == "admin" ){
                return redirect()->intended('/home');
            }else{
                return redirect()->intended('/main');
            }

        } else {        
            
            return back()->with('status', 'Login Gagal! Silahkan Cek atau Lakukan Registrasi');
            
        }

    }
}

    public function logout(){

        Auth::logout();
        return redirect('/');
    }
}