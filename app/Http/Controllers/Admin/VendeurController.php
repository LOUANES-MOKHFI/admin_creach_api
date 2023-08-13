<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DomaineVendeur;
use App\Models\Notification;
use App\Models\User;
use App\Models\Wilaya;
use App\Models\Commune;
use App\Models\Countrie;
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
            $notification = Notification::where('uuid_model',$data['vendeur']->uuid)->first();
            if($notification){
                $notification->is_viewed = 1;
                $notification->save();
            }
            return view('admin.vendeurs.show',$data);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
    public function edit($uuid){
        try {
            $data['vendeur'] = User::where('type','vendeur')->where('uuid',$uuid)->first();
            $data['countries'] = Countrie::all();
            $data['wilayas'] = Wilaya::all();
            $data['communes'] = Commune::all();
            if(!$data['vendeur']){
                return redirect()->back()->with('error','هذا الحساب غير موجود , يرجى التأكد من المعلومات');
            }
            $data['domaines'] = DomaineVendeur::all();
            return view('admin.vendeurs.edit',$data);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }

    public function update(Request $request,$uuid){
        $request->validate([
            'name' => 'required',
            'domaine_vendeur' => 'required',
            'store_name' => 'required',
            'livraison' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'wilaya_id' => 'required',
            'commune_id' => 'required',
        ]);
        try {
            $vendeur = User::where('type','vendeur')->where('uuid',$uuid)->first();
            if(!$vendeur){
                return redirect()->back()->with('error','هذا الحساب غير موجود , يرجى التأكد من المعلومات');
            }
            $vendeur->name = $request->name;
            $vendeur->store_name = $request->store_name;
            $vendeur->email = $request->email;
            $vendeur->phone = $request->phone;
            $vendeur->wilaya_id = $request->wilaya_id;
            $vendeur->commune_id = $request->commune_id;
            $vendeur->domaine_vendeur = $request->domaine_vendeur;
            $vendeur->livraison = $request->livraison;
            $vendeur->save();
            return redirect()->route('admin.vendeurs')->with('success','تمت عملية التحديث بنجاح');
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
            $notification = Notification::where('uuid_model',$user->uuid)->first();
            if($notification){
                $notification->is_viewed = 1;
                $notification->save();
            }
            $this->sendMail($user->name,$user->email,$user->type);

            return redirect()->back()->with('success','تم تأكيد عضوية الحساب بنحاح');
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }


    function sendMail($client_name,$client_email,$type_user){
        //$to_email = 'contact@rawdati-dz.com';
        //$to_email = 'contact@rawdati-dz.com';
        $data = array('name'=>$client_name, "header" => "نعلمك بأنه تم تأكيد حسابك في منصة روضتي, يمكنك الآن تسجيل دخولك بالنقر على : ",
        "Email" => "إيمايل الحساب :".$client_email,
        "Name" => $client_name,
        "typeUser" => "نوع الحساب  :".$type_user,
        "Footer" => 'نشكرك على ثقتك في منصة روضتي'
        );
        Mail::send('admin.emails.email', $data, function($message) use ($client_name, $client_email) {
        $message->to($client_email, $client_name)
        ->subject('تأكيد حساب روضتي');
        $message->from('contact@rawdati-dz.com','RawdatiDZ');
        });
        
    }
}
