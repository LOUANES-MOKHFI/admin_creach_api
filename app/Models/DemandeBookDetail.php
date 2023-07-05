<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeBookDetail extends Model
{
    use HasFactory;
    protected $table = 'demande_book_details';
    protected $guarded = [];
    public function demande(){
        return $this->belongsTo(DemandeBook::class,'demande_id');
    }
    public function book(){
        return $this->belongsTo(BookCreche::class,'book_id');
    }
}
