<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'products';
    protected $guarded = [];
    public function images(){
        return $this->hasMany(ProductImages::class);
    }
    public function categories(){
        return $this->belongsToMany(Category::class,'category_products');
    }

    public function vendor(){
        return $this->belongsTo(User::class,'vendor_id');
    }
}
