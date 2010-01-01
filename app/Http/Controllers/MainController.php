<?php

namespace App\Http\Controllers;
use App\Aluno;

use Request;
use App\Http\Requests\AlunoRequest;

class MainController extends Controller
{
    public function index(){
        return view('Content.menu');
    }
    public function SubMenu(){
    	return view('Content.SubMenu');
    }
    public function Aluno(){
        return view('Content.AlunoForm');
    }
    public function AlunoSubmit(AlunoRequest $request ){
       $aluno = Aluno::create($request ->all());
       $aluno->save();
        
        
            return redirect()
                ->action('MainController@index');
               
    }
    public function Livro(){
        return view('Content.LivroForm');
    }
    public function LivroSubmit(){

        $livro = Livro::create($request ->all());
        $aluno->save();
        
    }
}
