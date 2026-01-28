<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //tablas

    protected $table = 'productos';

    //llave primaria

    protected $primaryKey = 'id';

    //timestamps
   
    public $timestamps = false;
}
