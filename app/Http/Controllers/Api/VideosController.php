<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Http\Resources\VideoResource;
class VideosController extends Controller
{
    public function GetAllVideos(){

        $videos = Video::paginate(PAGINATE_COUNT);
        if($videos->count() <1){
            $message = "قائمة الفيديوهات فارغة";
            return $this->sendError($message);
        }
        $videos = VideoResource::collection($videos)->response()->getData();
        return Response(['data' => $videos],200);
    }
    
    public function GetVideosByCategorie($categorie){

        $videos = Video::where('domaine',$categorie)->paginate(PAGINATE_COUNT);
        if($videos->count() <1){
            $message = "قائمة الفيديوهات فارغة";
            return $this->sendError($message);
        }
        $videos = VideoResource::collection($videos)->response()->getData();
        return Response(['data' => $videos],200);
    }

    public function store(Request $request, Video $video)
    {
        //return $request;

        $creche = $request->user();
        try {
           DB::beginTransaction();
           
           $video->uuid = (string) Uuid::uuid4();
           $video->slug = Str::slug($request->title);
           $video->title = $request->title;
           $video->publisher = $request->publisher;
           $video->domaine = $request->domaine;
           $video->crech_id = $creche->id;
           $video->link = $request->link;
           $video->save();

            if($request->has('video')){
                $filename = '';
                $file = $request->file('video');
                $filename = UploadFile('video',$file);
                $video->video = $filename;
                $video->save();
            } 

            DB::commit();
            $message = "تمت عملية الاضافة بنجاح";
            return $this->sendResponse(200,$message);
            //return redirect()->route('admin.videos')->with('success',"");

        } catch (\Throwable $th) {
            return Response(['data' => 'Unauthorized'],401);
            
        }
    }

    public function edit($id)
    {
        $data = [];
        $creche = $request->user();
        $video = Video::where('id',$id)->where('creche_id',$creche->id)->first();
        if(!$video){
            $message = "هذا الفيديو غير موجود في قاعدة البيانات";
            return $this->sendError($message);
        }
        return Response(['data' => $video],200);
    }

    public function update(Request $request,$id)
    {
       // return $request;
        $creche = $request->user();
        $video = Video::where('id',$id)->where('creche_id',$creche->id)->first();
        if(!$video){
            $message = "هذا الفيديو غير موجود في قاعدة البيانات";
            return $this->sendError($message);
        }
        try {
           DB::beginTransaction();
           
           $video->slug = Str::slug($request->title);
           $video->title = $request->title;
           $video->publisher = $request->publisher;
           $video->domaine = $request->domaine;
           $video->crech_id = $creche->id;
           $video->link = $request->link;
           $video->save();

            if($request->has('video')){
                $filename = '';
                $file = $request->file('video');
                $filename = UploadFile('video',$file);
                $video->video = $filename;
                $video->save();
            } 
           DB::commit();
           $message = "تمت عملية التعديل بنجاح";
            return $this->sendResponse(200,$message);

        } catch (\Throwable $th) {
            return Response(['data' => 'Unauthorized'],401);
            
        }
    }
    public function sendError($error, $errorMessages = [], $code = 204)
    {
    	$response = [
            'success' => false,
            'status'    => $code,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response);
    }
    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'status'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }
}
