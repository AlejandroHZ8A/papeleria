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

    // Relaciones (opcional - descomentar cuando tengas los modelos)
    // public function categoria()
    // {
    //     return $this->belongsTo(Categoria::class);
    // }
    
    // public function marca()
    // {
    //     return $this->belongsTo(Marca::class);
    // }
    
    // public function proveedor()
    // {
    //     return $this->belongsTo(Proveedor::class);
    // }
}
