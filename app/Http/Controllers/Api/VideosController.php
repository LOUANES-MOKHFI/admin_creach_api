<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;

class VideosController extends Controller
{
    public function GetAllVideos(){

        $videos = Video::get();
        if($videos->count() <1){
            $message = "قائمة الفيديوهات فارغة";
            return $this->sendError($message);
        }
        return Response(['data' => $videos],200);
    }  
}
