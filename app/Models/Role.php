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
     
    public function User(){
        return $this->belongsToMany(User::class,'role_user_pivots');
    }
    public function Permission(){
        return $this->belongsToMany(Permission::class,'permission_role_pivot');
    }
}
