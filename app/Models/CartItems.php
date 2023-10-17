<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    use HasFactory;
    protected $table = 'cart_items';
    protected $guarded = [];

    public function cart(){
        return $this->belongsTo(Order::class,'cart_id');
    }
    

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
