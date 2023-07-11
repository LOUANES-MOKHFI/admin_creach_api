<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\Notification;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::where('type','blog')->get();
        return view('admin.blogs.index',compact('blogs'));
    }

    public function show($uuid){
        $blog = Blog::where('uuid',$uuid)->where('type','blog')->first();
        if(!$blog){
            return redirect()->back()->with('error','هذا المقال غير موجود');
        }
        $notification = Notification::where('uuid_model',$blog->uuid)->first();
        if($notification){
            $notification->is_viewed = 1;
            $notification->save();
        }

        return view('admin.blogs.show',compact('blog'));
    }

    public function deleteComment($id){
        $comment = BlogComment::where('id',$id)->first();
        if(!$comment){
            return redirect()->back()->with('error','هذا التعليق غير موجود');
        }
        $comment->delete();
        return redirect()->back()->with('success','تم حذف التعليق بنجاح');

    }
}
