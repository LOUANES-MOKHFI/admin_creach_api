<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VendeurController extends Controller
{
    public function index(){
        $data = [];
        $data['vendeurs'] = User::where('type','vendeur')->get();
        return view('admin.vendeurs.index',$data);
    }
}
