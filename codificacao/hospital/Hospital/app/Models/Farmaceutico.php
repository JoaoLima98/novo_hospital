<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farmaceutico extends Model
{
    protected $table = 'farmaceuticos';

    protected $fillable = [
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
