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
use App\Http\Requests\SenhaRequest;
use Carbon\Carbon;
use Redirect;
use Hash;
use Auth;
use Validator;


use Session;

class MainController extends Controller
{
    
    public function __construct(){
        //Ativação do Middleware de autenticação e checagem de nivel do usuário
        $this->middleware('auth');
        $this->middleware('admincheck',['only'=>['AdminView']]);
    }
    public function index(){
        //Esta função mostra a página principal
        //dá acesso a outras páginas
        
        $tr = 0;
        $livros = Livro::all();
        
        //captura dos dados do input de pesquisa
        $result = Request::input('Pesquisa');
        

               
        
        if(empty($result)){
            //se o resultado do input de pesquisa for vazio
            //Tudo continuará normalmente
            $tr = 0;
            $livros = Livro::all();
            $livros = Livro::with('autor','editora','genero')
                ->orderBy('Titulo','asc')
                ->get(); 
            $trigger = 1;
            
            return view('Content.menu',[
                'livro' =>$livros,
                'trigger' =>$trigger,
                'tr' =>$tr,
                
            ]);
            
        } else {
            //Se não for vazio, ele retornará os resultados da pesquisa
            $tr = 1;
            $livros = Livro::where('Titulo','like','%'.$result.'%')
                ->orWhere('codLivro','like','%'.$result.'%')
                
            ->orderBy('Titulo','asc')
            ->get();  
            
            if(count($livros)>0){
                //Se houver resultado, aparecerá uma lista com os resultados
                $tr = 1;
                $trigger = 1;
                return view('Content.menu',[
                'livro' =>$livros,
                'trigger' =>$trigger,
                'tr' =>$tr,
            ]);
                
            } else {
                //Se não houver livros ele retornará uma mensagem de erro
                
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
        //Esta função redireciona para a página da Academia Hacktown
        return Redirect::to('http://hacktown.petrolina.ifsertao-pe.edu.br');
    }
    public function SubMenu(){
        //Esta função retorna o sub-menu de cadastro
    	return view('Content.SubMenu');
    } 
    public function ListaMenu(){
        //esta função retorna o sub-menu de listas de alunos/livros
        return view('Content.ListaMenu');
    }  
    public function Historico(){
        //Retorna uma view com umalista paginada do histórico
        $historico = Historico::orderBy('id','DESC')->paginate(15);
            
        
        return view('Content.Historico',['historico' => $historico]);
    }
    public function Reserva($id){
        //Esta função permite confirmar a reserva de um livro
        $id = Livro::find($id);
        return view('Content.Reserva',['id'=>$id->codLivro]);
        
    }
    public function ReservarLivro(){
        //Esta função permite reservar um livro
        $codLivro = Request::input('codLivro');
        $CPF = Request::input('CPF');
        $hoje = Carbon::today();
        $ProxSemana = $hoje->addWeek();
        //Busca o CPF do aluno e verifica se ele está bloqueado
        $isBloqueado = Aluno::where('CPF',$CPF)->get()->first();
        
        if($isBloqueado -> StatusAluno == 2){
            Session::flash('mensagemError','Aluno bloqueado');
            return redirect()
                ->action('MainController@index');
        }
        
        
        //Caso ele esteja livre, é inserido na tabela de reservas
        
       DB::table('reserva')
           ->insert([
                'codLivro' => $codLivro,
                'CPF' => $CPF,
                'DataReserva' => $hoje,
                'DataLimite' => $ProxSemana,
           ]);
        //Livro bloqueado para emprestimo, até o autor da reserva o pegar
        //A reserva durará uma semana.
        DB::table('livro')
                    ->where('codLivro',$codLivro)
                    ->update(['isReserved' => 1]);
        
        //Gravação no historico
        $aluno = Aluno::where('cpf', $CPF)->get()->first();
               $hist = new Historico;
                $hist->Atividade = "Reservou um livro, reserva válida até ".$ProxSemana;
                $hist->NomeAluno = $aluno -> nome;
                $hist ->CPF = $CPF;
                $hist ->CodLivro = $codLivro;
                $hist ->save();
        //Retorna mensagem de sucesso ao usuário
        Session::flash('mensagem','Livro Reservado com sucesso');
            return redirect()
                ->action('MainController@index');

    }
    public function AdminView(){
        //Permite ver o painel de administrador
        $users = Users::all();
        
        return view('Content.AdminPanel',[
            'users' => $users,
            ]);
    }
    public function Alterarsenha(SenhaRequest $request){
        
        $input = $request -> all();
        
        if (!Hash::check($input['senha_antiga'],Auth::user()->password)){
            Session::flash('mensagemError','Senha incorreta');
            return redirect()
                ->action('MainController@index');
        }
        $resultado = $request ->user()->fill([
            'password'=> Hash::make($request->input('senha_nova'))
        ])->save();
        
        if($resultado){
            Session::flash('mensagem','Senha alterada com sucesso');
            return redirect()
                ->action('MainController@index');
        }
    }
}
