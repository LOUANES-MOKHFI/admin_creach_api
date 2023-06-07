<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publicite;
use DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
class PubliciteController extends Controller
{
    public function index()
    {
       $publicites = Publicite::orderBy('id','DESC')->get();
       return view('admin.settings.publicites.index',compact('publicites'));
    }

    public function create()
    {
        return view('admin.settings.publicites.add');
    }

    public function store(Request $request, Publicite $publicite)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:1,0',
        ]);

        try {
           DB::beginTransaction();
           
           $publicite->uuid = (string) Uuid::uuid4();
           $publicite->name = $request->name;
           $publicite->status = $request->status;
           
           $publicite->admin_id = auth('admins')->user()->id;
           $publicite->save();
            if($request->has('image')){
                $filename = '';
                $file = $request->file('image');
                $filename = UploadFile('publicites',$file);
                $publicite->image = $filename;
                $publicite->save();
            }
           
           DB::commit();
           return redirect()->route('admin.settings.publicites')->with('success',"تمت عملية الاضافة بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function edit($uuid)
    {
        $data = [];
        $data['publicite']= Publicite::where('uuid',$uuid)->first();
        if(!$data['publicite']){
           return redirect()->route('admin.settings.publicites')->with('error',"هذا العمل غير موجود في قاعدة البيانات");
        }
        return view('admin.settings.publicites.edit',$data);
    }
    public function update(Request $request,$uuid)
    {
       // return $request;
        $publicite = Publicite::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           
           $publicte->name = $request->name;
           $publicite->status = $request->status;
            
           $publicte->admin_id = auth('admins')->user()->id;
           $publicte->save();
            if($request->has('image')){
                $filename = '';
                $file = $request->file('image');
                $filename = UploadFile('publicites',$file);
                $publicite->image = $filename;
                $publicite->save();
            }
            
           DB::commit();
           return redirect()->route('admin.settings.publicites')->with('success',"تمت عملية التعديل بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function destroy($uuid)
    {
       // return $request;
        $publicte = Publicite::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           if(!$publicte){
                return redirect()->route('admin.settings.publictes')->with('error',"هذا العمل غير موجود في قاعدة البيانات");
            }
           $publicte->delete();
           DB::commit();
           return redirect()->route('admin.settings.publictes')->with('success',"تمت عملية الحذف بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }

    }
}
