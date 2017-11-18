<?php

namespace App\Http\Controllers;
use App\Aluno;
use App\Livro;
use App\Genero;
use App\Editora;
use App\Autor;
use App\Multa;


use DB;
use Request;
use App\Http\Requests\AlunoRequest;
use App\Http\Requests\LivroRequest;
use Carbon\Carbon;
use Redirect;


use Session;

class MainController extends Controller
{
    public function index(){
        $tr = 0;
        $livros = Livro::all();
        $result = Request::input('Pesquisa');
        

               
        
        if(empty($result)){
            $tr = 0;
            $livros = Livro::all();
            $livros = Livro::with('autor','editora','genero')
                ->orderBy('Titulo','asc')
                ->get(); //funcionou aqui
            $trigger = 1;
            
            return view('Content.menu',[
                'livro' =>$livros,
                'trigger' =>$trigger,
                'tr' =>$tr,
                
            ]);
            
        } else {
            $tr = 1;
            $livros = Livro::where('Titulo','like','%'.$result.'%')
                ->orWhere('codLivro','like','%'.$result.'%')
                
            ->orderBy('Titulo','asc')
            ->get();  
            
            if(count($livros)>0){
                $tr = 1;
                $trigger = 1;
                return view('Content.menu',[
                'livro' =>$livros,
                'trigger' =>$trigger,
                'tr' =>$tr,
            ]);
                
            } else {
                $trigger = 0;
                $tr = 1;
                return view('Content.menu',[
                'livro' =>$livros,
                'trigger' =>$trigger,
                'tr' => $tr,
            ]);
            }
        }
        
    
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
    public function Historico(){
        
        
        return view('Content.Historico');
    }
    public function Reserva($id){
        $id = Livro::find($id);
        return view('Content.Reserva',['id'=>$id->codLivro]);
        
    }
    public function ReservarLivro(){
        $codLivro = Request::input('codLivro');
        $CPF = Request::input('CPF');
        $hoje = Carbon::today();
        $ProxSemana = $hoje->addWeek();
        
        $isBloqueado = Aluno::where('CPF',$CPF)->get()->first();
        
        
        
        
        if($isBloqueado -> StatusAluno == 2){
            Session::flash('mensagemError','Aluno bloqueado');
            return redirest()
                ->action('MainController@index');
        }
        
       DB::table('reserva')
           ->insert([
                'codLivro' => $codLivro,
                'CPF' => $CPF,
                'DataReserva' => $hoje,
                'DataLimite' => $ProxSemana,
           ]);
        DB::table('livro')
                    ->where('codLivro',$codLivro)
                    ->update(['isReserved' => 1]);
        
        Session::flash('mensagem','Livro Reservado com sucesso');
            return redirect()
                ->action('MainController@index');

    }
}
