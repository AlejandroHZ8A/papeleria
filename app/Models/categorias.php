<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    // Tabla
    protected $table = 'categorias';

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