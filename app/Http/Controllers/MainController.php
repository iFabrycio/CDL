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
    public function RedirectToHT(){
        return Redirect::to('http://hacktown.petrolina.ifsertao-pe.edu.br');
    }
    public function SubMenu(){
    	return view('Content.SubMenu');
    } 
    public function ListaMenu(){
        return view('Content.ListaMenu');
    }
    public function ListaAluno(){
        $aluno = new Aluno;
        $result = Request::input('Pesquisa');
        $order = Request::input('organizar');
        if(empty($order)){
            $order = 'IdAluno';
        }
        
        if(empty($result)){ //Se não tiver nada na pesquisa este If retornará todos os dados.
        
            $aluno = Aluno::all();
            $aluno = DB::table('aluno')
                ->orderBy( $order , 'asc')
                ->get();
            
            $trigger = 1;
            
            return view('Content.ListaAluno',[
                'aluno'=> $aluno,
                'trigger'=>$trigger,]);   
        
        }else{ //Mas se tiver algo na pesquisa ele irá procurar
            
            $aluno = Aluno::where('nome','like','%'.$result.'%')
                ->orderBy( $order ,'asc')
                ->get();
           
            
            if(count($aluno)>0){ //e caso ele ache algo no banco, irá retornar
                $trigger = 1;
                
                return view('Content.ListaAluno',[
                'aluno'=> $aluno,
                'trigger'=>$trigger,
                ]);
            } else { //mas se não achar, retornará todos os dados com a mensagem que não obteve sucesso
                
                $aluno = Aluno::all();
            
                $aluno = DB::table('aluno')
                ->orderBy( $order , 'asc')
                ->get();
                $trigger = 0;
                
                return view('Content.ListaAluno',[
                'aluno'=> $aluno,
                'trigger'=>$trigger,
                ]);
                    
            }
        }
        
    }
    public function removeAluno($IdAluno){
        $aluno =Aluno::find($IdAluno);
        $aluno ->delete();  
        return redirect()
            ->action('MainController@ListaAluno');
        
    }  
    public function detailAluno($IdAluno){
        $aluno = Aluno::find($IdAluno);
        $datnasc = $aluno->datnasc;
        $datnasc = $datnasc->format('d-m-Y');
        
        return view('Content.DetailAluno',[
            'aluno' => $aluno,
            'datnasc' => $datnasc]);
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
    
    public function RemoveLivro($IdLivro){
        $livro = Livro::find($IdLivro);
        $livro->delete();
        return redirect()
            ->action('MainController@ListaLivro');
    }
    public function DetailLivro($IdLivro){
        $livro = Livro::find($IdLivro);
        
        return view('Content.DetailLivro',['livro'=>$livro]);
    }
    
}
