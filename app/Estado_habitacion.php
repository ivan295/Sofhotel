<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado_habitacion extends Model
{
    protected $table    = 'estado_habitacion';
    protected $fillable = ['estado','ip_arduino'];
}
