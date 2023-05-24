<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\TypesUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Mail;
class UserController extends Controller
{
    public function index(){
        $data = [];
        $data['users'] = User::where('type','user')->get();
        return view('admin.users.index',$data);
    }

    public function show($uuid){
        try {
            $data['user'] = User::where('type','user')->where('uuid',$uuid)->first();
            if(!$data['user']){
                return redirect()->back()->with('error','هذا الحساب غير موجود , يرجى التأكد من المعلومات');
            }
            return view('admin.users.show',$data);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
    public function edit($uuid){
        try {
            $data['user'] = User::where('type','user')->where('uuid',$uuid)->first();
            if(!$data['user']){
                return redirect()->back()->with('error','هذا الحساب غير موجود , يرجى التأكد من المعلومات');
            }
            $data['types'] = TypesUsers::all();

            return view('admin.users.edit',$data);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
    public function update(Request $request,$uuid){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'wilaya_id' => 'required',
            'type_user' => 'required',
        ]);
        try {
            $user = User::where('type','user')->where('uuid',$uuid)->first();
            if(!$user){
                return redirect()->back()->with('error','هذا الحساب غير موجود , يرجى التأكد من المعلومات');
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->wilaya_id = $request->wilaya_id;
            $user->pays_id = $request->pays_id;
            $user->commune_id = $request->commune_id;
            $user->type_user = $request->type_user;
            $user->save();
            return redirect()->route('admin.users')->with('success','تمت عملية التحديث بنجاح');
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }

    
    public function confirmeAccount($uuid){
        try {
            $user = User::where('type','user')->where('uuid',$uuid)->first();
            if(!$user){
                return redirect()->back()->with('error','هذا الحساب غير موجود , يرجى التأكد من المعلومات');
            }
            $user->is_active = 1;
            $user->save();
            
            $this->sendMail($user->name,$user->email,$user->type);

            return redirect()->back()->with('success','تم تأكيد عضوية الحساب بنحاح');
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
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


    function sendMail($client_name,$client_email,$type_user){
        //$to_email = 'louanes.mokhfi@gmail.com';
        //$to_email = 'louanes.mokhfi@gmail.com';
        $data = array('name'=>$client_name, "header" => "نعلمك بأنه تم تأكيد حسابك في منصة روضتي, يمكنك الآن تسجيل دخولك بالنقر على : ",
        "Email" => "إيمايل الحساب :".$client_email,
        "Name" => $client_name,
        "typeUser" => "نوع الحساب  :".$type_user,
        "Footer" => 'نشكرك على ثقتك في منصة روضتي'
        );
        Mail::send('admin.emails.email', $data, function($message) use ($client_name, $client_email) {
        $message->to($client_email, $client_name)
        ->subject('تأكيد حساب روضتي');
        $message->from('louanes.mokhfi@gmail.com','RawdatiDZ');
        });
        
    }
}
