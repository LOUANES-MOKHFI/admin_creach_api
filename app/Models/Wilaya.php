<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
    use HasFactory;

    public function countrie(){
        return $this->belongsTo(Countrie::class,'country_id');
    }
    
    public function communes(){
        return $this->hasMany(Wilaya::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
    
}
