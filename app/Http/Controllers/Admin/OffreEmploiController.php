<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OffreEmploi;
class OffreEmploiController extends Controller
{
    public function index(){
        $offres = OffreEmploi::all();
        return view('admin.offre_emplois.index',compact('offres'));
    }
}
