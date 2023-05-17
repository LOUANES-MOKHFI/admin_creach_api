<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NiveauBook;
use Illuminate\Http\Request;
use DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
class NiveauBooksController extends Controller
{
    public function index()
    {
       $niveaux = NiveauBook::orderBy('id','DESC')->get();
       return view('admin.niveau_books.index',compact('niveaux'));
    }

    public function create()
    {
        return view('admin.niveau_books.add');
    }

    public function store(Request $request, NiveauBook $niveau)
    {
        //return $request;

        try {
           DB::beginTransaction();
           
           $niveau->uuid = (string) Uuid::uuid4();
           $niveau->slug = Str::slug($request->name);
           $niveau->name = $request->name;
           $niveau->age = $request->age;
           $niveau->save();
           DB::commit();
           return redirect()->route('admin.niveau_books')->with('success',"تمت عملية الاضافة بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function edit($uuid)
    {
        $data = [];
        $data['niveau']= NiveauBook::where('uuid',$uuid)->where('type','blog')->first();
        if(!$data['niveau']){
           return redirect()->route('admin.niveau_books')->with('error',"هذا المستوى غير موجود في قاعدة البيانات");
        }
        return view('admin.niveau_books.edit',$data);
    }

    public function update(Request $request,$uuid)
    {
       // return $request;
        $niveau = NiveauBook::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           
           $niveau->slug = Str::slug($request->name);
           $niveau->name = $request->name;
           $niveau->age = $request->age;
           $niveau->save();
           DB::commit();
           return redirect()->route('admin.niveau_books')->with('success',"تمت عملية التعديل بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function destroy($uuid)
    {
       // return $request;
        $niveau = NiveauBook::where('uuid',$uuid)->first();
        if(count($niveau->books)>0){
            return redirect()->route('admin.niveau_books')->with('error',"هذا المستوى يحتوي على كتب, لا يمكنك حذفه");
        }
        try {
           DB::beginTransaction();
           if(!$niveau){
                return redirect()->route('admin.niveau_books')->with('error',"هذا المستوى غير موجود في قاعدة البيانات");
            }
           $niveau->delete();
           DB::commit();
           return redirect()->route('admin.niveau_books')->with('success',"تمت عملية الحذف بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }
}
