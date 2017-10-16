<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
   protected $table = 'aluno';
   
    public $timestamps = false;

    protected $fillable = array('nome','CPF','email','datnasc','naturalidade','turno','uf_natural','nome_mae','nome_pai','nome_resp','cpf_resp','rua','numero','bairro','complemento','cep','cidade','estado','tel_celular','tel_fixo','tipo_escola','escola_origem','serie');
    
        protected $primaryKey = 'IdAluno';

    protected $guarded = ['IdAluno'];
    protected $dates = ['datnasc'];
}
