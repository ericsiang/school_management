<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function logout(){
        Auth::logout('user');
        return redirect()->route('login');
    }
}
