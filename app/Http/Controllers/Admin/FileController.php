<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\FileDossier;
use DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
class FileController extends Controller
{
    public function index()
    {
       $files = FileDossier::orderBy('id','DESC')->get();
       return view('admin.files.index',compact('files'));
    }

    public function create()
    {
        return view('admin.files.add');
    }

    public function store(Request $request, Dossier $file)
    {
        //return $request;

        try {
           DB::beginTransaction();
           
           $file->uuid = (string) Uuid::uuid4();
           $file->slug = Str::slug($request->name);
           $file->name = $request->name;
           $file->save();
           DB::commit();
           return redirect()->route('admin.files')->with('success',"تمت عملية الاضافة بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function edit($uuid)
    {
        $data = [];
        $data['file']= FileDossier::where('uuid',$uuid)->first();
        if(!$data['file']){
           return redirect()->route('admin.files')->with('error',"هذا القسم غير موجود في قاعدة البيانات");
        }
        return view('admin.files.edit',$data);
    }

    public function update(Request $request,$uuid)
    {
       // return $request;
        $file = FileDossier::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           
           $file->slug = Str::slug($request->name);
           $file->name = $request->name;
           $file->save();
           DB::commit();
           return redirect()->route('admin.files')->with('success',"تمت عملية التعديل بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function destroy($uuid)
    {
       // return $request;
        $file = FileDossier::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           if(!$file){
                return redirect()->route('admin.files')->with('error',"هذا القسم غير موجود في قاعدة البيانات");
            }
           $file->delete();
           DB::commit();
           return redirect()->route('admin.files')->with('success',"تمت عملية الحذف بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }
}
