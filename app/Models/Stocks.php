<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
     protected $table = 'stocks';

    protected $primaryKey = 'producto_id';

    protected $fillable = [
    	'producto_id',
    	'stock',
    	'medida'
    ];

    public $timestamps = false;

    public $autoincrementing = false;
}
