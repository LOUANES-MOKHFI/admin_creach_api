<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use App\Models\Wilaya;
use Illuminate\Http\Request;
use DB;
use Ramsey\id\id;
use Illuminate\Support\Str;
class AvisController extends Controller
{
    public function index()
    {
       $avis = Avis::orderBy('id','DESC')->get();
       return view('admin.avis.index',compact('avis'));
    }

    public function create()
    {
        $data = [];
        $data['wilayas'] = Wilaya::all();
        return view('admin.avis.add',$data);
    }

    public function store(Request $request, Avis $avi)
    {
        //return $request;

        try {
           DB::beginTransaction();
           
           $avi->name = $request->name;
           $avi->wilaya = $request->wilaya;
            if($request->has('image')){
                $filename = '';
                $file = $request->file('image');
                $filename = UploadFile('avis',$file);
                $avi->image = $filename;
                $avi->save();
            }
            if($request->has('video')){
                $filename1 = '';
                $file = $request->file('video');
                $filename1 = UploadFile('avis',$file);
                $avi->video = $filename1;
                $avi->save();
            }
           $avi->save();
           DB::commit();
           return redirect()->route('admin.avis')->with('success',"تمت عملية الاضافة بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function edit($id)
    {
        $data = [];
        $data['avi']= Avis::where('id',$id)->first();
        $data['wilayas'] = Wilaya::all();
        if(!$data['avi']){
           return redirect()->route('admin.avis')->with('error',"هذا الرأي غير موجود في قاعدة البيانات");
        }
        return view('admin.avis.edit',$data);
    }

    public function update(Request $request,$id)
    {
       // return $request;
        $avi = Avis::where('id',$id)->first();
        try {
           DB::beginTransaction();
           
           $avi->name = $request->name;
           $avi->wilaya = $request->wilaya;
            if($request->has('image')){
                $filename = '';
                $file = $request->file('image');
                $filename = UploadFile('avis',$file);
                $avi->image = $filename;
                $avi->save();
            }
            if($request->has('video')){
                $filename1 = '';
                $file = $request->file('video');
                $filename1 = UploadFile('avis',$file);
                $avi->video = $filename1;
                $avi->save();
            }
           $avi->save();
           DB::commit();
           return redirect()->route('admin.avis')->with('success',"تمت عملية التعديل بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function destroy($id)
    {
       // return $request;
        $avis = Avis::where('id',$id)->first();
        try {
           DB::beginTransaction();
           if(!$avis){
                return redirect()->route('admin.avis')->with('error',"هذا الرأي غير موجود في قاعدة البيانات");
            }
           $avis->delete();
           DB::commit();
           return redirect()->route('admin.avis')->with('success',"تمت عملية الحذف بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }
}
