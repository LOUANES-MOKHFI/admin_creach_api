<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoryProducts;
use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use Validator;
use Ramsey\Uuid\Uuid;
use DB;
use Illuminate\Support\Str;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function GetAllProducts(Request $request){
        $user = $request->user();
        $products = Product::where('vendor_id',$user->id)->paginate(PAGINATE_COUNT);
        if(!$products){
            $message = "قائمة منتجاتك فارغة";
            return $this->sendError($message);
        }
        $products = ProductResource::collection($products)->response()->getData();
        return Response(['data' => $products],200);
    }
    public function ShowProduct(Request $request,$uuid){
        $user = $request->user();
        $product = Product::where('uuid',$uuid)->where('vendor_id',$user->id)->with('categories')->with('images')->first();
        if(!$product){
            $message = "هذا المنتج غير موجود ";
            return $this->sendError($message);
        }
        $product = new ProductResource($product);
        return Response(['data' => $product],200);
    }

    public function AddProduct(Request $request){
        //dd($request->has('images'));
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'categories' => 'required',
            'images' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try {
            $product = Product::create([
                'uuid' => (string) Uuid::uuid4(),
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'price' => $request->price,
                'gros_price' => $request->gros_price,
                'description' => $request->description,
                'vendor_id'  => $user->id
            ]);
            
            $product->categories()->attach($request->categories);
            if($request->has('images')){
                foreach($request->images as $image){
                    $productImage = new ProductImages();
                    $filename = '';
                    $file = $image;
                    $filename = UploadFile('products',$file);
                    $productImage->image = $filename;
                    $productImage->product_id = $product->id;
                    $productImage->save();
                }
            }
            $status = 200;
            $message = "تمت اضافة المنتج بنجاح بنجاح";

            return $this->sendResponse($status, $message);
     } catch (\Throwable $th) {
        return Response(['data' => 'Unauthorized'],401);
    } 
        

    }

    public function UpdateProduct(Request $request,$uuid){
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            //'categories' => 'required',
            //'images' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try {
            $product = Product::where('uuid',$uuid)->where('vendor_id',$user->id)->first();

            if(!$product){
                $message = "هذا المنتج غير موجود ";
                return $this->sendError($message);
            }
            $product->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'price' => $request->price,
                'gros_price' => $request->gros_price,
                'description' => $request->description,
            ]);
            
            $product->categories()->sync($request->categories);
            if($request->has('images')){
                foreach($request->images as $image){
                    $productImage = new ProductImages();
                    $filename = '';
                    $file = $image;
                    $filename = UploadFile('products',$file);
                    $productImage->image = $filename;
                    $productImage->product_id = $product->id;
                    $productImage->save();
                }
            }
            $status = 200;
            $message = "تم تعديل المنتج بنجاح بنجاح";

            return $this->sendResponse($status, $message);
     } catch (\Throwable $th) {
        return Response(['data' => 'Unauthorized'],401);
    } 
        

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
