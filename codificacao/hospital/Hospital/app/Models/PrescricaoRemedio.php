<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescricaoRemedio extends Model
{
    use HasFactory;
    protected $table = 'prescricao_remedios';
    protected $fillable = ['id_prescricao','id_remedio'];
}
