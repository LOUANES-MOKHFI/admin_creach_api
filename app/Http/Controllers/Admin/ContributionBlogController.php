<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogComment;

class ContributionBlogController extends Controller
{
    public function index(){
        $blogs = Blog::where('type','contribution')->get();
        return view('admin.contributions.index',compact('blogs'));
    }

    public function show($uuid){
        $blog = Blog::where('uuid',$uuid)->where('type','contribution')->first();
        if(!$blog){
            return redirect()->back()->with('error','هذا المقال غير موجود');
        }

        return view('admin.contributions.show',compact('blog'));
    }

    public function deleteComment($id){
        $comment = BlogComment::where('id',$id)->first();
        if(!$comment){
            return redirect()->back()->with('error','هذا التعليق غير موجود');
        }
        $comment->delete();
        return redirect()->back()->with('success','تم حذف التعليق بنجاح');

    }

    public function ChangeStatus($uuid){
        $blog = Blog::where('uuid',$uuid)->where('type','contribution')->first();
        if(!$blog){
            return redirect()->back()->with('error','هذا المقال غير موجود');
        }
        $blog->is_active = $blog->is_active == 0 ? 1 : 0; 
        $blog->save();
        return redirect()->back()->with('error','تم تغير حالة المقال  بنجاح');

    }
}
