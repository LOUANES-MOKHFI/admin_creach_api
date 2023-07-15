<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\ProgrammesCreche;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Ramsey\Uuid\Uuid;
use App\Events\RegisterEvent;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\UserResource;
use App\Http\Resources\CrecheResource;
use App\Http\Resources\VendorResource;
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
       
        $user->uuid = (string) Uuid::uuid4();
        $user->save();
        $success['user'] =  new UserResource($user);
        $notification = Notification::create([
            'uuid' => (string) Uuid::uuid4(),
            'uuid_model'=> $user->uuid,
            'model' => '\App\Models\User',
            'link' => '/admin/users/show/'.$user->uuid,
            'is_viewed' => 0,
        ]);
        event(new RegisterEvent($notification->uuid_model,$notification->link,$user->name,$user->email,$user->type,$notification->created_at));
        //$this->sendMailUser($user->name,$user->email,$user->type);
        //$this->sendMailAdmin($user->name,$user->email,$user->type);
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
        
        //$success['token'] =  $user->createToken('CrecheApp')->plainTextToken;
        
        $user->uuid = (string) Uuid::uuid4();
       
         if($request->has('logo')){
            $filename = '';
            $file = $request->file('logo');
            $filename = UploadFile('logo',$file);
           // $creche->logo = $filename;
        } 
        $user->save();
        $success['vendor'] =  new VendorResource($user);
        $notification = Notification::create([
            'uuid' => (string) Uuid::uuid4(),
            'uuid_model'=> $user->uuid,
            'model' => '\App\Models\User',
            'link' => '/admin/vendeurs/show/'.$user->uuid,
            'is_viewed' => 0,
        ]);
        event(new RegisterEvent($notification->uuid_model,$notification->link,$user->name,$user->email,$user->type,$notification->created_at));
        $this->sendMailUser($user->name,$user->email,$user->type);
        $this->sendMailAdmin($user->name,$user->email,$user->type);
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
        if($request->programme_id == 13){
            $request->request->add(['other_programme' => $request->other_programme]);
        }
        $request->request->add(['type' => 'creche']);
        //$request->request->add(['is_active' => 1]);
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        
        //$success['token'] =  $user->createToken('CrecheApp')->plainTextToken;
        //$success['name'] =  $user->name;
        $user->uuid = (string) Uuid::uuid4();
         if($request->has('logo')){
            $filename = '';
            $file = $request->file('logo');
            $filename = UploadFile('logo',$file);
           // $creche->logo = $filename;
        }
        if($request->has('image_rc')){
            $filename = '';
            $file = $request->file('image_rc');
            $filename = UploadFile('image_rc',$file);
           // $creche->logo = $filename;
        } 
        $user->save();
        $success['creche'] =  new CrecheResource($user);
        $notification = Notification::create([
            'uuid' => (string) Uuid::uuid4(),
            'uuid_model'=> $user->uuid,
            'model' => '\App\Models\User',
            'link' => '/admin/creches/show/'.$user->uuid,
            'is_viewed' => 0,
        ]);
        event(new RegisterEvent($notification->uuid_model,$notification->link,$user->name,$user->email,$user->type,$notification->created_at));
        $this->sendMailUser($user->name,$user->email,$user->type);
        $this->sendMailAdmin($user->name,$user->email,$user->type);
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
    public function sendError($error, $errorMessages = [], $code = 204)
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

    function sendMailAdmin($client_name,$client_email,$type_user){
        $to_email = 'louanes.mokhfi@gmail.com';
        $data = array('name'=>$client_name, "header" => "لديك حساب جديد في منصة روضتي : ",
        "Email" =>$client_email,
        "Name" => $client_name,
        "typeUser" => $type_user,
        );
        Mail::send('admin.emails.email_admin', $data, function($message) use ($client_name, $to_email) {
        $message->to($to_email, $client_name)
        ->subject('حساب جديد');
        $message->from('louanes.mokhfi@gmail.com','RawdatiDZ');
        });
        
    }

    function sendMailUser($client_name,$client_email,$type_user){
        $to_email = 'louanes.mokhfi@gmail.com';
        $data = array('name'=>$client_name, "header" => "لقد قمت بالتسجيل في منصة روضتي ديزاد, ستتلقى رسالة عندما يتم تأكيد حسابك.");
        Mail::send('admin.emails.email_user', $data, function($message) use ($client_name, $client_email) {
        $message->to($client_email, $client_name)
        ->subject(' التسجيل في روضتي');
        $message->from('louanes.mokhfi@gmail.com','RawdatiDZ');
        });
        
    }
}
