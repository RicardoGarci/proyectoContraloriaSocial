<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentariosBuzone extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_comentario_buzon';

    public function scopeBuzonAbierto($query, $id)
    {
        return $query
            ->leftJoin('users', 'abierto_por', '=', 'users.id')
            ->where('comentarios_buzones.id_buzon_fk', $id);
    }

    public function scopeContarComentariosPorDependencia($query)
    {
        return $query
            ->rightJoin('buzones', 'comentarios_buzones.id_buzon_fk', '=', 'buzones.id_buzon')
            ->rightJoin('catalogo_dependencias', 'buzones.id_catalogo_buzon_fk', '=', 'catalogo_dependencias.id_catalogo_dependencias')
            ->select('catalogo_dependencias.id_catalogo_dependencias', 'catalogo_dependencias.nombre_dependecia_programa', 'catalogo_dependencias.tipo')
            ->selectRaw('COUNT(DISTINCT comentarios_buzones.id_comentario_buzon) as total_comentarios')
            ->selectRaw('COUNT(DISTINCT buzones.numero_buzon) as total_buzones')
            ->groupBy('catalogo_dependencias.nombre_dependecia_programa', 'catalogo_dependencias.tipo', 'catalogo_dependencias.id_catalogo_dependencias');
    }

    public function scopeContarPorTipoComentario($query)
    {
        return $query->select('tipo_comentario', \DB::raw('count(*) as total'))
        ->groupBy('tipo_comentario');
    }
}
