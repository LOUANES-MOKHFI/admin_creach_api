<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Category;
use App\Http\Resources\FaqResource;
class FaqController extends Controller
{
    public function GetAllFaqs(){

        $faqs = Faq::paginate(PAGINATE_COUNT);
        if($faqs->count() <1){
            $message = "قائمة الاستشارات فارغة";
            return $this->sendError($message);
        }
        $faqs = FaqResource::collection($faqs)->response()->getData();
        return Response(['data' => $faqs],200);
    }  

    public function GetAllCategoryFaqs(){

        $categories = Category::orderBy('id','DESC')->where('type','faq')->paginate(PAGINATE_COUNT);
        if($categories->count() <1){
            $message = "قائمة أقسام الاستشارات فارغة";
            return $this->sendError($message);
        }
        return Response(['data' => $categories],200);
    }  

    public function GetAllFaqsInCategory($category){
        
        $data = [];
        $data['category'] = Category::where('slug',$category)->where('type','faq')->first();
        //dd($data);
        if(!$category){
            $message = "لا يوجد هذا القسم";
            return $this->sendError($message);
        }
        $faqs = Faq::where('category_id',$data['category']->id)->paginate(PAGINATE_COUNT);
        //dd($faqs);
        if(!$faqs || $faqs->count() <1){
            $message = "لا توجد استشارات في هذا القسم";
            return $this->sendError($message);
        }
        $data['faqs'] = FaqResource::collection($faqs)->response()->getData();;
        return Response(['data' => $data],200);
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
