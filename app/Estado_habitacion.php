<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado_habitacion extends Model
{
    public $timestamps  = false;
    protected $table    = 'estado_habitacion';
    protected $fillable = ['estado'];
}
