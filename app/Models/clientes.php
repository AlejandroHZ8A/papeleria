<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class clientes extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'clientes';

    public $timestamps = false;

    protected $primaryKey = 'id';

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    protected $fillable = [
        'nombres',
        'apeliido_m',
        'apellido_p',
        'correo',
        'contrasena',
        'imagen',
        'estado',
        'calle',
        'num_int',
        'num_ext',
        'cp',
        'ciudad',
        'estado_cliente'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
