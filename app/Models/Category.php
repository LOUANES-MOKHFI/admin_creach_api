<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $guarded = [];

    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function faqs(){
        return $this->hasMany(Faq::class)->where('type','faq');
    }
}
