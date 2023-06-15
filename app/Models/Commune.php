<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    public function countrie(){
        return $this->belongsTo(Countrie::class,'country_id');
    }
    public function wilaya(){
        return $this->belongsTo(Wilaya::class,'wilaya_id');
    }
}
