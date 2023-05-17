<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realisation extends Model
{
    use HasFactory;
    protected $table = 'realisations';
    protected $guarded = [];

    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function images(){
        return $this->hasMany(RealisationImages::class);
    }
}
