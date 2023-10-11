<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\FileDossier;
use App\Http\Resources\DossierResource;

class DossierController extends Controller
{
    public function index()
    {
       $dossiers = Dossier::orderBy('id','DESC')->get();
       foreach($dossiers as $dossier){
        //dd($this->GetChilds($dossier->id));
        $data[] = [
            'id' => $dossier->id,
            'name' => $dossier->name,
            'parent_id' => $dossier->parent_id,
            'type' =>  'folder',
            'childs' => $this->GetChilds($dossier->id),
        ];
       }
       if($dossiers->count() < 1){
           $message = "قائمة فارغة";
           return $this->sendError($message);
       }
       $dossiers = DossierResource::collection($dossiers);
       return Response(['data' => $data],200);
    }

    public function GetChilds($dossier_id){
        $dossiers = Dossier::where('parent_id',$dossier_id)->get();
        //dd($dossiers);
        $data = [];
        
        foreach($dossiers as $dossier){
            $data[] = [
                'id' => $dossier->id,
                'parent_id' => $dossier->parent_id,
                'name' => $dossier->name,
                'slug' => $dossier->slug,
                'type' =>  'folder',
                
                //'dossier' => $dossier_id,
            ];
        }
        return $data;

    }

    public function getFiles($dossier_id){
        $files = FileDossier::where('dossier_id',$dossier_id)->get();
        $dossier = Dossier::where('id',$dossier_id)->first();
        $data = [];
        foreach($files as $file){
            $type = explode('.',$file->name)[1];
            $data[] = [
                'id' => $file->id,
                //'dossier_id' => $file->dossier_id,
                //'parent_id'  => $dossier->parent_id,
                'name' => 'public/files/dossiers/'.$file->name,
                'path' => 'public/files/dossiers/'.$file->name,
                'type' =>  $type,
            ];
            
        }
        return $data;
    }

    public function show($id)
    {
       $dossier = Dossier::where('id',$id)->first();

       $data = [];
       $data['id'] = $dossier->id;
       $data['name'] = $dossier->name;
       $data['parent_id'] = $dossier->parent_id;
       $childs = [];
        if(count($this->GetChilds($id))>0){
            $data['childs'] = $this->GetChilds($dossier->id);
        }else{
            $data['childs'] = [];
        }
        if(count($this->getFiles($id))>0){
            $data['childs'] = $this->getFiles($id);
        }
       
       //$dossiers = new DossierResource($dossier);
       return Response($data,200);
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
