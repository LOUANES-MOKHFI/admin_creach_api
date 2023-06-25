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
