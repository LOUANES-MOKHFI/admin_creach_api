<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauBook extends Model
{
    use HasFactory;
    protected $table = 'niveau_books';
    protected $guarded = [];

    public function books(){
        return $this->hasMany(BookCreche::class,'niveau_id');
    }

}
