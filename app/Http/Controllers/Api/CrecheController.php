<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\OffreEmploi;
use App\Models\ProgrammesCreche;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class CrecheController extends Controller
{
    public function GetAllCreches(Request $request){
        $creches = User::where('type','creche')->where('is_active',1)->get();
        if($creches->count() <1){
            $message = "قائمة الروضات فارغة";
            return $this->sendError($message);
        }
        return Response(['data' => $creches],200);
    }   

    public function ShowCreche($uuid){
        $data['creche'] = User::where('type','creche')->where('is_active',1)->where('uuid',$uuid)->first();
       
        //->with('programme')->with('blogs_creche')->with('offres')
        if(!$data['creche']){
            $message = "هذه الروضة غير موجود ";
            return $this->sendError($message);
        }
        $data['programme'] = ProgrammesCreche::where('id',$data['creche']->programme_id)->first();
        $data['blogs_creche'] = Blog::where('creche_id',$data['creche']->id)->get();
        $data['offres'] = OffreEmploi::where('creche_id',$data['creche']->id)->get();
        return Response(['data' => $data],200);
    }

    public function SearchCreche($keyword){
        $creches = User::where('type','creche')->where('is_active',1)->where('creche_name','LIKE','%'.$keyword.'%')->first();
        if(!$creches){
            $message = "قائمة الروضات فارغة";
            return $this->sendError($message);
        }
        return Response(['data' => $creches],200);
    }
    public function GetAllBlogs(Request $request){

        $blogs = Blog::get();
        if($blogs->count() <1){
            $message = "قائمة المقالات فارغة";
            return $this->sendError($message);
        }
        return Response(['data' => $blogs],200);
    }  
    
    public function ShowBlog($slug){
        $blog = Blog::where('slug',$slug)->with('creche')->with('comments')->with('images')->first();

        if(!$blog){
            $message = "هذه المقالة غير موجود ";
            return $this->sendError($message);
        }
       
        return Response(['data' => $blog],200);
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
