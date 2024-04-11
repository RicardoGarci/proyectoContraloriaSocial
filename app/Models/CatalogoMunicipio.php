<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoMunicipio extends Model
{
    use HasFactory;
    protected $table = 'catalogo_municipios';
    protected $primaryKey = 'id_municipio';


    
    public function scopeConAcreditacionComites($query, $year)
    {
        return $query
        ->leftJoin('acreditacion_comites', function ($join) use ($year) {
            $join->on('catalogo_municipios.id_municipio', '=', 'acreditacion_comites.id_catalogo_municipio_fk')
            ->where('acreditacion_comites.ejercicio', $year);
        })
        ->leftJoin('users', 'acreditacion_comites.id_user_registro_fk', '=', 'users.id');

    }

    public function scopeMunicipioYAcreditacion($query, $id)
    {
        return $query
            ->Join('acreditacion_comites', 'acreditacion_comites.id_catalogo_municipio_fk', '=', 'id_municipio')
            ->where('acreditacion_comites.id_acreditacion', $id);
    }

    public function scopeContarPorRegion($query, $ejercicio)
    {
        return $query->from('catalogo_municipios AS cm') ->leftJoin('acreditacion_comites as ac', function ($join) use ($ejercicio) {
            $join->on('cm.id_municipio', '=', 'ac.id_catalogo_municipio_fk')
                ->where('ac.estatus', '=', 4)
                ->where('ac.ejercicio', '=', $ejercicio);
        })
        ->selectRaw('cm.region, COUNT(ac.id_acreditacion) AS total')
        ->groupBy('cm.region');
    }

    public function scopeContarPorIntegrantes($query, $ejercicio)
    {
        return $query
            ->selectRaw(
                '
            cm.region,
            COUNT(DISTINCT ic.id_integrante_comite) as totalIntegrantes,
            COUNT(DISTINCT CASE WHEN ic.sexo = "Mujer" THEN ic.id_integrante_comite END) as total_mujeres,
            COUNT(DISTINCT CASE WHEN ic.sexo = "Hombre" THEN ic.id_integrante_comite END) as total_hombres,
            COUNT(DISTINCT CASE WHEN ic.lengua_indigena != "NINGUNO" THEN ic.id_integrante_comite END) as total_hablan_lengua_indigena,
            COUNT(DISTINCT CASE WHEN ic.sexo = "Mujer" AND NOT EXISTS(SELECT 1 FROM integrantes_comites AS sub_ic WHERE sub_ic.id_acreditacion_comite_fk = ac.id_acreditacion AND sub_ic.sexo = "Hombre") THEN ac.id_acreditacion END) AS municipios_solo_mujeres,
            COUNT(DISTINCT CASE WHEN ic.sexo = "Hombre" AND NOT EXISTS(SELECT 1 FROM integrantes_comites AS sub_ic WHERE sub_ic.id_acreditacion_comite_fk = ac.id_acreditacion AND sub_ic.sexo = "Mujer") THEN ac.id_acreditacion END) AS municipios_solo_hombres,
            COUNT(DISTINCT CASE WHEN ic.sexo = "Mujer" AND (NOT EXISTS(SELECT 1 FROM integrantes_comites AS sub_ic WHERE sub_ic.id_acreditacion_comite_fk = ac.id_acreditacion AND sub_ic.sexo = "Hombre") OR EXISTS(SELECT 1 FROM integrantes_comites AS sub_ic WHERE sub_ic.id_acreditacion_comite_fk = ac.id_acreditacion AND sub_ic.sexo = "Mujer")) THEN ac.id_acreditacion END) AS municipios_al_menos_una_mujer
        ',
            )
            ->from('catalogo_municipios AS cm')
            ->leftJoin('acreditacion_comites as ac', 'cm.id_municipio', '=', 'ac.id_catalogo_municipio_fk')
            ->leftJoin('integrantes_comites as ic', function ($join) use ($ejercicio) {
                $join->on('ac.id_acreditacion', '=', 'ic.id_acreditacion_comite_fk')
                    ->where('ac.estatus', '=', 4)
                    ->where('ac.ejercicio', '=', $ejercicio);
            })
            ->groupBy('cm.region');
    }

    public function scopeConteoComitesMensual ($query, $ejercicio){

        return $query->selectRaw('
        cm.region, 
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 1 THEN 1 ELSE 0 END), 0) AS eneroComites,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 2 THEN 1 ELSE 0 END), 0) AS febreroComites,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 3 THEN 1 ELSE 0 END), 0) AS marzoComites,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 4 THEN 1 ELSE 0 END), 0) AS abrilComites,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 5 THEN 1 ELSE 0 END), 0) AS mayoComites,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 6 THEN 1 ELSE 0 END), 0) AS junioComites,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 7 THEN 1 ELSE 0 END), 0) AS julioComites,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 8 THEN 1 ELSE 0 END), 0) AS agostoComites,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 9 THEN 1 ELSE 0 END), 0) AS septiembreComites,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 10 THEN 1 ELSE 0 END), 0) AS octubreComites,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 11 THEN 1 ELSE 0 END), 0) AS noviembreComites,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 12 THEN 1 ELSE 0 END), 0) AS diciembreComites,
        COUNT(DISTINCT ac.id_acreditacion) as total_comites
    ')
    ->from('catalogo_municipios as cm')
    ->leftJoin('acreditacion_comites as ac', function ($join) use ($ejercicio) {
        $join->on('cm.id_municipio', '=', 'ac.id_catalogo_municipio_fk')
            ->where('ac.estatus', '=', 4)
            ->where('ac.ejercicio', '=', $ejercicio);
    })
    ->groupBy('cm.region');

    }

    public function scopeConteoContraloresMensual ($query, $ejercicio){
        
        return $query->selectRaw('
        cm.region,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 1 THEN 1 ELSE 0 END), 0) AS eneroContralores,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 2 THEN 1 ELSE 0 END), 0) AS febreroContralores,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 3 THEN 1 ELSE 0 END), 0) AS marzoContralores,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 4 THEN 1 ELSE 0 END), 0) AS abrilContralores,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 5 THEN 1 ELSE 0 END), 0) AS mayoContralores,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 6 THEN 1 ELSE 0 END), 0) AS junioContralores,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 7 THEN 1 ELSE 0 END), 0) AS julioContralores,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 8 THEN 1 ELSE 0 END), 0) AS agostoContralores,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 9 THEN 1 ELSE 0 END), 0) AS septiembreContralores,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 10 THEN 1 ELSE 0 END), 0) AS octubreContralores,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 11 THEN 1 ELSE 0 END), 0) AS noviembreContralores,
        COALESCE(SUM(CASE WHEN MONTH(ac.fecha_validado) = 12 THEN 1 ELSE 0 END), 0) AS diciembreContralores,
        COUNT(DISTINCT ic.id_integrante_comite) AS total_contralores
    ')
    ->from('catalogo_municipios as cm')
    ->leftJoin('acreditacion_comites as ac', 'cm.id_municipio', '=', 'ac.id_catalogo_municipio_fk')
    ->leftJoin('integrantes_comites as ic', function ($join) use ($ejercicio) {
        $join->on('ac.id_acreditacion', '=', 'ic.id_acreditacion_comite_fk')
            ->where('ac.estatus', '=', 4)
            ->where('ac.ejercicio', '=', $ejercicio);
    })
    ->groupBy('cm.region');

    }


}
