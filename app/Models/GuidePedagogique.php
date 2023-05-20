<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuidePedagogique extends Model
{
    use HasFactory;
    protected $table = 'guide_pedagogiques';
    protected $guarded = [];

    public function images(){
        return $this->hasMany(ImagesGuide::class,'guide_id');
    }
}
