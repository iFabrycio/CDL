<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
   protected $table = 'users';
    public $timestamps = false;
    protected $primarykey = 'id';
    protected $fillable = ['name','email','password','CPF'];
    
}
