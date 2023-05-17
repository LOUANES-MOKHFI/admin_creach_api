<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Realisation;
use App\Models\RealisationImages;
use Illuminate\Http\Request;
use DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class RealisationController extends Controller
{
    public function index()
    {
       $realisations = Realisation::orderBy('id','DESC')->get();
       return view('admin.settings.realisations.index',compact('realisations'));
    }

    public function create()
    {
        return view('admin.settings.realisations.add');
    }

    public function store(Request $request, Realisation $realisation)
    {
        $request->validate([
            'name' => 'required',
            //'video' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);

        try {
           DB::beginTransaction();
           
           $realisation->uuid = (string) Uuid::uuid4();
           $realisation->slug = Str::slug($request->name);
           $realisation->name = $request->name;
           $realisation->type = $request->type;
           $realisation->description = $request->description;
           
           $realisation->admin_id = auth('admins')->user()->id;
           $realisation->save();
            if($request->has('video')){
                $filename = '';
                $file = $request->file('video');
                $filename = UploadFile('realisations',$file);
                $realisation->video = $filename;
                $realisation->save();
            }
            if($request->has('images')){
                foreach($request->images as $image){
                    $realisationImage = new RealisationImages();
                    $filename = '';
                    $file = $image;
                    $filename = UploadFile('realisations',$file);
                    $realisationImage->image = $filename;
                    $realisationImage->ralisation_id = $realisation->id;
                    $realisationImage->save();
                }
            } 
           DB::commit();
           return redirect()->route('admin.settings.realisations')->with('success',"تمت عملية الاضافة بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function edit($uuid)
    {
        $data = [];
        $data['realisation']= Realisation::where('uuid',$uuid)->first();
        if(!$data['realisation']){
           return redirect()->route('admin.settings.realisations')->with('error',"هذا العمل غير موجود في قاعدة البيانات");
        }
        return view('admin.settings.realisations.edit',$data);
    }
    public function update(Request $request,$uuid)
    {
       // return $request;
        $realisation = Realisation::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           
           $realisation->slug = Str::slug($request->name);
           $realisation->name = $request->name;
           $realisation->type = $request->type;
           $realisation->description = $request->description;
           
           $realisation->admin_id = auth('admins')->user()->id;
           $realisation->save();
            if($request->has('video')){
                $filename = '';
                $file = $request->file('video');
                $filename = UploadFile('realisations',$file);
                $realisation->video = $filename;
                $realisation->save();
            }
            if($request->has('images')){
                foreach($request->images as $image){
                    $realisationImage = new RealisationImages();
                    $filename = '';
                    $file = $image;
                    $filename = UploadFile('realisations',$file);
                    $realisationImage->image = $filename;
                    $realisationImage->ralisation_id = $realisation->id;
                    $realisationImage->save();
                }
            } 
           DB::commit();
           return redirect()->route('admin.settings.domaines')->with('success',"تمت عملية التعديل بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function destroy($uuid)
    {
       // return $request;
        $realisation = Realisation::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           if(!$realisation){
                return redirect()->route('admin.settings.realisations')->with('error',"هذا العمل غير موجود في قاعدة البيانات");
            }
           $realisation->delete();
           DB::commit();
           return redirect()->route('admin.settings.realisations')->with('success',"تمت عملية الحذف بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }

    }

    public function deleteImage($id)
    {
       try {
        $image = RealisationImages::orderBy('id','DESC')->where('id',$id);
            if(!$image){
                return redirect()->back()->with(['error'=> 'هذه الصورة غير موجودة']);
            }
            $image -> delete();
            return redirect()->back()->with('success',"تمت عملية الحذف بنجاح");

       } catch (\Throwable $ex) {
         return redirect()->back()->with('error',$ex->getMessage());
       }
    }
}
