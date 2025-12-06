<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'crm', 'especialidade', 'telefone','user_id'];

    public function prescricoes()
    {
        return $this->hasMany(Prescricao::class, 'id_medico');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function especialidades()
    {
        return $this->belongsToMany(Especialidade::class, 'medico_especialidade');
    }
}
