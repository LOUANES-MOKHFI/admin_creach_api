<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OffreEmploi extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'offre_emplois';
    protected $guarded = [];

    public function emploi(){
        return $this->belongsTo(Emploi::class,'emploi_id');
    }

    public function creche(){
        return $this->belongsTo(User::class,'creche_id');
    }
    public function wilaya(){
        return $this->belongsTo(Wilaya::class,'wilaya_id');
    }
    public function commune(){
        return $this->belongsTo(Commune::class,'commune_id');
    }
}
