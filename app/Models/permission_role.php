<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission_role extends Model
{
    use HasFactory;
    protected $table='permission_role';
    protected $fillable=['role_id','permission_id'];
    protected $guarded = ['created_at', 'updated_at'];

    public function Permission(){
        return $this->belongsTo(Permission::class);
    }
    
    public function Role(){
        return $this->belongsTo(Role::class);
    }
}
