<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluarparaMejorar extends Model
{
    use HasFactory;

    protected $table = 'evaluar_para_mejorar';
    protected $primaryKey = 'id_evaluacion';
    protected $fillable = [
        // Otras columnas en tu tabla, pero no incluyas '_token'
        'pregunta1',
        'pregunta2',
        'pregunta3',
        'pregunta4',
        'pregunta5',
        'pregunta6',
        'pregunta7',
        'pregunta8',
        'pregunta9',
        'pregunta10',
        'pregunta11',
        'pregunta12',
        'pregunta13',
        'pregunta14'
        // ...
    ];
    public function scopeTraeEncuestas($query,$idp)
    {
        return $query->join('users', 'users.id', '=', 'evaluar_para_mejorar.id_user_fk')->where('id_programacion_fk',$idp);
    }


}