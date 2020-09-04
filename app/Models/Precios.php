<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Precios extends Model
{
    protected $table = 'precios';

    protected $primaryKey = 'producto_id';

    protected $fillable = [
    	'producto_id',
    	'precio',
    	'por_cantidad',
    	'medida'
    ];

    public $timestamps = false;

    public $autoincrementing = false;
}
