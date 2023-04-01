<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservations extends Model
{
    use HasFactory;
    protected $table='reservations';
    protected $fillable=['date_debut','date_fin','type_reservation','statut','description','user_id','equipe_id','stade_id'];
    protected $guarded = ['created_at', 'updated_at'];
    
    public function events(){
        return $this->hasOne(events::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function stades(){
        return $this->belongsTo(stades::class);
    }
}
