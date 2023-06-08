<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use DB;

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

   
    

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.admins.add',compact('roles'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|',
            'roles' => 'required'
        ]);
        $admin = new Admin();
        
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->assignRole($request->input('roles'));

        if($admin->save()){
            return redirect()->route('admin.admins')->with(['success' => 'تمت عملية الاضافة بنجاح']);
        }
        else{
            return redirect()->route('admin.admins')->with(['error' => 'هناك خلل في النظام, يرجى الاتصال بمدير الموقع']);
        }
    }
    public function show($id){
        try {
            $data['admin'] = Admin::where('id',$id)->first();
            if(!$data['admin']){
                return redirect()->back()->with('error','هذا الحساب غير موجود , يرجى التأكد من المعلومات');
            }
            
            return view('admin.admins.show',$data);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
    public function edit($id){
        try {
            $data['admin'] = Admin::where('id',$id)->first();
            $data['roles'] = Role::pluck('name','name')->all();
            $data['userRole'] = $data['admin']->roles->pluck('name','name')->all();
            if(!$data['admin']){
                return redirect()->back()->with('error','هذا الحساب غير موجود , يرجى التأكد من المعلومات');
            }

            return view('admin.admins.edit',$data);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$id,

            'roles' => 'required'
        ]);
        try {
            $admin = Admin::where('id',$id)->first();
            if(!$admin){
                return redirect()->back()->with('error','هذا الحساب غير موجود , يرجى التأكد من المعلومات');
            }
            $admin->name = $request->name;
            $admin->email = $request->email;
            if($request->password != null){
                $admin->password = bcrypt($request->password);
            }
            $admin->save();
            DB::table('model_has_roles')->where('model_id',$id)->delete();
    
            $admin->assignRole($request->input('roles'));
            return redirect()->route('admin.admins')->with('success','تمت عملية التحديث بنجاح');
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
    public function destroy($id){
        $admin = Admin::where('id',$id)->first();
        if(!$admin){
            return redirect()->route('admin.admins')->with(['error' => "هذا الحساب غير موجود"]);

        }
        else{
            $admin->delete();
            return redirect()->route('admin.admins')->with(['success' => 'تمت عملية الحذف بنجاح']);

        }
    }
}
