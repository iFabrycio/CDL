<?php

namespace App\Http\Controllers;
use App\Aluno;
use App\Livro;
use App\Genero;
use App\Editora;
use App\Autor;


use DB;
use Request;
use App\Http\Requests\AlunoRequest;
use App\Http\Requests\LivroRequest;
use Redirect;

use Session;

class MainController extends Controller
{
    public function index(){
    
        return view('Content.menu');
    }
    
    public function ListaMenu(){
        return view('Content.ListaMenu');
    }
    public function ListaAluno(){
        $aluno = Aluno::all();
        return view('Content.ListaAluno',[
            'aluno'=> $aluno
        ]);   
    }
    public function removeAluno($IdAluno){
        $aluno =Aluno::find($IdAluno);
        $aluno ->delete();  
        return redirect()
            ->action('MainController@ListaAluno');
        
    }
    
    public function RedirectToHT(){
        return Redirect::to('http://hacktown.petrolina.ifsertao-pe.edu.br');
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
        $autores = Autor::all();
        $generos = Genero::all();
        $editora = Editora::all();
        
        return view('Content.LivroForm', [
            'autores' => $autores,
            'editora' => $editora,
            'genero' => $generos,
            
        ]);
    }
    public function LivroSubmit(LivroRequest $request ){


        $livro = new Livro;
        $livro ->IdGenero = Request::input('genero');
        $livro ->IdEditora = Request::input('editora');
        $livro ->IdAutor = Request::input('autor');
        $livro = Livro::create($request ->all());
        return redirect()->action('MainController@Livro');
 
    }
    
    public function autorCadastrar(){
        $autor = new Autor;
        $autor->nome = Request::input('nome');
        $autor->save();
        
        Session::flash('mensagem', 'Autor cadastrado com sucesso');
        
        return redirect()->action('MainController@Livro');
    }
    public function editoraCadastrar(){
        $editora = new Editora;
        $editora ->nome = Request::input('nome');
        $editora ->save();
        
        Session::flash('mensagem','Editora cadastrada com sucesso');
        
        return redirect()->action('MainController@Livro');

    }
    public function generoCadastrar(){
        $genero = new Genero;
        $genero ->nome = Request::input('nome');
        $genero ->save();
        
        Session::flash('mensagem','Genero cadastrado com sucesso');
        
        return redirect()->action('MainController@Livro');
    }
}
