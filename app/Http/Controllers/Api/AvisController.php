<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Avis;
class AvisController extends Controller
{
    public function getAllAvis(){
        $avis = Avis::select('id','name','image','video','wilaya')->get();
        foreach($avis as $avi){
            $data[] = [
                'id' => $avi->id,
                'name' => $avi->name,
                'image' => 'public/files/avis/'.$avi->image,
                'video' => 'public/files/avis/'.$avi->video,
                'location' => $avi->wilaya,
            ];
        }
        return Response(['data' => $data],200);

    }

    public function sendError($error, $errorMessages = [], $code = 404)
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
