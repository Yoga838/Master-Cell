<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class loginController extends Controller
{
    public function login(Request $request){
        
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($validatedData)){
            $request->session()->regenerate();
            return redirect('/Dashboard');
        }
        else{
            Auth::logout();
            return redirect('/login')->with('error', 'Usernam Atau Password Anda Salah !!!');
        }
        
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
