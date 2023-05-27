<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\ProgrammesCreche;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CrecheController extends Controller
{
    public function index(){
        $data = [];
        $data['creches'] = User::where('type','creche')->get();
        return view('admin.creches.index',$data);
    }
    public function show($uuid){
        try {
            $data['creche'] = User::where('type','creche')->where('uuid',$uuid)->first();
            if(!$data['creche']){
                return redirect()->back()->with('error','هذا الحساب غير موجود , يرجى التأكد من المعلومات');
            }
            $notification = Notification::where('uuid_model',$data['creche']->uuid)->first();
            if($notification){
                $notification->is_viewed = 1;
                $notification->save();
            }
            return view('admin.creches.show',$data);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }

    public function edit($uuid){
        try {
            $data['creche'] = User::where('type','creche')->where('uuid',$uuid)->first();
            if(!$data['creche']){
                return redirect()->back()->with('error','هذا الحساب غير موجود , يرجى التأكد من المعلومات');
            }
            $data['programmes'] = ProgrammesCreche::all();
            return view('admin.creches.edit',$data);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }

    public function update(Request $request,$uuid){
        $request->validate([
            'name' => 'required',
            'type_creche' => 'required',
            'creche_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'wilaya_id' => 'required',
            'commune_id' => 'required',
            'programme_id' => 'required',
            //'image_rc' => 'required',
        ]);
        try {
            $creche = User::where('type','creche')->where('uuid',$uuid)->first();
            if(!$creche){
                return redirect()->back()->with('error','هذا الحساب غير موجود , يرجى التأكد من المعلومات');
            }
            $creche->name = $request->name;
            $creche->type_creche = $request->type_creche;
            $creche->creche_name = $request->creche_name;
            $creche->email = $request->email;
            $creche->phone = $request->phone;
            $creche->wilaya_id = $request->wilaya_id;
            $creche->commune_id = $request->commune_id;
            $creche->programme_id = $request->programme_id;
            if($request->has('logo')){
                $filename = '';
                $file = $request->file('logo');
                $filename = UploadFile('logo',$file);
               // $creche->logo = $filename;
                //$book->save();
            }
            $creche->save();
            return redirect()->route('admin.creches')->with('success','تمت عملية التحديث بنجاح');
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }

    public function confirmeAccount($uuid){
        try {
            $user = User::where('type','creche')->where('uuid',$uuid)->first();
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
