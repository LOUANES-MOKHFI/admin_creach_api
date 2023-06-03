<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NiveauBook;
use Illuminate\Http\Request;
use App\Models\GuidePedagogique;
use App\Models\ImagesGuide;

class ProgrammeCrecheController extends Controller
{
    public function ShowGuidePedagogique(){
        $guide = GuidePedagogique::where('id',1)->with('images')->first();

        if(!$guide){
            $message = "لا يوجد أي دليل بيداغوجي";
            return $this->sendError($message);
        }
        return Response(['data' => $guide],200);
    }

    public function ShowProgramme(){
        $niveaux = NiveauBook::with('books')->get();

        if(!$niveaux){
            $message = "قائمة الكتب فارغة";
            return $this->sendError($message);
        }
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
