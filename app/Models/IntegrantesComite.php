<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class IntegrantesComite extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_integrante_comite';


    public function scopeContarPorComite($query, $ejercicio, $id)
    {
        return $query
            ->join('acreditacion_comites', 'acreditacion_comites.id_acreditacion', '=', 'integrantes_comites.id_acreditacion_comite_fk')
            ->where('acreditacion_comites.ejercicio', $ejercicio)
            ->where('acreditacion_comites.id_acreditacion', $id);
    }

    public function scopeIntegranteComiteMunicipio($query, $id)
    {
        return $query
            ->join('acreditacion_comites', 'acreditacion_comites.id_acreditacion', '=', 'integrantes_comites.id_acreditacion_comite_fk')
            ->join('catalogo_municipios', 'catalogo_municipios.id_municipio', '=', 'acreditacion_comites.id_catalogo_municipio_fk')
            ->where('integrantes_comites.id_integrante_comite', $id);
    }

    public function scopeTodosIntegranteComite($query, $id)
    {
        return $query
            ->join('acreditacion_comites', 'acreditacion_comites.id_acreditacion', '=', 'integrantes_comites.id_acreditacion_comite_fk')
            ->join('catalogo_municipios', 'catalogo_municipios.id_municipio', '=', 'acreditacion_comites.id_catalogo_municipio_fk')
            ->where('acreditacion_comites.id_acreditacion', $id);
    }


     public function scopeIntegrantesTotal ($query, $ejercicio){
        
        return $query->selectRaw('COUNT(DISTINCT ic.id_integrante_comite) as totalIntegrantes')
        ->from('acreditacion_comites as ac')
        ->join('integrantes_comites as ic', 'ac.id_acreditacion', '=', 'ic.id_acreditacion_comite_fk')
        ->where('ac.ejercicio', $ejercicio);

    }

    public function scopeContralores($query, $ejercicio){
        
        return $query->selectRaw('
        SUM(CASE WHEN MONTH(ac.fecha_validado) = 1 THEN 1 ELSE 0 END) AS eneroContralores,
        SUM(CASE WHEN MONTH(ac.fecha_validado) = 2 THEN 1 ELSE 0 END) AS febreroContralores,
        SUM(CASE WHEN MONTH(ac.fecha_validado) = 3 THEN 1 ELSE 0 END) AS marzoContralores,
        SUM(CASE WHEN MONTH(ac.fecha_validado) = 4 THEN 1 ELSE 0 END) AS abrilContralores,
        SUM(CASE WHEN MONTH(ac.fecha_validado) = 5 THEN 1 ELSE 0 END) AS mayoContralores,
        SUM(CASE WHEN MONTH(ac.fecha_validado) = 6 THEN 1 ELSE 0 END) AS junioContralores,
        SUM(CASE WHEN MONTH(ac.fecha_validado) = 7 THEN 1 ELSE 0 END) AS julioContralores,
        SUM(CASE WHEN MONTH(ac.fecha_validado) = 8 THEN 1 ELSE 0 END) AS agostoContralores,
        SUM(CASE WHEN MONTH(ac.fecha_validado) = 9 THEN 1 ELSE 0 END) AS septiembreContralores,
        SUM(CASE WHEN MONTH(ac.fecha_validado) = 10 THEN 1 ELSE 0 END) AS octubreContralores,
        SUM(CASE WHEN MONTH(ac.fecha_validado) = 11 THEN 1 ELSE 0 END) AS noviembreContralores,
        SUM(CASE WHEN MONTH(ac.fecha_validado) = 12 THEN 1 ELSE 0 END) AS diciembreContralores
    ')
    ->from('integrantes_comites AS ic')
    ->join('acreditacion_comites as ac', 'ac.id_acreditacion', '=', 'ic.id_acreditacion_comite_fk')
    ->join('catalogo_municipios as cm', 'cm.id_municipio', '=', 'ac.id_catalogo_municipio_fk')
    ->where('ac.estatus', 4)
    ->where('ac.ejercicio', $ejercicio);

    }

    public function scopeModalIntegrantes($query, $ejercicio, $flag){
        
        return $query->selectRaw('
        cm.region,
        cm.distrito,
        cm.nombre,
        ac.folio_comite,
        ic.nombre_completo,
        ic.telefono,
        ic.celular,
        ic.sexo,
        ic.lengua_indigena,
        ic.correo,
        ac.datos_municipio
    ')
    ->from('integrantes_comites AS ic')
    ->join('acreditacion_comites as ac', 'ac.id_acreditacion', '=', 'ic.id_acreditacion_comite_fk')
    ->join('catalogo_municipios as cm', 'cm.id_municipio', '=', 'ac.id_catalogo_municipio_fk')
    ->where('ac.estatus', 4)
    ->where('ac.ejercicio', $ejercicio)
    ->where('cm.region', $flag);
        
    return $query;
        

    }

    public function scopeModalMunicipiosMujer($query, $ejercicio, $flag){
        
        return $query->selectRaw('
        cm.region,
        ac.folio_comite,
        cm.nombre,
        COUNT(DISTINCT CASE WHEN ic.sexo = "Mujer" AND NOT EXISTS (SELECT 1 FROM integrantes_comites AS sub_ic WHERE sub_ic.id_acreditacion_comite_fk = ac.id_acreditacion AND sub_ic.sexo = "Hombre") THEN ac.id_acreditacion END) AS municipios_solo_mujeres
    ')
    ->from('integrantes_comites AS ic')
    ->join('acreditacion_comites as ac', 'ac.id_acreditacion', '=', 'ic.id_acreditacion_comite_fk')
    ->join('catalogo_municipios as cm', 'cm.id_municipio', '=', 'ac.id_catalogo_municipio_fk')
    ->where('ac.estatus', 4)
    ->where('ac.ejercicio', $ejercicio)
    ->where('cm.region', $flag)
    ->groupBy('cm.region', 'ac.folio_comite', 'cm.nombre')
    ->having('municipios_solo_mujeres', '=', 1);
        
    return $query;
        

    }

    public function scopeModalMunicipiosHombre($query, $ejercicio, $flag){
        
        return $query->selectRaw('
        cm.region,
        ac.folio_comite,
        cm.nombre,
        COUNT(DISTINCT CASE WHEN ic.sexo = "Hombre" AND NOT EXISTS(SELECT 1 FROM integrantes_comites AS sub_ic WHERE sub_ic.id_acreditacion_comite_fk = ac.id_acreditacion AND sub_ic.sexo = "Mujer") THEN ac.id_acreditacion END) AS municipios_solo_hombres
    ')
    ->from('integrantes_comites AS ic')
    ->join('acreditacion_comites as ac', 'ac.id_acreditacion', '=', 'ic.id_acreditacion_comite_fk')
    ->join('catalogo_municipios as cm', 'cm.id_municipio', '=', 'ac.id_catalogo_municipio_fk')
    ->where('ac.estatus', 4)
    ->where('ac.ejercicio', $ejercicio)
    ->where('cm.region', $flag)
    ->groupBy('cm.region', 'ac.folio_comite', 'cm.nombre')
    ->having('municipios_solo_hombres', '=', 1);
        
    return $query;
        

    }

    public function scopeModalMunicipioAlMenosMujer($query, $ejercicio, $flag){
        
        return $query->selectRaw('
        cm.region,
        ac.folio_comite,
        cm.nombre,
        COUNT(DISTINCT CASE WHEN ic.sexo = "Mujer" AND (NOT EXISTS(SELECT 1 FROM integrantes_comites AS sub_ic WHERE sub_ic.id_acreditacion_comite_fk = ac.id_acreditacion AND sub_ic.sexo = "Hombre") OR EXISTS(SELECT 1 FROM integrantes_comites AS sub_ic WHERE sub_ic.id_acreditacion_comite_fk = ac.id_acreditacion AND sub_ic.sexo = "Mujer")) THEN ac.id_acreditacion END) AS municipios_al_menos_una_mujer
        ')
    ->from('integrantes_comites AS ic')
    ->join('acreditacion_comites as ac', 'ac.id_acreditacion', '=', 'ic.id_acreditacion_comite_fk')
    ->join('catalogo_municipios as cm', 'cm.id_municipio', '=', 'ac.id_catalogo_municipio_fk')
    ->where('ac.estatus', 4)
    ->where('ac.ejercicio', $ejercicio)
    ->where('cm.region', $flag)
    ->groupBy('cm.region', 'ac.folio_comite', 'cm.nombre')
    ->having('municipios_al_menos_una_mujer', '=', 1);
        
    return $query;
        

    }


}
