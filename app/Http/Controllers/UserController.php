<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function DataUser(){
        $data = array(
            "title" => "Data User",
            "data_user" => User::all()
            
        );
        return view('dataUser',$data);
    }
}
