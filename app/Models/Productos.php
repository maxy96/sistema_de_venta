<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';

    protected $primaryKey = 'id_producto';

    protected $fillable = [
    	'tipoProducto_id',
    	'nombre',
    	'marca',
    	'imagen'
    ];

    public $timestamps = false;
}

