<?php

namespace App\Http\Controllers\Api;

use App\Events\NewBlogEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogImages;
use App\Models\HeartUser;
use App\Models\Notification;
use Validator;
use Ramsey\Uuid\Uuid;
use DB;
use Illuminate\Support\Str;
use App\Http\Resources\BlogResource;

class ContributionBlogController extends Controller
{
    

    
    public function GetAllContributions(Request $request){
        $user = $request->user();
        $blogs = Blog::where('creche_id',$user->id)->where('type','contribution')->paginate(PAGINATE_COUNT);
        if($blogs->count() < 1){
            $message = "قائمة المساهمات فارغة";
            return $this->sendError($message);
        }
        $blogs = BlogResource::collection($blogs)->response()->getData();;
        return Response(['data' => $blogs],200);
    }
    public function ShowContribution(Request $request,$uuid){
        $user = $request->user();
        $blog = Blog::where('uuid',$uuid)->where('creche_id',$user->id)->where('type','contribution')->with('images')->with('comments')->with('heart_users')->first();
        if(!$blog){
            $message = "هذه المساهمة غير موجود ";
            return $this->sendError($message);
        }
        $blog->nbr_view++;
        $blog->save();
        $blog = new BlogResource($blog);
        return Response(['data' => $blog],200);
    }

    public function AddContribution(Request $request){
        //dd($request->has('images'));
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try {
            $blog = Blog::create([
                'uuid' => (string) Uuid::uuid4(),
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'creche_id'  => $user->id,
                'category_id'  => $request->category,
                'type'  => 'contribution'
            ]);
            
            if($request->has('images')){
                foreach($request->images as $image){
                    $blogImage = new BlogImages();
                    $filename = '';
                    $file = $image;
                    $filename = UploadFile('blogs',$file);
                    $blogImage->image = $filename;
                    $blogImage->blog_id = $blog->id;
                    $blogImage->save();
                }
            }
            if($request->has('videos')){
                $filename = '';
                $file = $request->file('videos');
                $filename = UploadFile('blogs',$file);
                $blog->videos = $filename;
                $blog->save();
            }
            $notification = Notification::create([
                'uuid' => (string) Uuid::uuid4(),
                'uuid_model'=> $blog->uuid,
                'model' => '\App\Models\Blog',
                'link' => '/admin/contributions/show/'.$blog->uuid,
                'is_viewed' => 0,
            ]);
            event(new NewBlogEvent($notification->uuid_model,$notification->link,$user->name,$user->email,$blog->type,$blog->title,$notification->created_at));
            $status = 200;
            $message = "تمت اضافة المساهمة بنجاح";

            return $this->sendResponse($status, $message);
      } catch (\Throwable $th) {
        return Response(['data' => 'Unauthorized'],401);
      }  
        

    }

    public function UpdateContribution(Request $request,$uuid){
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try {
            $blog = Blog::where('uuid',$uuid)->where('creche_id',$user->id)->where('type','contribution')->first();

            if(!$blog){
                $message = "هذه المساهمة غير موجود ";
                return $this->sendError($message);
            }
            $blog->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'category_id'  => $request->category,
            ]);
            
            if($request->has('images')){
                foreach($request->images as $image){
                    $blogImage = new BlogImages();
                    $filename = '';
                    $file = $image;
                    $filename = UploadFile('blogs',$file);
                    $blogImage->image = $filename;
                    $blogImage->blog_id = $blog->id;
                    $blogImage->save();
                }
            }
            if($request->has('videos')){
                $filename = '';
                $file = $request->file('videos');
                $filename = UploadFile('blogs',$file);
                $blog->videos = $filename;
                $blog->save();
            }
            $status = 200;
            $message = "تم تعديل المساهمة بنجاح";

            return $this->sendResponse($status, $message);
     } catch (\Throwable $th) {
        return Response(['data' => 'Unauthorized'],401);
    } 
        

    }
    
    public function AddHeartToContribution(Request $request){
        $user = $request->user();
        $blog = Blog::where('uuid',$request->blog_id)->where('type','contribution')->first();
        if(!$blog){
            $message = "هذه المساهمة غير موجود ";
            return $this->sendError($message);
        }
        $heart_user = HeartUser::where('creche_id',$user->id)->where('blog_id',$blog->id)->first();
        if($heart_user && $heart_user->count() > 0){
            $heart_user->delete();
            $blog->nbr_heart --;
            $blog->save();
            $message = "تمت حذف اعجابك للمقال بنجاح";
        }else{
            $heart = HeartUser::create([
                'user_id' => $user->id,
                'blog_id' => $blog->id
            ]);
            $blog->nbr_heart ++;
            $blog->save();
            $message = "تمت اضافة اعجابك للمقال بنجاح";
        }
        
        $status = 200;
        

        return $this->sendResponse($status, $message);
    }

    public function GetAllContributionsUser(Request $request){
        //$user = $request->user();
        $blogs = Blog::where('is_active',1)->where('type','contribution')->orderBy('created_at','DESC')->paginate(PAGINATE_COUNT);
        if($blogs->count() < 1){
            $message = "قائمة المساهمات فارغة";
            return $this->sendError($message);
        }
        //dd($blogs);
        $blogs = BlogResource::collection($blogs)->response()->getData();
        return Response(['data' => $blogs],200);
    }
    public function ShowContributionUser(Request $request,$uuid){
        $user = $request->user();
        $blog = Blog::where('uuid',$uuid)->where('is_active',1)->where('type','contribution')->with('images')->with('comments')->with('heart_users')->first();
        if(!$blog){
            $message = "هذه المساهمة غير موجود ";
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
