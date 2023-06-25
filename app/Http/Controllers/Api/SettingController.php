<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DomaineVendeur;
use App\Models\ProgrammesCreche;
use App\Models\TypesUsers;
use Illuminate\Http\Request;
use App\Models\Countrie;
use App\Models\Wilaya;
use App\Models\Commune;
class SettingController extends Controller
{
    public function GetAllCountries(){
        $countries = Countrie::select('id','name')->get();
        return Response(['data' => $countries],200);
    }

    public function GetWilayasCountrie($countrie_id){
        $wialays = Wilaya::select('id','name')->where('country_id',$countrie_id)->get();
        return Response(['data' => $wialays],200);
    }

    public function GetCommunesWilaya($wilaya_id){
        $Communes = Commune::select('id','name')->where('wilaya_id',$wilaya_id)->get();
        return Response(['data' => $Communes],200);
    }

    public function GetAllDomaineVendor(){
        $domaines = DomaineVendeur::select('id','name')->get();
        return Response(['data' => $domaines],200);
    }
    public function GetAllProgrammesCreche(){
        $programmes = ProgrammesCreche::select('id','name')->get();
        return Response(['data' => $programmes],200);
    }
    public function GetAllTypeUsers(){
        $types = TypesUsers::select('id','name')->get();
        return Response(['data' => $types],200);
    }
    
}
