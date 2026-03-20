<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    // Tabla
    protected $table = 'productos';

    // Llave primaria
    protected $primaryKey = 'id';

    // Timestamps
    public $timestamps = false;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'existencia',
        'categoria_id',
        'marca_id',
        'proveedor_id',
        'departamento_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(categorias::class);
    }

    public function marca()
    {
        return $this->belongsTo(Marcas::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamentos::class);
    }


}
