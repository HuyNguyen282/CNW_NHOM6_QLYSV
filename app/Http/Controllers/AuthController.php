<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email', 
            'password'=> 'required|string',
        ]);
        
      
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/');
        }
        
      
        return back()
                ->withErrors(['email' => 'Sai tài khoản hoặc sai mật khẩu']) 
                ->onlyInput('email'); 
    }
}
