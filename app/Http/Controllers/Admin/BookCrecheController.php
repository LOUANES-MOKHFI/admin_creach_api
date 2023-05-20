<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookCreche;
use App\Models\NiveauBook;
use Illuminate\Http\Request;
use DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class BookCrecheController extends Controller
{
    public function index()
    {
       $books = BookCreche::orderBy('id','DESC')->get();
       return view('admin.books_creche.index',compact('books'));
    }

    public function create()
    {   
        $data = [];
        $data['niveaux'] = NiveauBook::all();
        return view('admin.books_creche.add',$data);
    }

    public function store(Request $request, BookCreche $book)
    {
        $request->validate([
            'name' => 'required',
            'pdf_file' => 'required',
            'image' => 'required',
            'niveau' => 'required',
        ]);

        try {
           DB::beginTransaction();
           
           $book->uuid = (string) Uuid::uuid4();
           $book->slug = Str::slug($request->name);
           $book->name = $request->name;
           $book->niveau_id = $request->niveau; 
          
            if($request->has('pdf_file')){
                $filename = '';
                $file = $request->file('pdf_file');
                $filename = UploadFile('books_creche',$file);
                $book->pdf_file = $filename;
                //$book->save();
            }
            if($request->has('image')){
                $filename = '';
                $file = $request->file('image');
                $filename = UploadFile('books_creche',$file);
                $book->image = $filename;
                //$book->save();
            }
            $book->save();
            
           DB::commit();
           return redirect()->route('admin.books_creche')->with('success',"تمت عملية الاضافة بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function edit($uuid)
    {
        $data = [];
        $data['book']= BookCreche::where('uuid',$uuid)->first();
        if(!$data['book']){
           return redirect()->route('admin.books_creche')->with('error',"هذا الكتاب غير موجود في قاعدة البيانات");
        }
        $data['niveaux'] = NiveauBook::all();
        return view('admin.books_creche.edit',$data);
    }
    public function update(Request $request,$uuid)
    {
       // return $request;
        $book = BookCreche::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           
           $book->slug = Str::slug($request->name);
           $book->name = $request->name;
           $book->niveau_id = $request->niveau; 
           
            if($request->has('pdf_file')){
                $filename = '';
                $file = $request->file('pdf_file');
                $filename = UploadFile('books_creche',$file);
                $book->pdf_file = $filename;
               // $book->save();
            }
            if($request->has('image')){
                $filename = '';
                $file = $request->file('image');
                $filename = UploadFile('books_creche',$file);
                $book->image = $filename;
                //$book->save();
            }
            $book->save();
           DB::commit();
           return redirect()->route('admin.books_creche')->with('success',"تمت عملية التعديل بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }

    public function destroy($uuid)
    {
       // return $request;
        $book = BookCreche::where('uuid',$uuid)->first();
        try {
           DB::beginTransaction();
           if(!$book){
                return redirect()->route('admin.books_creche')->with('error',"هذا الكتاب غير موجود في قاعدة البيانات");
            }
           $book->delete();
           DB::commit();
           return redirect()->route('admin.books_creche')->with('success',"تمت عملية الحذف بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }

    }
}
