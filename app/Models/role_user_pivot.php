<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role_user_pivot extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'role_id'];
    // protected $primaryKey = ['user_id','role_id'];
    protected $guarded = ['created_at', 'updated_at'];

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
            ->where('user_id', '=', $this->getAttribute('user_id'));

        return $query;
    }
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
