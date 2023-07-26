<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Validator;
use Ramsey\Uuid\Uuid;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function GetAllMyOrders(Request $request){
    	$user = $request->user();
    	$orders = Order::where('user_id',$user->id)->paginate(PAGINATE_COUNT);
        if($orders->count() <1){
            $message = "قائمة طلبياتك فارغة";
            return $this->sendError($message);
        }
        $orders = OrderResource::collection($orders)->response()->getData();
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
                $message = "هذا المنتج غير موجود ";
                return $this->sendError($message);
            }
            $order = Order::create([
                'product_id' => $request->product_id,
                'vendor_id' => $product->vendor_id,
                'qty' => $request->qty,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'total_order' => $request->qty * $product->price,
                'note' => $request->note,
                'user_id'  => $user->id
            ]);
            
            $vendor = User::where('id',$product->vendor_id)->first();
            if($vendor->count()>0){
                $this->sendMailInfoOrder($vendor->email,$user->email,$user->name,$product->name);
            }
            $status = 200;
            $message = "تمت اضافة الطلبية بنجاح";

            return $this->sendResponse($status, $message);
	    }catch (\Throwable $th) {
	        return Response(['data' => 'Unauthorized'],401);
	   	}  


           
    }
    public function GetAllMyStoreOrders(Request $request){
    	$user = $request->user();
    	$orders = Order::where('vendor_id',$user->id)->paginate(PAGINATE_COUNT);
        if($orders->count() <1){
            $message = "قائمة طلبياتك فارغة";
            return $this->sendError($message);
        }
        $orders = OrderResource::collection($orders)->response()->getData();
        return Response(['data' => $orders],200);
    }

    public function ShowStoreOrders(Request $request,$id){
    	$user = $request->user();
    	$order = Order::where('vendor_id',$user->id)->where('id',$id)->with('user')->with('vendor')->first();
        if(!$order){
            $message = "هذه الطلبية غير موجودة";
            return $this->sendError($message);
        }
        $order = new OrderResource($order);
        return Response(['data' => $order],200);
    }
    
    function sendMailInfoOrder($vendor_email,$client_email,$client_name,$product_name){
        $data = array(
        'name'=>$client_name, 
        "header" => "لديك طلبية جديدة في منصة روضتي",
        "Email"   => $client_email,
        "Name"    => $client_name,
        "Product" => $product_name
        );
        Mail::send('admin.emails.email_order', $data, function($message) use ($client_name, $vendor_email) {
        $message->to($vendor_email, $client_name)
        ->subject(' التسجيل في روضتي');
        $message->from('louanes.mokhfi@gmail.com','RawdatiDZ');
        });
        
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
