<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class societe_maintenances extends Model
{
    use HasFactory;
    protected $table='societe_maintenances';
    protected $fillable=['nom','adresse','tel','logo','email','description','admin_ste_id'];
    protected $guarded = ['created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function role_user_pivot(){
        return $this->hasMany(role_user_pivot::class);
    }
}
