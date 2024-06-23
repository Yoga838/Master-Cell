<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function index(){
        $data = User::find(Auth::user()->id);
        return view('profil',compact('data'));
    }
}

