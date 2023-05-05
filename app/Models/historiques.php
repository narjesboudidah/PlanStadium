<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historiques extends Model
{
    use HasFactory;
    protected $table='historiques';
    protected $fillable=['date','user_id'];
    protected $guarded = ['created_at', 'updated_at'];

    public function User(){
        return $this->hasMany(User::class);
    }

    public function action(){
        return $this->hasMany(action::class);
    }
}
