<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescricao extends Model
{
    use HasFactory;
    protected $table = 'prescricoes';
    protected $fillable = ['id_medico', 'id_paciente', 'data_prescricao', 
                           'observacao','prescricao_atendida'];

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'id_medico');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    public function remedios()
    {
        return $this->belongsToMany(Remedio::class, 'prescricao_remedios', 'id_prescricao', 'id_remedio');
    }
}
