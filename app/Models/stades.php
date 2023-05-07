<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stades extends Model
{
    use HasFactory;
    protected $table='stades';
    protected $fillable=['nom','pays','capacite','surface','longitude','latitude','proprietaire','telephone','adresse','image','etat','description','date_dernier_travaux'];
    protected $guarded = ['created_at', 'updated_at'];

    public function events(){
        return $this->hasMany(events::class);
    }

    public function matchs(){
        return $this->hasMany(matchs::class);
    }
    public function maintenances(){
        return $this->hasMany(maintenances::class);
    }

}
