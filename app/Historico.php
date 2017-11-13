<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    protected $table = 'historico';
    protected $primarykey = 'id';
    public $timestamps = false;
    
}
