<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypesUsers;
use Illuminate\Http\Request;
use DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class TypesUsersController extends Controller
{
    public function index()
    {
       $types = TypesUsers::orderBy('id','DESC')->get();
       return view('admin.settings.types_users.index',compact('types'));
    }

    public function create()
    {
        return view('admin.settings.types_users.add');
    }

    public function store(Request $request, TypesUsers $type)
    {
        //return $request;

        try {
           DB::beginTransaction();
           
           $type->uuid = (string) Uuid::uuid4();
           $type->slug = Str::slug($request->name);
           $type->name = $request->name;
           $type->save();
           DB::commit();
           return redirect()->route('admin.settings.types_users')->with('success',"تمت عملية الاضافة بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function edit($uuid)
    {
        $data = [];
        $data['type']= TypesUsers::where('uuid',$uuid)->first();
        if(!$data['type']){
           return redirect()->route('admin.settings.types_users')->with('error',"هذه الصفة غير موجودة في قاعدة البيانات");
        }
        return view('admin.settings.types_users.edit',$data);
    }

    public function update(Request $request,$uuid)
    {
       // return $request;
        $type = TypesUsers::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           
           $type->slug = Str::slug($request->name);
           $type->name = $request->name;
           $type->save();
           DB::commit();
           return redirect()->route('admin.settings.types_users')->with('success',"تمت عملية التعديل بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function destroy($uuid)
    {
       // return $request;
        $type = TypesUsers::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           if(!$type){
                return redirect()->route('admin.settings.types_users')->with('error',"هذه الصفة غير موجودة في قاعدة البيانات");
            }
           $type->delete();
           DB::commit();
           return redirect()->route('admin.settings.types_users')->with('success',"تمت عملية الحذف بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }
}
