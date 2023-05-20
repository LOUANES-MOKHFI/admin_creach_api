<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Faq;
use Illuminate\Http\Request;
use DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    public function index()
    {
       $faqs = Faq::orderBy('id','DESC')->get();
       return view('admin.faqs.index',compact('faqs'));
    }

    public function create()
    {
        $data = [];
        $data['categories'] = Category::orderBy('id','DESC')->where('type','faq')->get();
        return view('admin.faqs.add',$data);
    }

    public function store(Request $request, Faq $faq)
    {
        //return $request;

        try {
           DB::beginTransaction();
           
           $faq->uuid = (string) Uuid::uuid4();
           $faq->slug = Str::slug($request->title);
           $faq->title = $request->title;
           $faq->question = $request->question;
           $faq->response = $request->response;
           $faq->category_id = $request->category;
           $faq->admin_id = auth('admins')->user()->id;
           $faq->save();
           DB::commit();
           return redirect()->route('admin.faqs')->with('success',"تمت عملية الاضافة بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function show($uuid)
    {
        $data = [];
        $data['faq']= Faq::where('uuid',$uuid)->first();
        if(!$data['faq']){
           return redirect()->route('admin.faqs')->with('error',"هذه الاستشارة غير موجودة في قاعدة البيانات");
        }
        return view('admin.faqs.show',$data);
    }
    public function edit($uuid)
    {
        $data = [];
        $data['faq']= Faq::where('uuid',$uuid)->first();
        if(!$data['faq']){
           return redirect()->route('admin.faqs')->with('error',"هذه الاستشارة غير موجودة في قاعدة البيانات");
        }
        $data['categories'] = Category::orderBy('id','DESC')->where('type','faq')->get();
        return view('admin.faqs.edit',$data);
    }

    public function update(Request $request,$uuid)
    {
       // return $request;
        $faq = Faq::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           
           $faq->slug = Str::slug($request->title);
           $faq->title = $request->title;
           $faq->question = $request->question;
           $faq->response = $request->response;
           $faq->category_id = $request->category;
           $faq->admin_id = auth('admins')->user()->id;
           $faq->save();
           DB::commit();
           return redirect()->route('admin.faqs')->with('success',"تمت عملية التعديل بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function destroy($uuid)
    {
       // return $request;
        $faq = Faq::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
            if(!$faq){
                return redirect()->route('admin.faqs')->with('error',"هذه الاستشارة غير موجودة في قاعدة البيانات");
            }
            $faq->delete();
            DB::commit();
            return redirect()->route('admin.faqs')->with('success',"تمت عملية الحذف بنجاح");
        }catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);   
        }
    }
}
