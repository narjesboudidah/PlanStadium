<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class competitions extends Model
{
    use HasFactory;
    protected $table='competitions';
    protected $fillable=['nom','annee','date_debut','date_fin','type_competition','categorie','organisateur','description','user_id'];
    protected $guarded = ['created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function matchs(){
        return $this->hasMany(matchs::class);
    }
}
