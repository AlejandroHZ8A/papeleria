<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    
    //tablas
  
    protected $table = 'administradores';

    //llave primaria

    protected $primaryKey = 'id';

    //timestamps
   
    public $timestamps = false;
}
