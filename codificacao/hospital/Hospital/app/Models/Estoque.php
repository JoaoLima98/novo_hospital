<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;
    protected $fillable = ['id_remedio', 'quantidade', 'lote'];

    public function remedio()
    {
        return $this->belongsTo(Remedio::class, 'id_remedio');
    }
    
}
