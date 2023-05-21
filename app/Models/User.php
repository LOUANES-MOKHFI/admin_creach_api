<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'type_user',
        'domaine_vendeur',
        'store_name',
        'type_creche',
        'creche_name',
        'programme_id',
        'livraison',
        'phone',
        'facebook',
        'instagram',
        'tiktok',
        'youtube',
        'pays_id',
        'wilaya_id',
        'commune_id',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function programme(){
        return $this->belongsTo(ProgrammesCreche::class,'programme_id');
    }
    public function domaine(){
        return $this->belongsTo(DomaineVendeur::class,'domaine_vendeur');
    }
    public function typeUser(){
        return $this->belongsTo(TypesUsers::class,'type_user');
    }
}
