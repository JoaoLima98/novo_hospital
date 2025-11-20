<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remedio extends Model
{
    use HasFactory;
    protected $fillable = ['nome','qtd_alerta'];

    public function prescricoes()
    {
        return $this->belongsToMany(Prescricao::class, 'prescricao_remedios', 'id_remedio', 'id_prescricao')
                    ->withPivot(['quantidade', 'unidade_medida', 'intervalo', 'duracao']);
    }

    public function estoques()
    {
        return $this->hasMany(Estoque::class, 'id_remedio', 'id');
    }

    
}
