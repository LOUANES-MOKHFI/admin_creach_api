<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;

class ContactController extends Controller
{
    public function get(){
        return Contact::all();
    }
    public function store(Request $request): Response {
       
        $data = [];
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);
       
        $contact = Contact::create([
            'uuid' => (string) Uuid::uuid4(),
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'is_viewed' => 0,
        ]);
       
        if(!$contact){
            $data['message'] = 'هناك خطأ ما, يرجى المحاولة لاحقا';
            $data['status'] = 401;
            return Response($data);
        }
        $data['message'] = 'تم الارسال بنجاح';
        $data['status'] = 200;
        return Response($data);
    }
}
