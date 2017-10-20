<?php

namespace App\Http\Controllers;

use App\Aluno;


use DB;
use Request;
use App\Http\Requests\AlunoRequest;
use App\Http\Requests\LivroRequest;
use Redirect;


class AlunoController extends Controller
{
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
      
}
