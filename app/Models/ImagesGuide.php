<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesGuide extends Model
{
    use HasFactory;

    protected $table = 'images_guides';
    protected $guarded = [];

    public function guide(){
        return $this->belongsTo(GuidePedagogique::class,'guide_id');
    }
    
}
