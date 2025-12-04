<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'cpf', 'rg', 'telefone'];

    public function prescricoes()
    {
        return $this->hasMany(Prescricao::class, 'id_paciente');
    }

    public function triagem()
    {
        // Relacionamento 1 para 1. Pega a triagem mais recente cadastrada.
        return $this->hasOne(Triagem::class, 'paciente_id')->latestOfMany();
    }
}
