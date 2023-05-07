<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class matchs extends Model
{
    use HasFactory;
    protected $table='matchs';
    protected $fillable=['date','heure_debut','heure_fin','type_match','competition_id','stade_id','equipe1_id','equipe2_id'];
    protected $guarded = ['created_at', 'updated_at'];

    public function equipes(){
        return $this->belongsTo(equipes::class);
    }
    
    public function stades(){
        return $this->belongsTo(stades::class);
    }

    public function competitions(){
        return $this->belongsTo(competitions::class);
    }
}
