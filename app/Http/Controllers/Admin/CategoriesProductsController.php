<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class CategoriesProductsController extends Controller
{
    public function index()
    {
       $categories = Category::orderBy('id','DESC')->where('type','product')->get();
       return view('admin.settings.categories_products.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.settings.categories_products.add');
    }

    public function store(Request $request, Category $category)
    {
        //return $request;

        try {
           DB::beginTransaction();
           
           $category->uuid = (string) Uuid::uuid4();
           $category->slug = Str::slug($request->name);
           $category->name = $request->name;
           $category->type = 'product';
           $category->admin_id = auth('admins')->user()->id;
           $category->save();
           DB::commit();
           return redirect()->route('admin.settings.categories_products')->with('success',"تمت عملية الاضافة بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function edit($uuid)
    {
        $data = [];
        $data['category']= Category::where('uuid',$uuid)->where('type','product')->first();
        if(!$data['category']){
           return redirect()->route('admin.settings.categories_products')->with('error',"هذا القسم غير موجود في قاعدة البيانات");
        }
        return view('admin.settings.categories_products.edit',$data);
    }

    public function update(Request $request,$uuid)
    {
       // return $request;
        $category = Category::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           
           $category->slug = Str::slug($request->name);
           $category->name = $request->name;
           $category->type = 'product';
           $category->admin_id = auth('admins')->user()->id;
           $category->save();
           DB::commit();
           return redirect()->route('admin.settings.categories_products')->with('success',"تمت عملية التعديل بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function destroy($uuid)
    {
       // return $request;
        $category = Category::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           if(!$category){
                return redirect()->route('admin.settings.categories_products')->with('error',"هذا القسم غير موجود في قاعدة البيانات");
            }
           $category->delete();
           DB::commit();
           return redirect()->route('admin.settings.categories_products')->with('success',"تمت عملية الحذف بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }  
}
