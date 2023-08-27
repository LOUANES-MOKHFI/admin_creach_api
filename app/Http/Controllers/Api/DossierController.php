<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Http\Resources\DossierResource;

class DossierController extends Controller
{
    public function index()
    {
       $dossiers = Dossier::orderBy('id','DESC')->get();
       if($dossiers->count() < 1){
           $message = "قائمة فارغة";
           return $this->sendError($message);
       }
       $dossiers = DossierResource::collection($dossiers);
       return Response(['data' => $dossiers],200);
    }


    public function show($id)
    {
       $dossier = Dossier::where('id',$id)->get();
       if($dossier->count() < 1){
           $message = "قائمة فارغة";
           return $this->sendError($message);
       }
       $dossiers = new DossierResource($dossier);
       return Response(['data' => $dossiers],200);
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
