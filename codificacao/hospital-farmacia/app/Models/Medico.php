<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'crm', 'especialidade', 'telefone'];

    public function prescricoes()
    {
        return $this->hasMany(Prescricao::class, 'id_medico');
    }
}
