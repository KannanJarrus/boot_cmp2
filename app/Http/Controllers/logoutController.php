<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class logoutController extends Controller
{
    function logout(){
        if(session()->has('user')){
            session()->pull('user');
        }
        return redirect('login');
    }
}
