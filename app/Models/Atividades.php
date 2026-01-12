<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atividades extends Model
{
    protected $table = 'atividades';

    protected $fillable = [
        'titulo',   
        'descricao',
        'data_atividade',
        'data_conclusao',
        'status',
        'prioridade',
        'responsavel',
        'solicitante',
    ];
}
