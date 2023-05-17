<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgrammesCreche;
use Illuminate\Http\Request;
use DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
class ProgrammeCrecheController extends Controller
{
    public function index()
    {
       $programmes = ProgrammesCreche::orderBy('id','DESC')->get();
       return view('admin.settings.programmes.index',compact('programmes'));
    }

    public function create()
    {
        return view('admin.settings.programmes.add');
    }

    public function store(Request $request, ProgrammesCreche $programme)
    {
        //return $request;

        try {
           DB::beginTransaction();
           
           $programme->uuid = (string) Uuid::uuid4();
           $programme->slug = Str::slug($request->name);
           $programme->name = $request->name;
           $programme->save();
           DB::commit();
           return redirect()->route('admin.settings.programmes')->with('success',"تمت عملية الاضافة بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function edit($uuid)
    {
        $data = [];
        $data['programme']= ProgrammesCreche::where('uuid',$uuid)->first();
        if(!$data['programme']){
           return redirect()->route('admin.settings.programmes')->with('error',"هذا القسم غير موجود في قاعدة البيانات");
        }
        return view('admin.settings.programmes.edit',$data);
    }

    public function update(Request $request,$uuid)
    {
       // return $request;
        $programme = ProgrammesCreche::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           
           $programme->slug = Str::slug($request->name);
           $programme->name = $request->name;
           $programme->save();
           DB::commit();
           return redirect()->route('admin.settings.programmes')->with('success',"تمت عملية التعديل بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function destroy($uuid)
    {
       // return $request;
        $programme = ProgrammesCreche::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           if(!$programme){
                return redirect()->route('admin.settings.programmes')->with('error',"هذا البرنامج غير موجود في قاعدة البيانات");
            }
           $programme->delete();
           DB::commit();
           return redirect()->route('admin.settings.programmes')->with('success',"تمت عملية الحذف بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }
}
