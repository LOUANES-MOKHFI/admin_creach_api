<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Ramsey\Uuid\Uuid;
use App\Events\RegisterEvent;
class RegisterController extends Controller
{
    public function UserRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'wilaya_id' => 'required',
            'commune_id' => 'required',
            'pays_id' => 'required',
            'type_user' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $request->request->add(['type' => 'user']);
        $request->request->add(['is_active' => 1]);
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] =  $user->createToken('CrecheApp')->plainTextToken;
        $success['name'] =  $user->name;
        $user->uuid = (string) Uuid::uuid4();
        $user->save();
        $notification = Notification::create([
            'uuid' => (string) Uuid::uuid4(),
            'uuid_model'=> $user->uuid,
            'model' => '\App\Models\User',
            'link' => 'admin.users.show',
            'is_viewed' => 0,
        ]);
        return $this->sendResponse($success, 'User register successfully.');
    }
    public function VendeurRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'domaine_vendeur' => 'required',
            'store_name' => 'required',
            'livraison' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'wilaya_id' => 'required',
            'commune_id' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $request->request->add(['type' => 'vendeur']);
        //$request->request->add(['is_active' => 1]);
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        
        $success['token'] =  $user->createToken('CrecheApp')->plainTextToken;
        $success['name'] =  $user->name;
        $user->uuid = (string) Uuid::uuid4();
        $user->save();
        $notification = Notification::create([
            'uuid' => (string) Uuid::uuid4(),
            'uuid_model'=> $user->uuid,
            'model' => '\App\Models\User',
            'link' => 'admin.vendeurs.show',
            'is_viewed' => 0,
        ]);
        return $this->sendResponse($success, 'User register successfully.');
    }

    public function CrecheRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type_creche' => 'required',
            'creche_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'wilaya_id' => 'required',
            'commune_id' => 'required',
            'programme_id' => 'required',
            //'image_rc' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $request->request->add(['type' => 'creche']);
        //$request->request->add(['is_active' => 1]);
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        
        $success['token'] =  $user->createToken('CrecheApp')->plainTextToken;
        $success['name'] =  $user->name;
        $user->uuid = (string) Uuid::uuid4();
        $user->save();
        $notification = Notification::create([
            'uuid' => (string) Uuid::uuid4(),
            'uuid_model'=> $user->uuid,
            'model' => '\App\Models\User',
            'link' => '/admin/creches/show/'.$user->uuid,
            'is_viewed' => 0,
        ]);
        event(new RegisterEvent($notification->uuid_model,$notification->link,$notification->model,$notification->created_at));

        return $this->sendResponse($success, 'User register successfully.');
    }

    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
}
