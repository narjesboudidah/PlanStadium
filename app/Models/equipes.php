<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipes extends Model
{
    use HasFactory;
    protected $table='equipes';
    protected $fillable=['nom_equipe','adresse','pays','logo','site_web','type_equipe','description','admin_equipe_id'];
    protected $guarded = ['created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function matchs(){
        return $this->hasMany(matchs::class);
    }

    public function role_user_pivot(){
        return $this->hasMany(role_user_pivot::class);
    }
}
