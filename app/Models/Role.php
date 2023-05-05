<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at'];
    protected $table='roles';
    protected $fillable = ['titre'];
     
    public function role_user_pivot(){
        return $this->hasMany(role_user_pivot::class);
    }
    public function permission_role(){
        return $this->hasMany(permission_role::class);
    }
}
