<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCreche extends Model
{
    use HasFactory;

    protected $table = 'book_creches';
    protected $guarded = [];

    public function niveau(){
        return $this->belongsTo(NiveauBook::class,'niveau_id');
    }
}
