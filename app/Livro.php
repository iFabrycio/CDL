<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $table = 'livro';
    public $timestamps = false;
    protected $primaryKey = 'IdLivro';
    
    protected $guarded = ['_token'];
    
    public function genero(){
        return $this -> belongsTo('App\Genero', 'IdGenero');
    }
    
    public function autor(){
        return $this -> belongsTo('App\Autor', 'IdAutor');
    }
    
    public function editora(){
        return $this -> belongsTo('App\Editora', 'IdEditora');
    }
}
