<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DomainesConseil;
use Illuminate\Http\Request;
use DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;


class DomaineConseilController extends Controller
{
    public function index()
    {
       $domaines = DomainesConseil::orderBy('id','DESC')->get();
       return view('admin.settings.domaines_conseils.index',compact('domaines'));
    }

    public function create()
    {
        return view('admin.settings.domaines_conseils.add');
    }

    public function store(Request $request, DomainesConseil $domaine)
    {
        //return $request;

        try {
           DB::beginTransaction();
           
           $domaine->uuid = (string) Uuid::uuid4();
           $domaine->slug = Str::slug($request->name);
           $domaine->name = $request->name;
           $domaine->admin_id = auth('admins')->user()->id;
           $domaine->save();
           DB::commit();
           return redirect()->route('admin.settings.domaines_conseils')->with('success',"تمت عملية الاضافة بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function edit($uuid)
    {
        $data = [];
        $data['domaine']= DomainesConseil::where('uuid',$uuid)->first();
        if(!$data['domaine']){
           return redirect()->route('admin.settings.domaines_conseils')->with('error',"هذا المجال غير موجود في قاعدة البيانات");
        }
        return view('admin.settings.domaines_conseils.edit',$data);
    }

    public function update(Request $request,$uuid)
    {
       // return $request;
        $domaine = DomainesConseil::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           
           $domaine->slug = Str::slug($request->name);
           $domaine->name = $request->name;
           $domaine->admin_id = auth('admins')->user()->id;
           $domaine->save();
           DB::commit();
           return redirect()->route('admin.settings.domaines_conseils')->with('success',"تمت عملية التعديل بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function destroy($uuid)
    {
       // return $request;
        $domaine = DomainesConseil::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           if(!$domaine){
                return redirect()->route('admin.settings.domaines_conseils')->with('error',"هذا المجال غير موجود في قاعدة البيانات");
            }
           $domaine->delete();
           DB::commit();
           return redirect()->route('admin.settings.domaines_conseils')->with('success',"تمت عملية الحذف بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }
}
