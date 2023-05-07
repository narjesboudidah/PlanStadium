<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role_user_pivot extends Model
{
    use HasFactory;
    protected $fillable = ['role_id', 'user_id','ste_id','equipe_id'];
    protected $primaryKey = ['role_id', 'user_id'];
    protected $guarded = ['created_at', 'updated_at'];
    
    public function role()
    {
        return $this->belongsTo(Role::class,"role_id");
    }
    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }

    public function equipes(){
        return $this->belongsTo(equipes::class);
    }

    public function societe_maintenances(){
        return $this->belongsTo(societe_maintenances::class);
    }
}
