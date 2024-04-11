<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function super()
    {
        return $this->rol === 'super';
    }

    public function director()
    {
        return $this->rol === 'director';
    }

    public function administrador()
    {
        return $this->rol === 'administrador';
    }

    public function enlace()
    {
        return $this->rol === 'enlace';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeUsuariosParaAdmin($query,$departamento)
    {

        return $query->whereIn('rol',['enlace','administrador'])->where('departamento', $departamento);
    }

}
