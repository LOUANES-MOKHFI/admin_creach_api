<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUser extends Model
{
    use HasFactory;

    protected $table = "follow_users_creche";
    protected $guarded = [];

    public function creche(){
        return $this->belongsTo(User::class,'creche_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
