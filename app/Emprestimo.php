<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    protected $table = 'Emprestimo';
    
    public $timestamps = false;
    
    protected $guarded = ['_token'];
    
    public function livro(){
        return $this -> belongsTo('App/Livro','IdLivro');

    }
    public function aluno(){
        return $this -> belongsTo('App/Lluno','IdAluno');
    }
    
}
