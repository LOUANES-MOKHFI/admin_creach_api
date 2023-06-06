<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Realisation;
use Illuminate\Http\Request;
use App\Http\Resources\RealisationResource;

class ServiceController extends Controller
{
    public function GetAllServices(){
        $services = Realisation::orderBy('id','DESC')->get();
        $services = RealisationResource::collection($services);
        return Response(['data' => $services],200);
    }

    public function ShowService($slug){
        $service = Realisation::where('slug',$slug)->first();
        if(!$service){
            $message = "هذا العمل غير موجود ";
            return $this->sendError($message);
        }
        $service = new RealisationResource($service);
        return Response(['data' => $service],200);
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
