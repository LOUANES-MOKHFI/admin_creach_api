<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';
    protected $guarded = [];

    public function creche(){
        return $this->belongsTo(User::class,'creche_id');
    }

    public function images(){
        return $this->hasMany(BlogImages::class);
    }
    public function comments(){
        return $this->hasMany(BlogComment::class);
    }
}
