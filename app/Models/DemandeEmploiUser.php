<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemandeEmploiUser extends Model
{
    
    use HasFactory,SoftDeletes;

    protected $table = 'demande_emploi_users';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function emploi(){
        return $this->belongsTo(Emploi::class,'emploi_id');
    }
}
