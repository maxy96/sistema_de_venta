<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetallesPedidos extends Model
{
    protected $table = 'detalles_pedidos';

    protected $primaryKey = ['pedido_id', 'producto_id'];

    protected $fillable = ['pedido_id', 'producto_id', 'cantidad'];

    public $timestaps = false;

    public $incrementing = false;
}
