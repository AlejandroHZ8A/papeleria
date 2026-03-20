<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    // Desactivamos timestamps si no los tienes en la tabla
    public $timestamps = false;

    protected $fillable = [
        'cliente_id',
        'fecha',
        'descuento',
        'total',
        'estado'
    ];

    // Relación con el Cliente
    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'cliente_id');
    }

    // Relación con los Productos (Muchos a Muchos)
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'productos_pedidos', 'pedido_id', 'producto_id')
                    ->withPivot('cantidad');
    }
}
