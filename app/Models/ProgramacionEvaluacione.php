<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramacionEvaluacione extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_programacion';

    public function scopeTraeDependencias($query)
    {
        return $query->join('catalogo_dependencias', 'catalogo_dependencias.id_catalogo_dependencias', '=', 'programacion_evaluaciones.id_catalogo_dependencias_fk');
    }
}
