<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DomaineVendeur;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\OffreEmploi;
use App\Models\ProgrammesCreche;
use Illuminate\Foundation\Auth\User;
use App\Http\Resources\ProductResource;
use App\Http\Resources\VendorResource;
use App\Http\Resources\DomaineVendorResource;

class VendorController extends Controller
{
    public function GetAllVendors(Request $request){
        $vendors = User::where('type','vendeur')->where('is_active',1)->get();
        if($vendors->count() <1){
            $message = "قائمة البائعين فارغة";
            return $this->sendError($message);
        }
        $vendors = VendorResource::collection($vendors);
        return Response(['data' => $vendors],200);
    }   

    public function ShowVendor($uuid){
        $vendor = User::where('type','vendeur')->where('is_active',1)->where('uuid',$uuid)->first();
       
        //->with('programme')->with('blogs_vendor')->with('offres')
        if(!$vendor){
            $message = "هذه الروضة غير موجود ";
            return $this->sendError($message);
        }
        $data['vendor'] = new VendorResource($vendor);
        $data['domaine'] = new DomaineVendorResource(DomaineVendeur::where('id',$data['vendor']->domaine_vendeur)->first());
        $data['products'] = ProductResource::collection(Product::where('vendor_id',$data['vendor']->id)->get());
        return Response(['data' => $data],200);
    }

    public function SearchVendor(Request $request){
        $keyword = $request->keyword;
        $wilaya = $request->wilaya;
        $commune = $request->commune;
        $query = User::query();
        $query->where('type','vendeur')->where('is_active',1);
        if (!empty($keyword)) {
            $query->where('store_name', 'LIKE', '%' . $keyword . '%');
                    
        }
        if (!empty($wilaya)) {
            $query->where('wilaya_id', $wilaya);
        }
        if (!empty($commune)) {
            $query->where('commune_id', $commune);
        }        

        $vendors = $query->get();
        
        if(!$vendors || count($vendors) < 1){
            $message = "قائمة البائعين فارغة";
            return $this->sendError($message);
        }
        $vendors = VendorResource::collection($vendors);
        
        return Response(['data' => $vendors],200);
    }
    public function GetAllProducts(Request $request){

        $products = Product::get();
        if(!$products || $products->count() <1){
            $message = "قائمة المنتجات فارغة";
            return $this->sendError($message);
        }
        $products = ProductResource::collection($products);
        return Response(['data' => $products],200);
    }  
    
    public function ShowProduct($slug){
        $product = Product::where('slug',$slug)->with('categories')->with('images')->with('vendor')->first();

        if(!$product){
            $message = "هذا المنتج غير موجود ";
            return $this->sendError($message);
        }
       
        $product = new ProductResource($product);
        return Response(['data' => $product],200);
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
