<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'crm', 'telefone','user_id'];

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
    public function triagens()
    {
        return $this->hasMany(Triagem::class, 'medico_id');
    }
}
