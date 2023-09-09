<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DemandeEmploiUser;
use Validator;
use Ramsey\Uuid\Uuid;
use DB;
use Illuminate\Support\Str;
use App\Http\Resources\DemandeEmploiUserResource;
class DemandeEmploiUserController extends Controller
{
    public function GetAllDemandes(Request $request){
        $user = $request->user();
        $demandes = DemandeEmploiUser::where('user_id',$user->id)->paginate(PAGINATE_COUNT);
        if($demandes->count() <1){
            $message = "قائمة طلبات العمل فارغة";
            return $this->sendError($message);
        }
        $demandes = DemandeEmploiUserResource::collection($demandes)->response()->getData();
        return Response(['data' => $demandes],200);
    }   

    public function ShowDemande(Request $request,$uuid){
        $user = $request->user();
        $demande = DemandeEmploiUser::where('uuid',$uuid)->where('user_id',$user->id)->with('emploi')->first();
        if(!$demande){
            $message = "هذا الطلب غير موجود ";
            return $this->sendError($message);
        }
        $demande = new DemandeEmploiUserResource($demande);
        return Response(['data' => $demande],200);
    }
    public function StopDemande(Request $request,$uuid){
        $user = $request->user();
        $demande = DemandeEmploiUser::where('uuid',$uuid)->where('user_id',$user->id)->with('emploi')->first();
        if(!$demande){
            $message = "هذا الطلب غير موجود ";
            return $this->sendError($message);
        }
        $demande->is_active = 0;
        $demande->save();
        $status = 200;
        $message = "تمت توقيف طلب العمل بنجاح بنجاح";

        return $this->sendResponse($status, $message);
    }
    public function AddDemande(Request $request){
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'emploi_id' => 'required|exists:emplois,id',
            'wilaya_id' => 'required',
            'commune_id' => 'required',
            'degre_etude' => 'required',
            'experience' => 'required',
            'phone' => 'required',
        ]);
        

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try {
            $demande = DemandeEmploiUser::create([
                'uuid' => (string) Uuid::uuid4(),
                'emploi_id' => $request->emploi_id,
                'wilaya_id' => $request->wilaya_id,
                'commune_id' => $request->commune_id,
                'phone' => $request->phone,
                'degre_etude' => $request->degre_etude,
                'experience' => $request->experience,
                'other_emploi' => $request->emploi_id == 31 ? $request->other_emploi : '',
                'user_id'  => $user->id
            ]);
            
            
            $status = 200;
            $message = "تمت اضافة طلب العمل بنجاح";

            return $this->sendResponse($status, $message);
     } catch (\Throwable $th) {
        return Response(['data' => 'Unauthorized'],401);
    } 
        

    }

    public function UpdateDemande(Request $request,$uuid){
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'emploi_id' => 'required|exists:emplois,id',
            'wilaya_id' => 'required',
            'commune_id' => 'required',
            'degre_etude' => 'required',
            'experience' => 'required',
            'phone' => 'required',
        ]);
        
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try {
            $demande = DemandeEmploiUser::where('user_id',$user->id)->where('uuid',$uuid)->first();
            if(!$demande){
                $message = "هذا الطلب غير موجود ";
                return $this->sendError($message);
            }
            $demande->update([
                'emploi_id' => $request->emploi_id,
                'wilaya_id' => $request->wilaya_id,
                'commune_id' => $request->commune_id,
                'phone' => $request->phone,
                'degre_etude' => $request->degre_etude,
                'experience' => $request->experience,
                'other_emploi' => $request->emploi_id == 31 ? $request->other_emploi : '',
            ]);
            
            
            $status = 200;
            $message = "تم تعديل طلب العمل بنجاح";

            return $this->sendResponse($status, $message);
     } catch (\Throwable $th) {
        return Response(['data' => 'Unauthorized'],401);
        } 
        

    }


    public function ShowAllDemandes(){
        $demandes = DemandeEmploiUser::where('is_active',1)->with('creche')->with('emploi')->paginate(PAGINATE_COUNT);
        if($demandes->count() <1){
            $message = "قائمة طلبات العمل فارغة";
            return $this->sendError($message);
        }
        $demandes = DemandeEmploiUserResource::collection($demandes)->response()->getData();
        return Response(['data' => $demandes],200);
    }
    public function ShowDemandeToUser(Request $request,$uuid){
        $demande = DemandeEmploiUser::where('uuid',$uuid)->with('emploi')->first();
        if(!$demande){
            $message = "هذا الطلب غير موجود ";
            return $this->sendError($message);
        }
        $demande = new DemandeEmploiUserResource($demande);
        return Response(['data' => $demande],200);
    }

    public function SearchDemande(Request $request){
        $type = $request->type;
        $wilaya = $request->wilaya;
        $commune = $request->commune;
        $query = DemandeEmploiUser::query();
        $query->where('is_active',1);
        
        if (!empty($type)) {
            $query->where('emploi_id',$type);         
        }
        if (!empty($wilaya)) {
            $query->where('wilaya_id', $wilaya);
        }
        if (!empty($commune)) {
            $query->where('commune_id', $commune);
        }
        $creches = $query->paginate(PAGINATE_COUNT);

        $demandes = $query->with('user')->with('emploi')->paginate(PAGINATE_COUNT);

        if(!$demandes || count($demandes) < 1){
            $message = "هذا الطلب غير موجود ";
            return $this->sendError($message);
        }
        $demandes = DemandeEmploiUserResource::collection($demandes)->response()->getData();
        return Response(['data' => $demandes],200);
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
