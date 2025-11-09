<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remedio extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];

    public function prescricoes()
    {
        return $this->belongsToMany(Prescricao::class, 'prescricao_remedios', 'id_remedio', 'id_prescricao');
    }
}
