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
        $this->middleware('auth');
    }
    public function SetupDias(){
        $dias = Request::input('Dias');
        ConfigAdmin::where('id',1)
            ->update(['DiasMulta' => $dias]);
        Session::flash('m','Dias atualizados com sucesso');
        return redirect()
            ->action('MainController@AdminView');
    }
    public function RegisterUser(UsersRequest $request){
        $users = new Users;
        $users = Users::create($request ->all());
        $users ->password = bcrypt($users ->password);
        $users ->save();
        //Registrar usuários moderadores
        return redirect() ->action('MainController@AdminView');
    }
    public function RemoverUsers($id){
        $users = Users::find($id);
        $users ->delete();
        
        return redirect() ->action('MainController@AdminView');
    }
}
