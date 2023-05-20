<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function index()
    {
       $videos = Video::orderBy('id','DESC')->get();
       return view('admin.videos.index',compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.add');
    }

    public function store(Request $request, Video $video)
    {
        //return $request;

        try {
           DB::beginTransaction();
           
           $video->uuid = (string) Uuid::uuid4();
           $video->slug = Str::slug($request->title);
           $video->title = $request->title;
           $video->publisher = $request->publisher;
           $video->domaine = $request->domaine;
           $video->link = $request->link;
           $video->save();
           DB::commit();
           return redirect()->route('admin.videos')->with('success',"تمت عملية الاضافة بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function edit($uuid)
    {
        $data = [];
        $data['video']= Video::where('uuid',$uuid)->first();
        if(!$data['video']){
           return redirect()->route('admin.videos')->with('error',"هذا الفيديو غير موجود في قاعدة البيانات");
        }
        return view('admin.videos.edit',$data);
    }

    public function update(Request $request,$uuid)
    {
       // return $request;
        $video = Video::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           
           $video->slug = Str::slug($request->title);
           $video->title = $request->title;
           $video->publisher = $request->publisher;
           $video->domaine = $request->domaine;
           $video->link = $request->link;
           $video->save();
           DB::commit();
           return redirect()->route('admin.videos')->with('success',"تمت عملية التعديل بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function destroy($uuid)
    {
       // return $request;
        $video = Video::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           if(!$video){
                return redirect()->route('admin.videos')->with('error',"هذا الفيديو غير موجود في قاعدة البيانات");
            }
           $video->delete();
           DB::commit();
           return redirect()->route('admin.videos')->with('success',"تمت عملية الحذف بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }
}
