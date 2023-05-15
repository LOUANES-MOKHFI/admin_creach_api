<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth;
use Validator;
class AdminLoginController extends Controller
{
    public function login(Request $request) : Response{
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){

            return Response(['message' => $validator->errors()],401);
        }
        if(auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input('password')])){
            $user = auth('admin')->user(); 
    
            $success =  $user->createToken('crechAdmin')->plainTextToken; 
        
            return Response(['token' => $success],200);
        }

        return Response(['message' => 'email or password wrong'],401);
    }

    public function AdminDetails(Request $request)
    {
        
        if($request->user()) {

            $user = $request->user();

            return Response(['data' => $user],200);
        }

        return Response(['data' => 'Unauthorized'],401);
    }
    public function logout(Request $request){
        if($request->user()){
            $request->user()->currentAccessToken()->delete();
            return Response(['data' => 'User Logout successfully.'],200);
        }
        
    
    }
        

}
