<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles, HasPermissions ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'adresse',
        'nom_equipe',
        'nom_ste',
        'email_verified_at',
        'password',
        'remember_token',
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
    protected $guarded = ['created_at', 'updated_at'];


    public function reservations(){
        return $this->hasMany(reservations::class);
    }

    public function equipes(){
        return $this->hasOne(equipes::class);
    }
    

    public function maintenances(){
        return $this->hasMany(maintenances::class);
    }

    public function societe_maintenances(){
        return $this->hasOne(societe_maintenances::class);
    }

    public function historiques(){
        return $this->belongsTo(historiques::class);
    }

    // public function Role(){
    //     return $this->belongsToMany(Role::class,'role_user_pivots');
    // }


}
