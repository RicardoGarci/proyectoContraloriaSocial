<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificacionFisica extends Model
{
    use HasFactory;
    
    protected $table = 'verificacion_fisica';
    protected $primaryKey = 'idVerificacionFisica';
    protected $fillable = [
        // Otras columnas en tu tabla, pero no incluyas '_token'
        'info1',
        'info2',
        'info3',
        'info4',
        'info5',
        'info6',
        'info7',
        'info8',
        'info9',
        'info10',
        'info11',
        'info12',
        'info13',
        'info14',
        'info15',
        'info16',
        'meca1',
        'access1',
        'access2',
        'access3',
        'access4',
        'access5',
        'infra1',
        'infra2'
        // ...
    ];

    public function scopeTraeEncuestas($query,$idp)
    {
        return $query->join('users', 'users.id', '=', 'verificacion_fisica.id_user_fk')->where('id_programacion_fk',$idp);
    }

}
