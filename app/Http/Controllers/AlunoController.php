<?php

namespace App\Http\Controllers;

use App\Aluno;


use DB;
use Request;
use App\Http\Requests\AlunoRequest;
use App\Http\Requests\LivroRequest;
use Redirect;
use Session;


class AlunoController extends Controller
{
    
    public function __construct(){
        //Ativação do Middleware de autenticação
        $this->middleware('auth');
        $this->middleware('admincheck',['only' =>['removeAluno']]);
    }
   public function ListaAluno(){
       //esta função permite a pesquisa de um determinado aluno
        $aluno = new Aluno;
        $result = Request::input('Pesquisa');
        $order = Request::input('organizar');
       
        if(empty($order)){
            //Ordem padrão
            $order = 'IdAluno';
        }
       
        
        if(empty($result)){ 
            //Se não tiver nada na pesquisa este If retornará todos os dados.
        

            $aluno = DB::table('aluno')
                ->orderBy( $order , 'asc')
                ->get();
            
            $trigger = 1;
            
            return view('Content.ListaAluno',[
                'aluno'=> $aluno,
                'trigger'=>$trigger,]);   
        
            
        }else{ 
            //Mas se tiver algo na pesquisa ele irá procurar
            
            $aluno = Aluno::where('nome','like','%'.$result.'%')
                ->orderBy( $order ,'asc')
                ->get();
           
            
            if(count($aluno)>0){ 
                //Caso ele achar algo no banco, irá retornar
                $trigger = 1;
                
                return view('Content.ListaAluno',[
                'aluno'=> $aluno,
                'trigger'=>$trigger,
                ]);
            } else { 
                //mas se não achar, retornará todos os dados com a mensagem que não obteve sucesso
                
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
        //esta função permite que um administrador remova um aluno
        $aluno =Aluno::find($IdAluno);
        $aluno ->delete();  
        return redirect()
            ->action('AlunoController@ListaAluno');
        
    }  
    public function detailAluno($IdAluno){
        //Esta função permite mostrar detalhes do aluno.
        $aluno = Aluno::find($IdAluno);
        $datnasc = $aluno->datnasc;
        $datnasc = $datnasc->format('d-m-Y');
        
        return view('Content.DetailAluno',[
            'aluno' => $aluno,
            'datnasc' => $datnasc]);
    }
    public function Aluno(){
        
    //Esta função retorna a view de cadastro de aluno
        return view('Content.AlunoForm');
    }
    public function AlunoSubmit(AlunoRequest $request){
        //Esta função permite cadastrar um aluno
       $aluno = Aluno::create($request ->all());
       $aluno->save();
        
        Session::flash('mensagem', 'Aluno cadastrado com sucesso');
        
            return redirect()
                ->action('MainController@index');
               
    }
    
      
}
