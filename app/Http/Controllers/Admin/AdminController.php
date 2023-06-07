<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
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





    public function index(){
        $data = [];
        $data['admins'] = Admin::all();
        return view('admin.admins.index',$data);
    }

    public function show($uuid){
        try {
            $data['admin'] = Admin::where('uuid',$uuid)->first();
            if(!$data['admin']){
                return redirect()->back()->with('error','هذا الحساب غير موجود , يرجى التأكد من المعلومات');
            }
            
            return view('admin.admins.show',$data);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
    


    public function store(Request $request){
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required',
        ]);
        $admin = new Admin();
        
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);


        if($admin->save()){
            return redirect()->route('admin.admins')->with(['success' => 'تمت عملية الاضافة بنجاح']);
        }
        else{
            return redirect()->route('admin.admins')->with(['error' => 'هناك خلل في النظام, يرجى الاتصال بمدير الموقع']);
        }
    }
    public function edit($uuid){
        try {
            $data['admin'] = Admin::where('uuid',$uuid)->first();
            if(!$data['admin']){
                return redirect()->back()->with('error','هذا الحساب غير موجود , يرجى التأكد من المعلومات');
            }

            return view('admin.admins.edit',$data);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
    public function update(Request $request,$uuid){
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
        ]);
        try {
            $admin = Admin::where('uuid',$uuid)->first();
            if(!$admin){
                return redirect()->back()->with('error','هذا الحساب غير موجود , يرجى التأكد من المعلومات');
            }
            $admin->name = $request->name;
            $admin->email = $request->email;
            if($request->password != null){
                $admin->password = Hash::make($request->password);
            }
            $admin->save();
            return redirect()->route('admin.admins')->with('success','تمت عملية التحديث بنجاح');
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
    public function destroy($id){
        $admin = Admin::where('id',$id)->first();
        if(!$admin){
            return redirect()->route('admin.admins')->with(['error' => "هذا المدير غير موجود"]);

        }
        else{
            $admin->delete();
            return redirect()->route('admin.admins')->with(['success' => 'تمت عملية الحذف بنجاح']);

        }
    }
}
