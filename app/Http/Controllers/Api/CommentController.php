<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogComment;
use DB;
use Validator;
use Ramsey\Uuid\Uuid;
use App\Http\Resources\CommentBlogResource;
class CommentController extends Controller
{

    
    public function GetAllComments(Request $request){
        $user = $request->user();
        $comments = BlogComment::with('reponses')->get();
        if($comments->count() < 1){
            $message = "قائمة التعليقات فارغة";
            return $this->sendError($message);
        }
        $comments = CommentBlogResource::collection($comments);
        return Response(['data' => $comments],200);
    }
    public function AddComment(Request $request){
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'blog_id' => 'required|exists:blogs,id',
            'comment' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try {
            $comment = BlogComment::create([
                'blog_id' => $request->blog_id,
                'comment' => $request->comment,
                'user_id'  => $user->id,
                'parent_id'  => $request->comment_id ? $request->comment_id : 0 
            ]);
            
            $status = 200;
            $message = "تمت اضافة التعليق بنجاح بنجاح";

            return $this->sendResponse($status, $message);
      } catch (\Throwable $th) {
        return Response(['data' => 'Unauthorized'],401);
      }  
        

    }

    public function UpdateComment(Request $request,$id){
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'comment' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try {
            $comment = BlogComment::where('id',$id)->where('user_id',$user->id)->first();

            if(!$comment){
                $message = "هذا المقال غير موجود ";
                return $this->sendError($message);
            }
            $comment->update([
                'comment' => $request->comment,
            ]);
            
            $status = 200;
            $message = "تم تعديل المقال بنجاح بنجاح";

            return $this->sendResponse($status, $message);
     } catch (\Throwable $th) {
        return Response(['data' => 'Unauthorized'],401);
    } 
        

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
