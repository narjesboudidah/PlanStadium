<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservations extends Model
{
    use HasFactory;
    protected $table='reservations';
    protected $fillable=['note','date_debut','heure_debut','date_fin','heure_fin','type_reservation','statut','admin_equipe_id','admin_fed_id'];
    protected $guarded = ['created_at', 'updated_at'];
    
    public function events(){
        return $this->hasOne(events::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

}
