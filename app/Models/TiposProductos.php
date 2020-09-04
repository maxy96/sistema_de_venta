<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiposProductos extends Model
{
    protected $table = 'tipos_productos';

    protected $primaryKey = 'id_tiposProductos';

    protected $fillable = ['descripcion'];

    public $incrementing = false;

    public $timestamps = false;
}
