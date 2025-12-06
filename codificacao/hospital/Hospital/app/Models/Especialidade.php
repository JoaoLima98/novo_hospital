<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    protected $fillable = [
        'nome'
    ];

    public function medicos()
    {
        return $this->belongsToMany(Medico::class, 'medico_especialidade');
    }

    public function triagens()
    {
        return $this->belongsToMany(Triagem::class, 'triagem_especialidade');
    }

}
