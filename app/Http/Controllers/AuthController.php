<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('login');
    }
    
    public function login(Request $request){
        //dd($request);
        $credentials = $request->validate([
            'email'=> 'required|email',
            'password' =>'required'
            
        ]);
        $credentials['activate']=true;
        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/admin');
        } 
         return back()->withErrors([
            'email'=>"auth error"
         ])->onlyInput();
        
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    
}