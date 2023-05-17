<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainesConseil extends Model
{
    use HasFactory;
    protected $table = "domaines_conseils";
    protected $guarded = [];

    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }

}
