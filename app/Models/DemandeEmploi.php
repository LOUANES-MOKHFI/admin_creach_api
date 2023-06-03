<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DemandeEmploi extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'demande_emplois';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function offre(){
        return $this->belongsTo(OffreEmploi::class,'offre_id');
    }

}
