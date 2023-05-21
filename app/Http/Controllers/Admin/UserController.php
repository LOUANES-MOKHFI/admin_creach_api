<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
class UserController extends Controller
{
    public function index(){
        $data = [];
        $data['users'] = User::where('type','user')->get();
        return view('admin.users.index',$data);
    }

    public function create(){

        return view('admin.users.add');
    }

    public function store(Request $request){
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required',
        ]);
        $user = new Admin();
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);


        if($user->save()){
            return redirect()->route('admin.users')->with(['success' => 'L\'utilisateur est ajoutée avec succées']);
        }
        else{
            return redirect()->route('admin.users')->with(['error' => 's\'il vous plait, verifier vos informations']);
        }
    }

    public function edit($id){
        
        $user = Admin::where('id',$id)->first();
        if(!$user){
            return redirect()->route('admin.users')->with(['error' => "L'utilisateur  n'existe pas"]);

        }
        return view('admin.users.edit',compact('user'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required',
        ]);
        $user = Admin::where('id',$id)->first();
        if(!$user){
            return redirect()->route('admin.users')->with(['error' => "L'utilisateur  n'existe pas"]);
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
       
        if($user->save()){
            return redirect()->route('admin.users')->with(['success' => 'L\'utilisateur est modifiée avec succées']);
        }
        else{
            return redirect()->route('admin.users')->with(['error' => 's\'il vous plait, verifier vos informations']);
        }
    }
    public function destroy($id){
        $user = Admin::where('id',$id)->first();
        if(!$user){
            return redirect()->route('admin.users')->with(['error' => "L'utilisateur n'existe pas"]);

        }
        else{
            $user->delete();
            return redirect()->route('admin.users')->with(['success' => 'L\'utilisateur est Supprimée avec succées']);

        }
    }
}
