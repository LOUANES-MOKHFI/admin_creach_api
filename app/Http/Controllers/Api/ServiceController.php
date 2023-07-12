<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Realisation;
use Illuminate\Http\Request;
use App\Http\Resources\RealisationResource;

class ServiceController extends Controller
{
    public function GetAllServices(){
        $data = [];
        $data['services'] = Realisation::select('id','name','slug','type','video','description')->orderBy('id','DESC')->where('type','عمل')->with('images')->get();
        $data['moltaka'] = Realisation::select('id','name','slug','type','video','description')->orderBy('id','DESC')->where('type','ملتقى')->with('images')->first();
        /* $data['services'] = RealisationResource::collection($services);
        $data['moltaka'] = new RealisationResource($moltaka); */
        return Response(['data' => $data],200);
    }

    public function ShowService($slug){
        $service = Realisation::select('id','name','slug','type','video','description')->where('slug',$slug)->with('images')->first();
        if(!$service){
            $message = "هذا العمل غير موجود ";
            return $this->sendError($message);
        }
        //$service = new RealisationResource($service);
        return Response(['data' => $service],200);
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
