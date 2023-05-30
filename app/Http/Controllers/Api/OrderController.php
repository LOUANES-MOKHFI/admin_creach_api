<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
class OrderController extends Controller
{
    public function GetAllMyOrders(Request $request){
    	$user = $request-user();
    	$orders = Order::where('user_id',$user->id)->get();
        if($orders->count() <1){
            $message = "قائمة عروض العمل فارغة";
            return $this->sendError($message);
        }
        return Response(['data' => $orders],200);
    }

    public function AddOrder(Request $request){
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
        ]);
        

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try {
        	$product = Product::where('id',$request->product_id)->first();
        	if(!$product){
                $message = "هذا العرض غير موجود ";
                return $this->sendError($message);
            }
            $offre = OffreEmploi::create([
                'uuid' => (string) Uuid::uuid4(),
                'product_id' => $request->product_id,
                'qty' => $request->qty,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'total_order' => $request->qty * $product->price,
                'note' => $request->note,
                'user_id'  => $user->id
            ]);
            
            
            $status = 200;
            $message = "تمت اضافة عرض العمل بنجاح بنجاح";

            return $this->sendResponse($status, $message);
	    }catch (\Throwable $th) {
	        return Response(['data' => 'Unauthorized'],401);
	   	} 

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
