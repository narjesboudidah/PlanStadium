<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class events extends Model
{
    use HasFactory;
    protected $table='events';
    protected $fillable=['date_debut','date_fin','type_event','user_id','stade_id','equipe_id'];
    protected $guarded = ['created_at', 'updated_at'];
    
    public function reservations(){
        return $this->belongsTo(reservations::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function equipes(){
        return $this->belongsTo(equipes::class);
    }

    public function events(){
        return $this->belongsTo(events::class);
    }

    public function maintenances(){
        return $this->belongsTo(maintenances::class);
    }

    public function stades(){
        return $this->belongsTo(stades::class);
    }
}
