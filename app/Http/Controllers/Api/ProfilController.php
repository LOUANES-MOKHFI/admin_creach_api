<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
class ProfilController extends Controller
{
    public function Profile(Request $request)
    {
        
        if($request->user()) {

            $user = $request->user();
            if($user->is_active == 0){
                $message = "votre session n'est pas activer par les administrateur de la plateform, veuillez contactez le support ";
                return $this->sendError($message);
            }
            return Response(['data' => $user],200);
        }

        return Response(['data' => 'Unauthorized'],401);
    }

    public function ChangePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try {
            $user = $request->user();
            $user->password = bcrypt($request->password);
            $user->save();
            $status = 200;
            $message = "تم تغيير كلمة المرور بنجاح";

            return $this->sendResponse($status, $message);
        } catch (\Throwable $th) {
            return Response(['data' => 'Unauthorized'],401);
        }
    }
    public function ChangeInformation(Request $request){
       
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try {
            $user = $request->user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->pays_id = $request->pays_id;
            $user->wilaya_id = $request->wilaya_id;
            $user->commune_id = $request->commune_id;
            $user->type_user = $request->type_user;
            $user->save();
            $status = 200;
            $message = "تم تغيير المعلومات المعلومات بنجاح";

            return $this->sendResponse($status, $message);
        } catch (\Throwable $th) {
            return Response(['data' => 'Unauthorized'],401);
        }
    }
    public function ChangeInformationVendor(Request $request){
       
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'domaine_vendeur' => 'required',
            'email' => 'required|email',
            'store_name' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        //try {
            $user = $request->user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->pays_id = $request->pays_id;
            $user->wilaya_id = $request->wilaya_id;
            $user->commune_id = $request->commune_id;
            $user->domaine_vendeur = $request->domaine_vendeur;
            $user->store_name = $request->store_name;
            $user->save();
            $status = 200;
            $message = "تم تغيير المعلومات المعلومات بنجاح";
            
            return $this->sendResponse($status, $message);
        /* } catch (\Throwable $th) {
            return Response(['data' => 'Unauthorized'],401);
        } */
    }

    public function ChangeInformationCreche(Request $request){
       
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'creche_name' => 'required',
            'type_creche' => 'required',
            'email' => 'required|email',
            'programme_id' => 'required|exists:programmes_creches,id',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        //try {
            $user = $request->user();
            
            $user->name = $request->name;
            $user->creche_name = $request->creche_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->pays_id = $request->pays_id;
            $user->wilaya_id = $request->wilaya_id;
            $user->commune_id = $request->commune_id;
            $user->type_creche = $request->type_creche;
            $user->programme_id = $request->programme_id;
            $user->save();
            $status = 200;
            $message = "تم تغيير المعلومات المعلومات بنجاح";

            return $this->sendResponse($status, $message);
        /* } catch (\Throwable $th) {
            return Response(['data' => 'Unauthorized'],401);
        } */
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