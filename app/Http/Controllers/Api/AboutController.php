<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Http\Resources\AboutResource;
class AboutController extends Controller
{
    public function About(){
        $about = new AboutResource(About::where('id',1)->first());
        $data['creche_info'] = About::select('site_name','address','phone','email','facebook_page','facebook_groupe','instagram','tiktok','youtube','logo')->where('id',1)->first();
        $data['gerant_info'] = About::select('gerant_name','image','video','description')->where('id',1)->first();
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
