<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Category;

class FaqController extends Controller
{
    public function GetAllFaqs(){

        $faqs = Faq::get();
        if($faqs->count() <1){
            $message = "قائمة الاستشارات فارغة";
            return $this->sendError($message);
        }
        return Response(['data' => $faqs],200);
    }  

    public function GetAllCategoryFaqs(){

        $categories = Category::orderBy('id','DESC')->where('type','faq')->get();
        if($categories->count() <1){
            $message = "قائمة أقسام الاستشارات فارغة";
            return $this->sendError($message);
        }
        return Response(['data' => $categories],200);
    }  

    public function GetAllFaqsInCategory($category){
        
        $data = [];
        $data['category'] = Category::where('slug',$category)->where('type','faq')->first();
        if(!$category){
            $message = "لا يوجد هذا القسم";
            return $this->sendError($message);
        }
        $data['faqs'] = Faq::where('category_id',$category->id)->get();
        if($faqs->count() <1){
            $message = "لا توجد استشارات في هذا القسم";
            return $this->sendError($message);
        }
        return Response(['data' => $data],200);
    }  
}
