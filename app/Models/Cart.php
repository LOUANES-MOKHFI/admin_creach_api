<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function vendor(){
        return $this->belongsTo(User::class,'vendor_id');
    }

    public function details(){
        return $this->hasMany(CartItems::class);
    }
}
