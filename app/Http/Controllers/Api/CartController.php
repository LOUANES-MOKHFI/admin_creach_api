<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Cart;
use Illuminate\Support\Str;
use DB;
class CartController extends Controller
{
    //protected $cart;

    /* public function __construct(Cart $cart)
    {
        $this->cart = $cart->name('shopping');
    }
 */
    public function CartContentHeader(){

        $data = [];
        $user = $request->user();
        $items = Cart::where('user_id',$user->id)->get();
        $totalPrice = 0;
        $countProduct = 0;
        foreach($items as $item){
            $countProduct++;
            $totalPrice = $totalPrice + $item->total_price;
        }
        $data['countProduct'] = $countProduct;
        $data['totalPrice'] = $totalPrice;
        return Response(['data' => $data],200);

    }

    public function addToCart(Request $request)
    {
        
        $user = $request->user();

        try{
            $product_id = $request->product_id;
            $qty = $request->qty;
            $user_id = $user->id;
            
            $product = Product::where('id',$product_id)->first();
            $cart = Cart::create([
                'user_id' => $user_id,
                'vendor_id' => $product->vendor_id,
                'product_id' => $product_id,
                'qty' => $qty,
                'price' => $product->price,
                'total_price' => $product->price * $qty,
            ]);

        //dd($this->cart->getDetails()->get('items')->groupBy('title'));
            $msg = "تمت اضافة المنتج الى السلة";
            return $this->sendResponse(200,$msg);
        }catch(\Throwable $th){
            return Response(['data' => 'Unauthorized'],401);
        }
    }
    
    public function updateItemInCart(Request $request){

        $user = $request->user();
        
        try{
            //$item_id = $request->item_id;
            $qty = $request->qty;
            $product_id = $request->product_id;
            $product = Product::where('id',$product_id)->first();
            $cart = Cart::where('user_id',$user->id)->where('product_id',$product_id)->first();
            $cart->update([
                'qty' => $qty,
                'price' => $product->price,
                'total_price' => $product->price * $qty,
            ]);
        // dd($updatedItem);
            $msg = "تم التعديل على السلة";
            return $this->sendResponse(200,$msg);
        }catch(\Throwable $th){
            return Response(['data' => 'Unauthorized'],401);
        } 
    }

    public function clearCart(Request $request)
    {
        $user = $request->user();
        try{
            $cart = Cart::where('user_id',$user->id)->delete();
            
            $msg = "تم تفريغ السلة";
            return $this->sendResponse(200,$msg);
         }catch(\Throwable $th){
            return Response(['data' => 'Unauthorized'],401);
        } 
    }

    public function clearItem(Request $request,$product_id){
        $user = $request->user();
        
        try{
            $cart = Cart::where('product_id',$product_id)->where('user_id',$user->id)->first();
            if($cart){
                $cart->delete();
            }
           // $cart->total_price;
                   
            $msg = "تم حذف المنتج من السلة";
            return $this->sendResponse(200,$msg);
        }catch(\Throwable $th){
            return Response(['data' => 'Unauthorized'],401);
        }
    }

    public function checkout(Request $request){

            $user = $request->user();
        try{
            $data = [];
            $data['items'] = Cart::select('id','user_id','vendor_id','product_id','qty','price','total_price')->where('user_id',$user->id)->get();
            $totalPrice = 0;
            $countProduct = 0;
            foreach($data['items'] as $item){
                $countProduct++;
                $totalPrice = $totalPrice + $item->total_price;
            }
            $data['countProduct'] = $countProduct;
            $data['totalPrice'] = $totalPrice;
            return Response(['data' => $data],200);
        }catch(\Throwable $th){
            return Response(['data' => 'Unauthorized'],401);
        }
    }

    public function validateCheckout(Request $request){
        
        //try{
            DB::beginTransaction();
            $user = $request->user();
            
            $product = Product::where('id',$request->product_id)->first();
            $items = Cart::where('user_id',$user->id)->get();
            $totalPrice = 0;
            foreach($items as $itemp){
                $totalPrice = $totalPrice + $itemp->total_price;
            }
            $id = Order::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'total_order' => $totalPrice,
                'note' => $request->note,
                'user_id'  => $user->id,
            ])->id;
            
            foreach($items as $key => $item){
                $orderDetail = OrderDetail::create([
                    'order_id' => $id,
                    'product_id' => $item->product_id,
                    'vendor_id' => $item->vendor_id,
                    'qty' => $item->qty,
                    'price' => $item->price,
                ]);
            }
            if($id && $orderDetail){
                $this->clearCart($request);
                //$this->sendMail($request->name,$request->email,$code);
                DB::commit();
                $msg = "تم تأكيد الطلبية";
                return $this->sendResponse(200,$msg);
            }else{
                return $this->sendError("هناك خطأ في السيرفر");
            }
            
        /* }catch(\Exception $e){
            return Response(['data' => 'Unauthorized'],401);
           // DB::rollback();
        } */
        
        
    }
    function sendMail($client_name,$client_email,$code_order){
        //$to_email = 'louanes.mokhfi@gmail.com';
        $to_email = 'louanes.mokhfi@gmail.com';
        $data = array('name'=>$client_name, "header" => "لديك طلبية جديدة :",
        "Email" => "إيمايل العميل :".$client_email,
        "Name" => "اسم العميل :".$client_name,
        "codeOrder" => "كود الطلبية  :".$code_order);
        Mail::send('emails.mail', $data, function($message) use ($client_name, $to_email) {
        $message->to($to_email, $client_name)
        ->subject('الأكادمية للنشر و الترجمة');
        $message->from('library@g-clinique.com','الأكادمية للنشر و الترجمة');
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
