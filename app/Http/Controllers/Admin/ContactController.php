<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $data = [];
        $data['messages'] = Contact::all();
        return view('admin.contacts.index',$data);
    }

    public function show($uuid){
        $data = [];
        $data['message'] = Contact::where('uuid',$uuid)->first();
        
        if(!$data['message']){
            return redirect()->back()->with('error','هذه الرسالة غير موجودة');
        }
        
        $data['message']->is_viewed = 1;
        
        $data['message']->save();
       // dd($data['message']);
       return view('admin.contacts.show',$data);

    }
}
