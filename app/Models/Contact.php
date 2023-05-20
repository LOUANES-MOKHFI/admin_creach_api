<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class Contact extends Model
{
    use HasApiTokens, HasFactory;
    protected $table = 'contacts';
    protected $fillable = ['uuid','name','subject','email','message','is_viewed'];
}
