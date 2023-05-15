<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(){
        return view('admin.auth.login');
    }

    public function Postlogin(Request $request){
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember_me = $request->has('remember_me') ? true : false;
        if(auth()->guard('admins')->attempt(['email' => $request->input("email"), 'password' => $request->input('password')])){
            return redirect()->route('admin');
        }
        return redirect()->back()->with(['error' => 'Email ou mot de passe incorrect']);
    }

    public function logout(){
        $gaurd = $this->getGaurd();
        $gaurd->logout();
        return redirect()->route('admin.login');
    }

    private function getGaurd(){
        return auth('admins');
    }
}
