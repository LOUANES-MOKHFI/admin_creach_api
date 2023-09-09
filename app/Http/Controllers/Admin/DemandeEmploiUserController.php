<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DemandeEmploiUser;
use DB;
class DemandeEmploiUserController extends Controller
{
    public function index(){
        $demandes = DemandeEmploiUser::all();
        return view('admin.demandes_emplois_user.index',compact('demandes'));
    }

    public function destroy($id){
        $demande = DemandeEmploiUser::where('id',$id)->first();
        try {
           DB::beginTransaction();
           if(!$demande){
                return redirect()->route('admin.demandes_emplois_user')->with('error',"هذا الطلب غير موجود في قاعدة البيانات");
            }
           $demande->delete();
           DB::commit();
           return redirect()->route('admin.demandes_emplois_user')->with('success',"تمت عملية الحذف بنجاح");

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
            
        }
    }
}
