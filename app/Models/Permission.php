<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable=['titre'];
    protected $guarded = ['created_at', 'updated_at'];

    public function permission_role(){
        return $this->hasMany(permission_role::class);
    }
}
