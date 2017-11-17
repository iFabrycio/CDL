<?php

namespace App\Http\Controllers;
use App\Aluno;
use App\Livro;
use App\Genero;
use App\Editora;
use App\Autor;
use App\Multa;
use App\Historico;
use App\Users;
use App\ConfigAdmin;

use DB;
use Request;
use App\Http\Requests\AlunoRequest;
use App\Http\Requests\LivroRequest;
use Carbon\Carbon;
use Redirect;


use Session;

class MainController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admincheck',['only'=>['AdminView']]);
    }
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
        
        $historico = Historico::orderBy('id','DESC')->paginate(15);
            
        
        return view('Content.Historico',['historico' => $historico]);
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
            return redirect()
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
        
        $aluno = Aluno::where('cpf', $CPF)->get()->first();
               $hist = new Historico;
                $hist->Atividade = "Reservou um livro, reserva válida até ".$ProxSemana;
                $hist->NomeAluno = $aluno -> nome;
                $hist ->CPF = $CPF;
                $hist ->CodLivro = $codLivro;
                $hist ->save();
        
        Session::flash('mensagem','Livro Reservado com sucesso');
            return redirect()
                ->action('MainController@index');

    }
    public function AdminView(){
        $users = Users::all();
        
        return view('Content.AdminPanel',[
            'users' => $users,
            ]);
    }
}
