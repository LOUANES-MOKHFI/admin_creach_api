<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Emploi;
use Illuminate\Http\Request;
use DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class EmpoloiController extends Controller
{
    public function index()
    {
       $emplois = Emploi::orderBy('id','DESC')->get();
       return view('admin.settings.emplois.index',compact('emplois'));
    }

    public function create()
    {
        return view('admin.settings.emplois.add');
    }

    public function store(Request $request, Emploi $emploi)
    {
        //return $request;

        try {
           DB::beginTransaction();
           
           $emploi->uuid = (string) Uuid::uuid4();
           $emploi->slug = Str::slug($request->name);
           $emploi->name = $request->name;
           $emploi->admin_id = auth('admins')->user()->id;
           $emploi->save();
           DB::commit();
           return redirect()->route('admin.settings.emplois')->with('success',"تمت عملية الاضافة بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function edit($uuid)
    {
        $data = [];
        $data['emploi']= Emploi::where('uuid',$uuid)->first();
        if(!$data['emploi']){
           return redirect()->route('admin.settings.emplois')->with('error',"هذه الوظيفة غير موجودة في قاعدة البيانات");
        }
        return view('admin.settings.emplois.edit',$data);
    }

    public function update(Request $request,$uuid)
    {
       // return $request;
        $emploi = Emploi::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           
           $emploi->slug = Str::slug($request->name);
           $emploi->name = $request->name;
           $emploi->admin_id = auth('admins')->user()->id;
           $emploi->save();
           DB::commit();
           return redirect()->route('admin.settings.emplois')->with('success',"تمت عملية التعديل بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function destroy($uuid)
    {
       // return $request;
        $emploi = Emploi::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           if(!$emploi){
                return redirect()->route('admin.settings.emplois')->with('error',"هذه الوظيفة غير موجودة في قاعدة البيانات");
            }
           $emploi->delete();
           DB::commit();
           return redirect()->route('admin.settings.emplois')->with('success',"تمت عملية الحذف بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }
}
