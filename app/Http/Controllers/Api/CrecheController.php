<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Blog;
use App\Models\FollowUser;
use App\Models\OffreEmploi;
use App\Models\ProgrammesCreche;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Resources\ProgrammeCrecheResource;
use App\Http\Resources\CrecheResource;
use App\Http\Resources\BlogResource;
use App\Http\Resources\OffreEmploiResource;
use App\Models\Countrie;
use App\Models\Wilaya;
use App\Models\Commune;
class CrecheController extends Controller
{
    public function GetAllCreches(Request $request){


        $creches = User::select('id','uuid','type','name','email','phone','type_creche','creche_name','programme_id'
        ,'other_programme','facebook','instagram','tiktok','youtube','pays_id','wilaya_id','commune_id','localisation')->where('type','creche')->where('is_active',1)->paginate(PAGINATE_COUNT);
        if($creches->count() <1){
            $message = "قائمة الروضات فارغة";
            return $this->sendError($message);
        }
        $data = [];
        foreach($creches as $creche){
            $data[] = [
                'id' => $creche->id,
                'uuid' => $creche->uuid,
                'name' => $creche->name,
                'email' => $creche->email,
                'phone' => $creche->phone,
                'type_creche' => $creche->type_creche,
                'creche_name' => $creche->creche_name,
                'programme_id' => $creche->programme_id,
                'other_programme' => $creche->other_programme,
                'facebook' => $creche->facebook,
                'instagram' => $creche->instagram,
                'tiktok' => $creche->tiktok,
                'youtube' => $creche->youtube,
                'pays' => $creche->pays_id ? $this->getPays($creche->pays_id) : '',
                'wilaya' => $this->getWilaya($creche->wilaya_id),
                'commune' => $this->getCommune($creche->commune_id),
                'localisation' => $creche->localisation,
            ];
        }
        $creches1['data'] = $data;
        $creches = CrecheResource::collection($creches)->response()->getData();
        return Response(['data' => $creches1],200);
    }   

    public function ShowCreche($uuid){
        $creche = User::select('id','uuid','type','name','email','phone','type_creche','creche_name','programme_id'
        ,'other_programme','facebook','instagram','tiktok','youtube','pays_id','wilaya_id','commune_id','localisation')->where('type','creche')->where('is_active',1)->where('uuid',$uuid)->first();
       
        //->with('programme')->with('blogs_creche')->with('offres')
        if(!$creche){
            $message = "هذه الروضة غير موجود ";
            return $this->sendError($message);
        }
        $data['creche'] = [
            'id' => $creche->id,
            'uuid' => $creche->uuid,
            'name' => $creche->name,
            'email' => $creche->email,
            'phone' => $creche->phone,
            'type_creche' => $creche->type_creche,
            'creche_name' => $creche->creche_name,
            'programme_id' => $creche->programme_id,
            'other_programme' => $creche->other_programme,
            'facebook' => $creche->facebook,
            'instagram' => $creche->instagram,
            'tiktok' => $creche->tiktok,
            'youtube' => $creche->youtube,
            'pays' => $creche->pays_id ? $this->getPays($creche->pays_id) : '',
            'wilaya' => $this->getWilaya($creche->wilaya_id),
            'commune' => $this->getCommune($creche->commune_id),
            'localisation' => $creche->localisation,
        ];
        $data['programme'] = new ProgrammeCrecheResource(ProgrammesCreche::where('id',$creche->programme_id)->first());
        $data['blogs_creche'] = BlogResource::collection(Blog::where('creche_id',$creche->id)->paginate(PAGINATE_COUNT))->response()->getData();;
        $data['offres'] = OffreEmploiResource::collection(OffreEmploi::where('creche_id',$creche->id)->paginate(PAGINATE_COUNT))->response()->getData();;
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

        $data = [];
        $blogs = Blog::where('type','blog')->orderBy('created_at','DESC')->paginate(PAGINATE_COUNT);
        if($blogs->count() <1){
            $message = "قائمة المقالات فارغة";
            return $this->sendError($message);
        }
        $creches = User::where('type','creche')->where('is_active',1)->orderBy('nbr_follow','DESC')->limit(6)->get();
        
        $data['blogs'] = BlogResource::collection($blogs)->response()->getData();
        $data['creches'] = CrecheResource::collection($creches);
        return Response(['data' => $data],200);
    }  
    
    public function ShowBlog($uuid){
        $blog = Blog::where('uuid',$uuid)->first();

        if(!$blog){
            $message = "هذه المقالة غير موجود ";
            return $this->sendError($message);
        }
        $blog->nbr_view++;
        $blog->save();
        $blog = new BlogResource($blog);
        return Response(['data' => $blog],200);
    }

    public function AddFollowToCreche(Request $request){
        $user = $request->user();
        $creche = User::where('uuid',$request->creche_id)->first();
        if(!$creche){
            $message = "هذه الروضة غير موجودة ";
            return $this->sendError($message);
        }
        $follow_user = FollowUser::where('user_id',$user->id)->where('creche_id',$creche->id)->first();
        
        if($follow_user && $follow_user->count() > 0){
            $follow_user->delete();
            $creche->nbr_follow --;
            $creche->save();
            $message = "تمت حذف متابعتك لللروضة بنجاح";
        }else{
            $follow = FollowUser::create([
                'user_id' => $user->id,
                'creche_id' => $creche->id
            ]);
            $creche->nbr_follow ++;
            $creche->save();
            $message = "تمت اضافة متابعتك لللروضة بنجاح";
        }
        
        $status = 200;
        

        return $this->sendResponse($status, $message);
    }

    public function FollowerList(Request $request){
        $user = $request->user();
        $followers_user_id = FollowUser::where('creche_id',$user->id)->pluck('user_id');
        $users = User::whereIn('id',$followers_user_id)->get();
        $users = UserResource::collection($users)->response()->getData();
        return Response(['data' => $users],200);
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

    function getPays($id){

        $pays = Countrie::where('id',$id)->first();
        return $pays->name;
    }
    function getWilaya($id){

        $wilaya = Wilaya::where('id',$id)->first();
        return $wilaya->name;
    }
    function getCommune($id){

        $commune = Commune::where('id',$id)->first();
        return $commune->name;
    }
}
