<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class imagenes extends Model
{
     protected $table = 'imagenes_productos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'producto_id',
        'url_imagen',
    ];
}

