<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuidePedagogique;
use App\Models\ImagesGuide;
use Illuminate\Http\Request;
use DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
class GuidePedagogiqueController extends Controller
{
    public function index()
    {
       $guides = GuidePedagogique::orderBy('id','DESC')->get();
       return view('admin.guide_pedagogique.index',compact('guides'));
    }

    public function create()
    {
        return view('admin.guide_pedagogique.add');
    }

    public function store(Request $request, GuidePedagogique $guide)
    {
        $request->validate([
            'name' => 'required',
            'pdf_file' => 'required',
        ]);

        try {
           DB::beginTransaction();
           
           $guide->uuid = (string) Uuid::uuid4();
           $guide->slug = Str::slug($request->name);
           $guide->name = $request->name;
           if($request->has('pdf_file')){
                $filename = '';
                $file = $request->file('pdf_file');
                $filename = UploadFile('guide_pedagogique',$file);
                $guide->pdf_file = $filename;
                //$guide->save();
            }
           $guide->save();
            
            if($request->has('images')){
                foreach($request->images as $image){
                    $guideImages = new ImagesGuide();
                    $filename = '';
                    $file = $image;
                    $filename = UploadFile('guide_pedagogique',$file);
                    $guideImages->image = $filename;
                    $guideImages->type = 'guide pedagogique';
                    $guideImages->guide_id = $guide->id;
                    $guideImages->save();
                }
            } 
           DB::commit();
           return redirect()->route('admin.guide_pedagogique')->with('success',"تمت عملية الاضافة بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function edit($uuid)
    {
        $data = [];
        $data['guide']= GuidePedagogique::where('uuid',$uuid)->first();
        if(!$data['guide']){
           return redirect()->route('admin.guide_pedagogique')->with('error',"هذا الدليل غير موجود في قاعدة البيانات");
        }
        return view('admin.guide_pedagogique.edit',$data);
    }
    public function update(Request $request,$uuid)
    {
       // return $request;
        $guide = GuidePedagogique::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           
           $guide->slug = Str::slug($request->name);
           $guide->name = $request->name;
           if($request->has('pdf_file')){
                $filename = '';
                $file = $request->file('pdf_file');
                $filename = UploadFile('guide_pedagogique',$file);
                $guide->pdf_file = $filename;
                //$guide->save();
            }
           $guide->save();
           
            if($request->has('images')){
                foreach($request->images as $image){
                    $guideImages = new ImagesGuide();
                    $filename = '';
                    $file = $image;
                    $filename = UploadFile('guide_pedagogique',$file);
                    $guideImages->image = $filename;
                    $guideImages->type = 'guide pedagogique';
                    $guideImages->guide_id = $guide->id;
                    $guideImages->save();
                }
            } 
           DB::commit();
           return redirect()->route('admin.guide_pedagogique')->with('success',"تمت عملية التعديل بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function destroy($uuid)
    {
       // return $request;
        $guide = GuidePedagogique::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           if(!$guide){
                return redirect()->route('admin.guide_pedagogique')->with('error',"هذا الدليل غير موجود في قاعدة البيانات");
            }
           $guide->delete();
           DB::commit();
           return redirect()->route('admin.guide_pedagogique')->with('success',"تمت عملية الحذف بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }

    }

    public function deleteImage($id)
    {
       try {
        $image = ImagesGuide::orderBy('id','DESC')->where('id',$id);
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
