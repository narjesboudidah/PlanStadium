<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission_role extends Model
{
    use HasFactory;
    protected $table='permission_role';
    // protected $primaryKey = ['permission_id', 'role_id'];
    protected $fillable=['role_id','permission_id'];
    protected $guarded = ['created_at', 'updated_at'];
    public $incrementing = false;
/**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('role_id', '=', $this->getAttribute('role_id'))
            ->where('permission_id', '=', $this->getAttribute('permission_id'));

        return $query;
    }
    public function Permission(){
        return $this->belongsTo(Permission::class, 'permission_id');
    }

    public function Role(){
        return $this->belongsTo(Role::class, 'role_id');
    }
}
