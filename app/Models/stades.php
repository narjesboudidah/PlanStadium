<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stades extends Model
{
    use HasFactory;
    protected $table='stades';
    protected $fillable=['nom','ville','pays','capacite','surface','longitude','latitude','proprietaire','telephone','adresse','image','description','date_dernier_traveaux','user_id'];
    protected $guarded = ['created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reservations(){
        return $this->hasMany(reservations::class);
    }

    public function matchs(){
        return $this->hasMany(matchs::class);
    }

}
