<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class events extends Model
{
    use HasFactory;
    protected $table='events';
    protected $fillable=['date_debut','heure_debut','date_fin','heure_fin','type_event','nom_event','type_match','equipe1_id','equipe2_id','stade_id','admin_fed_id'];
    protected $guarded = ['created_at', 'updated_at'];
    
    public function reservations(){
        return $this->belongsTo(reservations::class);
    }

    public function stades(){
        return $this->belongsTo(stades::class);
    }
}
