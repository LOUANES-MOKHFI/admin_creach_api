<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealisationImages extends Model
{
    use HasFactory;
    protected $table = 'realisation_images';
    protected $guarded = [];

    public function realisation(){
        return $this->belongsTo(Realisation::class,'realisation_id');
    }

}
