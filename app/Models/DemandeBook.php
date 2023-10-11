<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeBook extends Model
{
    use HasFactory;
    protected $table = 'demande_books';
    protected $guarded = [];
    public function detail(){
        return $this->hasMany(DemandeBookDetail::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function wilaya(){
        return $this->belongsTo(Wilaya::class,'wilaya_id');
    }
    public function commune(){
        return $this->belongsTo(Commune::class,'commune_id');
    }
    public function programme(){
        return $this->belongsTo(ProgrammesCreche::class,'programme_id');
    }
    
}
