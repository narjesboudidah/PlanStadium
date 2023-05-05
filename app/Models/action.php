<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class action extends Model
{
    use HasFactory;
    protected $table='action';
    protected $fillable=['titre','historique_id'];
    protected $guarded = ['created_at', 'updated_at'];

    public function historiques(){
        return $this->belongsTo(historiques::class);
    }
}
