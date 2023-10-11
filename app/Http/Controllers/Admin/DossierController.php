<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dossier;
use App\Models\FileDossier;

use Illuminate\Http\Request;
use DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class DossierController extends Controller
{
    public function index()
    {
       $dossiers = Dossier::orderBy('id','DESC')->get();
       return view('admin.dossiers.index',compact('dossiers'));
    }

    public function create()
    {
        $dossiers = Dossier::orderBy('id','DESC')->get();
        return view('admin.dossiers.add',compact('dossiers'));
    }

    public function store(Request $request, Dossier $dossier)
    {
        //return $request;

        try {
           DB::beginTransaction();
           //dd($request->files);
           $dossier->uuid = (string) Uuid::uuid4();
           $dossier->slug = Str::slug($request->name);
           $dossier->name = $request->name;
           $dossier->parent_id = $request->parent_id;
           $dossier->save();
             
            if($request->has('images')){
                foreach($request->images as $image){
                    $fileDossier = new FileDossier();
                    $filename = '';
                    $file = $image;
                    $filename = UploadFile('dossiers',$file);
                    $fileDossier->uuid = (string) Uuid::uuid4();

                    $fileDossier->name = $filename;
                // $fileDossier->type = 'guide pedagogique';
                    $fileDossier->dossier_id = $dossier->id;
                    $fileDossier->save();
                }
            } 
            /* if($request->has('files')){
                foreach($request->files as $image){
                    $fileDossier = new FileDossier();
                    $filename = '';
                    $file = $image;
                    $filename = UploadFile('guide_pedagogique',$file);
                    
                    $fileDossier->uuid = (string) Uuid::uuid4();
                    $fileDossier->name = $filename;
                    $fileDossier->dossier_id = $dossier->id;
                    $fileDossier->save();
                }
            }  */
           DB::commit();
           return redirect()->route('admin.dossiers')->with('success',"تمت عملية الاضافة بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        } 
    }

    public function edit($uuid)
    {
        $data = [];
        $data['dossiers'] = Dossier::orderBy('id','DESC')->get();
        $data['dossier']= Dossier::where('uuid',$uuid)->first();
        if(!$data['dossier']){
           return redirect()->route('admin.dossiers')->with('error',"هذا القسم غير موجود في قاعدة البيانات");
        }
        return view('admin.dossiers.edit',$data);
    }

    public function update(Request $request,$uuid)
    {
       // return $request;
        $dossier = Dossier::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           
           $dossier->uuid = (string) Uuid::uuid4();
           //$dossier->slug = Str::slug($request->name);
           $dossier->name = $request->name;
           $dossier->parent_id = $request->parent_id;
           $dossier->save();

            if($request->has('images')){
                foreach($request->images as $image){
                    $fileDossier = new FileDossier();
                    $filename = '';
                    $file = $image;
                    $filename = UploadFile('dossiers',$file);
                    $fileDossier->uuid = (string) Uuid::uuid4();

                    $fileDossier->name = $filename;
                // $fileDossier->type = 'guide pedagogique';
                    $fileDossier->dossier_id = $dossier->id;
                    $fileDossier->save();
                }
            } 
           DB::commit();
           return redirect()->route('admin.dossiers')->with('success',"تمت عملية التعديل بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function destroy($uuid)
    {
       // return $request;
        $dossier = Dossier::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           if(!$dossier){
                return redirect()->route('admin.dossiers')->with('error',"هذا القسم غير موجود في قاعدة البيانات");
            }
           $dossier->delete();
           DB::commit();
           return redirect()->route('admin.dossiers')->with('success',"تمت عملية الحذف بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function deleteFile($uuid){
        
       // return $request;
        $file = FileDossier::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
            if(!$file){
                return redirect()->back()->with('error',"هذه الصورة غير موجودة في قاعدة البيانات");
            }
            $file->delete();
            DB::commit();
            return redirect()->back()->with('success',"تمت عملية الحذف بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    
    }
}
