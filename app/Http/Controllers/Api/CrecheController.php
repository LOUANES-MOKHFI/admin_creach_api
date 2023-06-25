<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\OffreEmploi;
use App\Models\ProgrammesCreche;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Resources\ProgrammeCrecheResource;
use App\Http\Resources\CrecheResource;
use App\Http\Resources\BlogResource;
use App\Http\Resources\OffreEmploiResource;

class CrecheController extends Controller
{
    public function GetAllCreches(Request $request){
        $creches = User::where('type','creche')->where('is_active',1)->paginate(PAGINATE_COUNT);
        if($creches->count() <1){
            $message = "قائمة الروضات فارغة";
            return $this->sendError($message);
        }
        $creches = CrecheResource::collection($creches)->response()->getData();
        return Response(['data' => $creches],200);
    }   

    public function ShowCreche($uuid){
        $creche = User::where('type','creche')->where('is_active',1)->where('uuid',$uuid)->first();
       
        //->with('programme')->with('blogs_creche')->with('offres')
        if(!$creche){
            $message = "هذه الروضة غير موجود ";
            return $this->sendError($message);
        }
        $data['creche'] = new CrecheResource($creche);
        $data['programme'] = new ProgrammeCrecheResource(ProgrammesCreche::where('id',$data['creche']->programme_id)->first());
        $data['blogs_creche'] = BlogResource::collection(Blog::where('creche_id',$data['creche']->id)->paginate(PAGINATE_COUNT))->response()->getData();;
        $data['offres'] = OffreEmploiResource::collection(OffreEmploi::where('creche_id',$data['creche']->id)->paginate(PAGINATE_COUNT))->response()->getData();;
        return Response(['data' => $data],200);
    }

    public function SearchCreche(Request $request){
        $keyword = $request->keyword;
        $wilaya = $request->wilaya;
        $commune = $request->commune;
        $query = User::query();
        $query->where('type','creche')->where('is_active',1);
        
        if (!empty($keyword)) {
            $query->where('creche_name', 'LIKE', '%' . $keyword . '%');
                    
        }
        if (!empty($wilaya)) {
            $query->where('wilaya_id', $wilaya);
        }
        if (!empty($commune)) {
            $query->where('commune_id', $commune);
        }
        $creches = $query->paginate(PAGINATE_COUNT);
        
        if(!$creches || count($creches) < 1){
            $message = "قائمة الروضات فارغة";
            return $this->sendError($message);
        }
        $creches = CrecheResource::collection($creches)->response()->getData();
        return Response(['data' => $creches],200);
    }
    public function GetAllBlogs(Request $request){

        $blogs = Blog::paginate(PAGINATE_COUNT);
        if($blogs->count() <1){
            $message = "قائمة المقالات فارغة";
            return $this->sendError($message);
        }
        $blogs = BlogResource::collection($blogs)->response()->getData();
        return Response(['data' => $blogs],200);
    }  
    
    public function ShowBlog($slug){
        $blog = Blog::where('slug',$slug)->first();

        if(!$blog){
            $message = "هذه المقالة غير موجود ";
            return $this->sendError($message);
        }
        $blog->nbr_view++;
        $blog->save();
        $blog = new BlogResource($blog);
        return Response(['data' => $blog],200);
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
