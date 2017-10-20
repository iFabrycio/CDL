<?php

namespace App\Http\Controllers;

use App\Livro;
use App\Genero;
use App\Editora;
use App\Autor;

use DB;
use Request;
use App\Http\Requests\AlunoRequest;
use App\Http\Requests\LivroRequest;
use Redirect;


class LivroController extends Controller
{
    public function ListaLivro(){
        
        $livros = Livro::all();
        $result = Request::input('Pesquisa');
        $order = Request::input('organizar');
        
        if(empty($order)){
            $order = 'IdLivro';
        }
        
        if(empty($result)){
            $livros = Livro::all();
            $livros = Livro::with('autor','editora','genero')
                ->orderBy($order,'asc')
                ->get(); //funcionou aqui
            $trigger = 1;
            return view('Content.ListaLivro',[
                'livro' =>$livros,
                'trigger' =>$trigger,
            ]);
            
        } else {
            
            $livros = Livro::where('Titulo','like','%'.$result.'%')
                ->orWhere('codLivro','like','%'.$result.'%')
                
            ->orderBy($order,'asc')
            ->get();  
            
            if(count($livros)>0){
                $trigger = 1;
                return view('Content.ListaLivro',[
                'livro' =>$livros,
                'trigger' =>$trigger,
            ]);
                
            } else {
                $trigger = 0;
                $livros = Livro::all();
                $livros = Livro::with('autor','editora','genero')
                    ->orderBy($order,'asc')
                    ->get();
                return view('Content.ListaLivro',[
                'livro' =>$livros,
                'trigger' =>$trigger,
            ]);
            }
        }
        

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
        $livro ->IdGenero = Request::input('IdGenero');
        $livro ->IdEditora = Request::input('IdEitora');
        $livro ->IdAutor = Request::input('IdAutor');
        $livro = Livro::create($request ->all());
        return redirect()->action('LivroController@Livro');
 
    } 
    
    public function autorCadastrar(){
        $autor = new Autor;
        $autor->nome = Request::input('nome');
        $autor->save();
        
        Session::flash('mensagem', 'Autor cadastrado com sucesso');
        
        return redirect()->action('LivroController@Livro');
    }
    public function editoraCadastrar(){
        $editora = new Editora;
        $editora ->nome = Request::input('nome');
        $editora ->save();
        
        Session::flash('mensagem','Editora cadastrada com sucesso');
        
        return redirect()->action('LivroController@Livro');

    }
    public function generoCadastrar(){
        $genero = new Genero;
        $genero ->nome = Request::input('nome');
        $genero ->save();
        
        Session::flash('mensagem','Genero cadastrado com sucesso');
        
        return redirect()->action('LivroController@Livro');
    }
    
    public function RemoveLivro($IdLivro){
        $livro = Livro::find($IdLivro);
        $livro->delete();
        return redirect()
            ->action('LivroController@ListaLivro');
    }
    public function DetailLivro($IdLivro){
        $livro = Livro::find($IdLivro);
        
        return view('Content.DetailLivro',['livro'=>$livro]);
    }
}
