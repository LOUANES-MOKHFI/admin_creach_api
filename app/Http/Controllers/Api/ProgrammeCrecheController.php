<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NiveauBook;
use Illuminate\Http\Request;
use App\Models\GuidePedagogique;
use App\Models\ImagesGuide;
use App\Http\Resources\GuidePedagogiqueResource;
use App\Http\Resources\NiveauBookResource;

class ProgrammeCrecheController extends Controller
{
    public function ShowGuidePedagogique(){
        $guide = GuidePedagogique::where('id',1)->first();

        if(!$guide){
            $message = "لا يوجد أي دليل بيداغوجي";
            return $this->sendError($message);
        }
        $guide = new GuidePedagogiqueResource($guide);
        return Response(['data' => $guide],200);
    }

    public function ShowProgramme(){
        $niveaux = NiveauBook::with('books')->get();

        if(!$niveaux){
            $message = "قائمة الكتب فارغة";
            return $this->sendError($message);
        }
        $niveaux = NiveauBookResource::collection($niveaux);
        return Response(['data' => $niveaux],200);
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
