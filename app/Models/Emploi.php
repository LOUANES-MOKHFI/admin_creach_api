<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emploi extends Model
{
    use HasFactory;
    protected $table = 'emplois';
    protected $guarded = [];

    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }
}
