<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medidas extends Model
{
    protected $table = 'medidas';

    protected $keyType = 'string';

    protected $primaryKey = 'medida';

    protected $fillable = ['medida', 'descripcion'];

    public $timestamps = false;

    public $incrementing = false;

}
