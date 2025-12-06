<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Triagem extends Model
{
    protected $table = 'triagens';


    protected $fillable = [
        'paciente_id', 
        'enfermeiro_id', 
        'pressao_sistolica', 
        'pressao_diastolica',
        'temperatura', 
        'frequencia_cardiaca', 
        'spo2', 
        'glicemia',
        'manchester_classificacao', 
        'glasgow', 
        'escore_dor',
        'peso', 
        'altura_cm', 
        'queixa_principal', 
        'alergias', 
        'medicacao_uso',
        'sintomas_gripais', 
        'tipo_chegada', 
        'acidente_trabalho',
        'acidente_veiculo', 
        'tipo_envolvimento_veiculo',
        'atendido'
    ];

    protected $casts = [
        'sintomas_gripais' => 'array',
        'acidente_trabalho' => 'boolean',
        'acidente_veiculo' => 'boolean',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
    public function enfermeiro()
    {
        return $this->belongsTo(Enfermeiro::class, 'enfermeiro_id');
    }
    public function especialidades()
    {
        return $this->belongsToMany(Especialidade::class, 'triagem_especialidade');
    }
}
