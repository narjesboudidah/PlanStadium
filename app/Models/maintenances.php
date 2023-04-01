<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maintenances extends Model
{
    use HasFactory;
    protected $table='maintenances';
    protected $fillable=['date_debut','date_fin','statut','description','user_id','ste_id','stade_id'];
    protected $guarded = ['created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function societe_maintenances(){
        return $this->belongsTo(societe_maintenances::class);
    }
    
    public function stades(){
        return $this->belongsTo(stades::class);
    }
}
