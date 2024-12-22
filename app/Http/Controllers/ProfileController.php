<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showForm(){
        $user = Auth::user();
        return view('profile',compact('user'));
    }

    public function profileUpdate(Request $request){
        if($request->ajax()){

        }
    }

    public function passwordUpdate(Request $request){
        if($request->ajax()){

        }
    }
}
