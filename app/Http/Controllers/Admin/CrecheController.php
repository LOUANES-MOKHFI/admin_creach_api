<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CrecheController extends Controller
{
    public function index(){
        $data = [];
        $data['creches'] = User::where('type','creche')->get();
        return view('admin.creches.index',$data);
    }
}
