<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $table = 'livro';
    
    public function genero(){
        return $this -> belongsTo('app\Genero', 'IdGenero');
    }
    
    public function autor(){
        return $this -> belongsTo('app\Autor', 'IdAutor');
    }
    
    public function editora(){
        return $this -> belongsTo('app\Editora', 'IdEditora');
    }
}
