<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    use HasFactory;
    protected $table = "dossiers";
    protected $guarded = [];

    public function files(){
        return $this->hasMany(FileDossier::class);
    }

    public function childs(){
        return $this->hasMany(Self::class);
    }

    public function parent(){
        return $this->belongsTo(Self::class,'parent_id');
    }
}
