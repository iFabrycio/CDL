<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigAdmin extends Model
{
    protected $table = 'Configuracao';
    public $timestamps = false;
    protected $primarykey = 'id';
}
