<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function create(Request $request,About $about){
        try {
            $about->create([
                'site_name' => $request->site_name,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
                'facebook_page' => $request->facebook_page,
                'facebook_groupe' => $request->facebook_groupe,
                'instagram' => $request->instagram,
                'tiktok' => $request->tiktok,
                'youtube' => $request->youtube,
            ]);
            if($request->has('logo')){
                $filename = '';
                $file = $request->file('logo');
                $filename = UploadFile('logo',$file);
                $about->logo = $filename;
                $about->save();
            }
            return Response(['data' => 'Les Données sont ajouter avec success'],200);
        } catch (\Throwable $th) {
            //throw $th;
            return Response(['data' => $th->getMessage()],401);
        }
    }

    public function edit(){
        $data = [];
        $data['about'] = About::where('id',1)->first();
        return Response(['data' => $data],200);
    }

    public function update(Request $request){
        try {
            $about = About::where('id',1)->first();
            $about->update([
                'site_name' => $request->site_name,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
                'facebook_page' => $request->facebook_page,
                'facebook_groupe' => $request->facebook_groupe,
                'instagram' => $request->instagram,
                'tiktok' => $request->tiktok,
                'youtube' => $request->youtube,
            ]);
            /* if($request->has('logo')){
                $filename = '';
                $file = $request->file('logo');
                $filename = UploadFile('logo',$file);
                $about->logo = $filename;
                $about->save();
            } */
            return Response(['data' => 'Les Données sont Modifer avec success'],200);
        } catch (\Throwable $th) {
            //throw $th;
            return Response(['data' => $th->getMessage()],401);
        }
    }
}
