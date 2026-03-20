<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    // Tabla
    protected $table = 'marcas';

    // Llave primaria
    protected $primaryKey = 'id';

    // Timestamps
    public $timestamps = false;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'id',
        'nombre',
        'imagen'
    ];


}