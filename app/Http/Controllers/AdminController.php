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
use App\Http\Requests\UsersRequest;
use App\Http\Requests\LivroRequest;
use Carbon\Carbon;
use Redirect;
use Session;


class AdminController extends Controller
{
    
   public function __construct(){
       //Ativação do Middleware de autenticação
        $this->middleware('auth');
    } 
    public function SetupDias(){
        //esta classe permite ao usuário definir o multiplicador
        //de numero de dias de multa do usuário.
        $dias = Request::input('Dias');
        ConfigAdmin::where('id',1)
            ->update(['DiasMulta' => $dias]);
        Session::flash('mensagem','Numero de dias alterado com sucesso');
        return redirect()
            ->action('MainController@AdminView');
    }
    public function RegisterUser(UsersRequest $request){
        //Esta função permite que o administrador possa 
        //registrar usuários moderadores/administradores.
        $users = new Users;
        $users = Users::create($request ->all());
        $users ->password = bcrypt($users ->password);
        $users ->save();
        return redirect() ->action('MainController@AdminView');
    }
    public function RemoverUsers($id){
        //Esta função permite que o administrador remova usuários moderadores.
        $users = Users::find($id);
        $users ->delete();
        Session::flash('mensagem','Moderador removido com sucesso');
        return redirect() ->action('MainController@AdminView');
    }
    public function DefinirNivel($id){
        //Esta função permite que o administrador torne administrador qualquer moderador.
        $users = Users::find($id);
        //O administrador não pode se retirar de seu nivel de usuário.
        if(\Auth::id() == $users->id){
            Session::flash('mensagemError','Você não pode alterar suas próprias permissões.');
        return redirect() ->action('MainController@AdminView');
        }
        
        if($users->is_admin == 1){
        Users::where('id',$id)
            ->update(['is_admin'=>0]);
            
            Session::flash('mensagem','Funções de Administrador retiradas.');
        return redirect() ->action('MainController@AdminView');
            
        }else{
           Users::where('id',$id)
            ->update(['is_admin'=>1]);
            
            Session::flash('mensagem','Permissões no usuário alteradas.');
        return redirect() ->action('MainController@AdminView');
        }
    }
    public function Dias(){
        //Função para retornar a tela de configuração de multiplicador de dias de bloqueio.
        $config = new ConfigAdmin;
        $config = ConfigAdmin::where('id', 1)->get()->first();
        return view('Content.Dias',['config'=>$config]);
    }
}
