<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DemandeBook;
use App\Models\DemandeBookDetail;
use App\Models\Notification;
use Illuminate\Http\Request;

class DemandeBookController extends Controller
{
    public function index(){
        $demandes = DemandeBook::orderBy('created_at','DESC')->get();
        return view('admin.demande_books.index',compact('demandes'));
    }

    public function show($uuid){
        $demande = DemandeBook::where('uuid',$uuid)->first();
        if(!$demande){
            return redirect()->back()->with('error','هذا الطلب غير موجود , يرجى التأكد من المعلومات');
        }
        $notification = Notification::where('uuid_model',$demande->uuid)->first();
        if($notification){
            $notification->is_viewed = 1;
            $notification->save();
        }
        return view('admin.demande_books.show',compact('demande'));
    }
}
