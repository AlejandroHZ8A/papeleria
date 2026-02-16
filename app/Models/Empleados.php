<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Empleados extends Authenticatable
{
    protected $table = 'empleados';

    protected $primaryKey = 'id';
    public $timestamps = false;

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $hidden = [
        'contrasena',
        //'remember_token',
    ];

    protected function casts(): array
    {
        return [
            //'email_verified_at' => 'datetime',
            'contrasena' => 'hashed',
        ];
    }

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    protected $fillable = [
        'rol_id',
        'nombre',
        'apellido_p',
        'apellido_m',
        'correo',
        'usuario',
        'contrasena',
        'estado',
        'imagen'
    ];

}
