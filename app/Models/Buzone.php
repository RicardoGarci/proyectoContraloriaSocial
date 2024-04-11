<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Buzone extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_buzon';

    public function scopeBuzonTipo($query)
    {
        return $query->join('catalogo_dependencias', 'catalogo_dependencias.id_catalogo_dependencias', '=', 'buzones.id_catalogo_buzon_fk');
    }

    public function scopeContarPorRegion($query)
    {
        return $query->select('region', \DB::raw('count(*) as total'))
        ->groupBy('region');
    }

    public function scopeBuzonDependencia($query,$id)
    {
        return $query->join('catalogo_dependencias', 'catalogo_dependencias.id_catalogo_dependencias', '=', 'buzones.id_catalogo_buzon_fk')
        ->where('buzones.id_buzon', $id);
    }

    public function scopeTodoBuzonDependencia($query)
    {
        return $query->select('catalogo_dependencias.nombre_dependecia_programa', DB::raw('COUNT(buzones.id_buzon) as total_buzones'))
            ->join('catalogo_dependencias', 'catalogo_dependencias.id_catalogo_dependencias', '=', 'buzones.id_catalogo_buzon_fk')
            ->groupBy('catalogo_dependencias.nombre_dependecia_programa');
    }


    

}
