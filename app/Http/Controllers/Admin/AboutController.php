<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function edit(){
        $data = [];
        $data['settingapp'] = About::where('id',1)->first();
        return view('admin.settings.about',$data);
    }

    public function update(Request $request){
        $request->validate([
            'site_name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);
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
             if($request->has('logo')){
                $filename = '';
                $file = $request->file('logo');
                $filename = UploadFile('logo',$file);
                $about->logo = $filename;
                $about->save();
            } 
            return redirect()->back()->with(['success' => 'تمت عملية تحديث المعلومات بنجاح']);
            
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
}
