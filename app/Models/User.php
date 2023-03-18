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
        'nom',
        'prenom',
        'telephone',
        'adresse',
        'email',
        'password',
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

    public function role_user_pivot(){
        return $this->hasMany(role_user_pivot::class);
    }

    public function reservations(){
        return $this->hasMany(reservations::class);
    }

    public function events(){
        return $this->hasMany(events::class);
    }

    public function competitions(){
        return $this->hasMany(competitions::class);
    }

    public function equipes(){
        return $this->hasMany(equipes::class);
    }

    public function stades(){
        return $this->hasMany(stades::class);
    }

    public function maintenances(){
        return $this->hasMany(maintenances::class);
    }

    public function societe_maintenances(){
        return $this->hasMany(societe_maintenances::class);
    }

    public function matchs(){
        return $this->hasMany(matchs::class);
    }

    public function historiques(){
        return $this->belongsTo(historiques::class);
    }

    public function Role(){
        return $this->belongsTo(Role::class);
    }

    
}
