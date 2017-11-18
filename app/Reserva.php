<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reserva';
    
    public $timestamps = false;
    
    protected $primarykey = 'Id';
    protected $dates = ['DataReserva'];
}
