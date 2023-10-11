<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\BookCreche;
use App\Models\DemandeBook;
use App\Models\DemandeBookDetail;
use App\Models\NiveauBook;
use Illuminate\Http\Request;
use App\Models\GuidePedagogique;
use App\Models\ImagesGuide;
use App\Http\Resources\GuidePedagogiqueResource;
use App\Http\Resources\NiveauBookResource;
use Ramsey\Uuid\Uuid;
use App\Models\Notification;

use Validator;
class ProgrammeCrecheController extends Controller
{
    public function ShowGuidePedagogique(){
        $guide = GuidePedagogique::where('id',1)->first();

        if(!$guide){
            $message = "لا يوجد أي دليل بيداغوجي";
            return $this->sendError($message);
        }
        $guide = new GuidePedagogiqueResource($guide);
        return Response(['data' => $guide],200);
    }

    public function ShowProgramme(){
       
        $niveaux = NiveauBook::select('id','uuid','name','slug','age')->get();
        if(!$niveaux){
            $message = "قائمة الكتب فارغة";
            return $this->sendError($message);
        }
        
        
        
        // $niveaux = NiveauBookResource::collection($niveaux);
        return Response(['data' => $niveaux],200);
    }

    public function getBookById($id){
        $books = BookCreche::where('niveau_id',$id)->get();
        //$data = [];
        foreach($books as $book){
            $data[] = [
                'id' => $book->id,
                'uuid' => $book->uuid,
                'name' => $book->name,
                'slug' => $book->slug,
                'niveau_id' => $book->niveau_id,
                'image' => 'public/files/books_creche/'.$book->image,
                'pdf_file' => 'public/files/books_creche/'.$book->pdf_file,
            ];
        }
        
        
        // $niveaux = NiveauBookResource::collection($niveaux);
        return Response(['data' => $data],200);
    }

    public function getAllBook(){
        $books = BookCreche::all();
        
        if(!$books){
            $message = "قائمة الكتب فارغة";
            return $this->sendError($message);
        }

        //$books = BookResource::collection($books)->response()->getData();
        return Response(['data' => $books],200);
    }
    public function DemandeBook(Request $request){
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'creche_name' => 'required',
            'wilaya_id' => 'required',
            'commune_id' => 'required',
            'gerant_name' => 'required',
            'programme_id' => 'required',
            'telephone' => 'required',
        ]);
        

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        try {
            
                $demande = DemandeBook::create([
                    "uuid" => (string) Uuid::uuid4(),
                    "creche_name" => $request->creche_name,
                    "user_id" => $user->id,
                    "wilaya_id" => $request->wilaya_id,
                    "commune_id" => $request->commune_id,
                    "gerant_name" => $request->gerant_name,
                    "annee" => $request->annee,
                    "programme_id" => $request->programme_id,
                    "telephone" => $request->telephone,
                    'other_programme' => $request->programme_id == 13 ? $request->other : '',
                ]);
                if($request->qty >1){
                    foreach($request->books as $detail){
                        $detailstore = DemandeBookDetail::create([
                            "demande_id" => $demande->id,
                            "user_id" => $user->id,
                            "niveau" => $detail['niveau'],
                            "book_id" => $detail['id'],
                            "qty" => $detail['qty'],
                        ]);
                    }
                }
            
            

            $notification = Notification::create([
                'uuid' => (string) Uuid::uuid4(),
                'uuid_model'=> $demande->uuid,
                'model' => '\App\Models\DemandeBook',
                'link' => '/admin/demande_books/show/'.$demande->uuid,
                'is_viewed' => 0,
            ]);

            $status = 200;
            $message = "تمت اضافة الطلبية بنجاح";

            return $this->sendResponse($status, $message);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage());
        }
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
