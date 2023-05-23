<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VendeurController extends Controller
{
    public function index(){
        $data = [];
        $data['vendeurs'] = User::where('type','vendeur')->get();
        return view('admin.vendeurs.index',$data);
    }

    public function show($uuid){
        try {
            $data['vendeur'] = User::where('type','vendeur')->where('uuid',$uuid)->first();
            if(!$data['vendeur']){
                return redirect()->back()->with('error','هذا الحساب غير موجود , يرجى التأكد من المعلومات');
            }
            return view('admin.vendeurs.show',$data);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
    public function confirmeAccount($uuid){
        try {
            $user = User::where('type','vendeur')->where('uuid',$uuid)->first();
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
