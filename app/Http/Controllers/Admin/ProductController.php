<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::get();
        return view('admin.products.index',compact('products'));
    }

    public function show($uuid){
        $product = Product::where('uuid',$uuid)->first();
        if(!$product){
            return redirect()->back()->with('error','هذا المنتج غير موجود');
        }
        return view('admin.products.show',compact('product'));
    }
}
