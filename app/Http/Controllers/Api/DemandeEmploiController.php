<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OffreEmploi;
use App\Models\DemandeEmploi;
use Ramsey\Uuid\Uuid;
use DB;
use Illuminate\Support\Str;
use Validator;
use App\Http\Resources\DemandeEmploiResource;
class DemandeEmploiController extends Controller
{
    public function Postuler(Request $request){
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'offre' => 'required|exists:offre_emplois,uuid',
        ]);
        

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try {
            $uuid = $request->offre;
            $user = $request->user();
            $offre = OffreEmploi::where('uuid',$uuid)->first();
            if(!$offre){
                $message = "هذا العرض غير موجود ";
                return $this->sendError($message);
            }

            $demande = DemandeEmploi::create([
                'uuid' => (string) Uuid::uuid4(),
                'user_id' => $user->id,
                'offre_id' => $offre->id,
                'creche_id' => $offre->creche_id,
            ]);
            $status = 200;
            $message = "تمت التقدم لعرض العمل بنجاح";

            return $this->sendResponse($status, $message);
            
        } catch (\Throwable $th) {
            return Response(['data' => 'Unauthorized'],401);
        }  
        
    }

    public function GetAllDemandesEmploi(Request $request){
        $user = $request->user();
        $demandes = DemandeEmploi::where('creche_id',$user->id)->get();
        if($demandes->count() <1){
            $message = "قائمة طلبات العمل فارغة";
            return $this->sendError($message);
        }
        $demandes = DemandeEmploiResource::collection($demandes);
        return Response(['data' => $demandes],200);
    }   

    public function ShowDemandeEmploi(Request $request,$uuid){
        $user = $request->user();
        $demande = DemandeEmploi::where('creche_id',$user->id)->with('user')->with('offre')->first();
        if(!$demande){
            $message = "هذا الطلب غير موجود ";
            return $this->sendError($message);
        }
        $demande = new DemandeEmploiResource($demande);
        return Response(['data' => $demande],200);
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
