<?php

namespace App\Http\Controllers;

use App\Livro;
use App\Genero;
use App\Editora;
use App\Autor;
use App\Emprestimo;
use App\Aluno;
use App\Historico;
use App\ConfigAdmin;

use Carbon\Carbon;
use Query\Builder;
use DB;
use Request;
use App\Http\Requests\AlunoRequest;
use App\Http\Requests\LivroRequest;
use Redirect;
use Session;



class LivroController extends Controller
{
    public function __construct(){
        //Ativação do Middleware de autenticação e checagem de nivel de usuario
        $this->middleware('auth');
        $this->middleware('admincheck',['only' =>['RemoveLivro']]);
    }
    
    public function Livro(){
        //Retorna a view de cadastro de autores, editoras, gêneros e livros
        $autores = Autor::all();
        $generos = Genero::all();
        $editora = Editora::all();
        
        return view('Content.LivroForm', [
            'autores' => $autores,
            'editora' => $editora,
            'genero' => $generos,
            
        ]);
    }
    public function ListaLivro(){
        //Esta função busca livros no banco de dados
        $livros = Livro::all();
        $result = Request::input('Pesquisa');
        $order = Request::input('organizar');
        
        if(empty($order)){
            //Ordem padrão
            $order = 'IdLivro';
        }
        
        if(empty($result)){
            //Se o usuário não por nada no input de pesquisa
            //não irá buscar por nada e nada aparecerá.
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
            //Caso ele pesquise, o gatilho $trigger retornara 'true'
            //permitindo que o usuário veja o resultado da pesquisa
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
                //Parte em estudo, porém se vê desnecessária.
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
  
    public function LivroSubmit(LivroRequest $request ){
        
        //Cadastra os livros

        $livro = new Livro;
        $livro ->IdGenero = Request::input('IdGenero');
        $livro ->IdEditora = Request::input('IdEitora');
        $livro ->IdAutor = Request::input('IdAutor');
        $livro = Livro::create($request ->all());
        return redirect()->action('LivroController@Livro');
 
    } 
    
    public function autorCadastrar(){
        //Cadastra os autores
        $autor = new Autor;
        $autor->nome = Request::input('nome');
        $autor->save();
        
        Session::flash('mensagem', 'Autor cadastrado com sucesso');
        
        return redirect()->action('LivroController@Livro');
    }
    public function editoraCadastrar(){
        //Cadastra as editoras
        $editora = new Editora;
        $editora ->nome = Request::input('nome');
        $editora ->save();
        
        Session::flash('mensagem','Editora cadastrada com sucesso');
        
        return redirect()->action('LivroController@Livro');

    }
    public function generoCadastrar(){
        //Cadastra os generos
        $genero = new Genero;
        $genero ->nome = Request::input('nome');
        $genero ->save();
        
        Session::flash('mensagem','Genero cadastrado com sucesso');
        
        return redirect()->action('LivroController@Livro');
    }
    
    public function RemoveLivro($IdLivro){
        //Remove o livro do banco de dados
        $livro = Livro::find($IdLivro);
        $livro->delete();
        return redirect()
            ->action('LivroController@ListaLivro');
    }
    public function DetailLivro($IdLivro){
        //Mostra os detalhes de um livro
        $livro = Livro::find($IdLivro);
        
        return view('Content.DetailLivro',['livro'=>$livro]);
    }
    public function EmprestaLivro($IdLivro){
        //Direciona para a tela de confirmação de emprestimo
        $livro = Livro::find($IdLivro);
        
        return view('Content.ConfirmaEmprestimo',['livro'=>$livro,]);
    }
    public function Emprestimo(){
        //Captura de formulario e definição de Timezone
        date_default_timezone_set('America/Bahia');
        $codLivro = Request::input('CodigoLivro');
        $CPF = Request::input('CPF');
        $Pages = Request::input('Pages'); 
        $datahoje = Carbon::today();
        $hoje = Carbon::today();
        //Fim da captura
        
        //Verificação da existência do dado colocado pelo aluno
        $CPFAluno = new Aluno;
        $CPFAluno = DB::select('select * from aluno where CPF = ?',array($CPF));
   
      

        if(empty($CPFAluno)){ 
            //Se o resultado da procura pelo CPF for vazio volta para a página inicial
            Session::flash('mensagemError','Aluno não cadastrado ou CPF incorreto');
            return redirect()
                ->action('MainController@index');
        } else{ 
            //Se não...

            $aluno = Aluno::where('cpf', $CPF)->get()->first();
            $livro = Livro::where('codlivro',$codLivro)
                ->get()
                ->first();
            
            
            if($aluno->StatusAluno == 2){
                //Se o aluno estiver bloqueado por entregar outrolivro atrasado, ele retorna a mensagem
                Session::flash('mensagemError','Aluno bloqueado por devolver um livro atrasado');
                return redirect()
                    ->action('MainController@index');
            }
            
            
            if($aluno->StatusAluno == 1){
                //Se o aluno já tenha um livro, ele retorna a mensagem
               Session::flash('mensagemError','O aluno já tem um livro emprestado');
                return redirect()
                    ->action('MainController@index');
            }else{
                if($livro->StatusLivro == 1){
                    
                //Se o livro estiver emprestado a outr pessoa, ele retorna a mensagem
                    Session::flash('mensagemError','Este livro está emprestado');
                    return redirect()
                        ->action('MainController@index');
                }else{
                    if($Pages <= 200){ 
                        //Determina a quantidade de dias máximos para //empréstimo para livros maiores ou menores //que 200 páginas
                        $datalimite = $datahoje->addWeek();
            
                    }else{
                        $datalimite = $datahoje->addWeeks(2); 
                
                    }
                    
                    if($livro -> isReserved == 1){
                        //Se está reservado, verifica se o cpf do aluno condiz com o da tabela
                        $reserved = DB::table('reserva')
                            ->where([
                                ['codLivro', $codLivro],
                                ['CPF', $CPF]
                            ])
                            ->get()
                            ->first();
                if(count($reserved)>0){ 
                    //Se houver ele será excluído do banco e o isReserved do Livro retorna a 0.
                    DB::table('reserva')
                    ->where([
                    ['codLivro', $codLivro],
                    ['CPF', $CPF]
                            ])
                   ->delete();
                    
                    DB::table('livro')
                        ->where('codlivro',$codLivro)
                        ->update(['isReserved' =>0]);
                    
                }else{
                    //Se não obtiver sucesso, retornará a mensagem de erro
                    Session::flash('mensagemError','Este livro está reservado à outra pessoa');
                    return redirect()
                        ->action('MainController@index');
                }
                        
            }
        //Gravação do registro de emprestimos
                DB::insert('insert into emprestimo (CodigoLivro,CPFAluno,DataEmprestimo,DataDevolucao) values (?,?,?,?)',array($codLivro,$CPF,$hoje,$datalimite));  
        //Mudança do status do aluno e do livro para 1
                $hist = new Historico;
                $hist->Atividade = "Pegou um livro emprestado";
                $hist->NomeAluno = $aluno -> nome;
                $hist ->CPF = $aluno -> CPF;
                $hist ->CodLivro = $codLivro;
                $hist ->save();

                    DB::table('aluno')
                        ->where('CPF', $CPF)
                        ->update(['StatusAluno' =>1]);
                
                    DB::table('livro')
                        ->where('codlivro',$codLivro)
                        ->update(['StatusLivro' =>1]);
        
        //Mensagem de sucesso retornada ao usuário
               
                    
                    
                    if ($Pages <= 200){
                    Session::flash('mensagem','Livro emprestado com sucesso. Você tem 7 dias para ler');
                    return redirect()
                        ->action('MainController@index');
                } else {
                    Session::flash('mensagem','Livro emprestado com sucesso. Você tem 15 dias para ler');
                    return redirect()
                        ->action('MainController@index');
                }

            }
             
        }    
        }
        
    }
    public function Devolucao(){
        //retorna a view que possibilita a devolução de livros
        return view('Content.Devolucao');
        }
    public function DevolverLivro(){
        //Função para devolução de livros
        $codLivro = Request::input('codLivro');
        $CPFAluno = Request::input('CPFAluno');
        $date = Carbon::today();
        
        //Verifica se o livro está emprestado
        $result = DB::table('emprestimo')
                ->where([
                    ['CodigoLivro', $codLivro],
                    ['CPFAluno', $CPFAluno]
                ])
                ->get()
                ->first();

        
       if(count($result)==0){
           //Se não estiver
           Session::flash('mensagem','Livro não emprestado.');
           return redirect()
               ->action('LivroController@Devolucao');
           
       } else{
           //Se a data de entrega for depois da data limite para entrega
           
           
           //será mudado o status do aluno para 2(bloqueado)
           
           
           //e será gravado seu bloqueio, o dia em que foi feito e o dia em que será liberado
           
           
           if($date > $result->DataDevolucao){
               
               $datadevolucao = Carbon::createFromFormat('Y-m-d', $result->DataDevolucao);
               
               $datahoje = Carbon::today();
               
               $value = $datahoje->diffInDays($datadevolucao);
               
               $dias = DB::table('configuracao')
                   ->select('DiasMulta')
                   ->get()
                   ->first();
               
               $multa = $value * $dias->DiasMulta;
               
                 if ($multa == 0){ 
                     //Está condição determina o multiplicador de dias de bloqueio
                    //estabeleceu o minimo de 2 dias
                    //Está parte está sendo estudada, atualmente aparenta ser desnecessária
                     $datamultafim = $datahoje->addDays(2); 
                     
                 }else{
               
                     $datamultafim = $datahoje->addDays($multa);
                     
                 }
               //Variavel de captura da data atual
               $hoje = Carbon::today();
               
               //atualização da tabela aluno
               DB::table('aluno')
                    ->where('CPF', $CPFAluno)
                    ->update(['StatusAluno' =>2]);
               
               //inserção na tabela multa
               DB::table('multa')
                    ->insert([
                        'CPFAluno' => $CPFAluno,
                        'dataMultaInicio' => $hoje,
                        'dataMultaFim' => $datamultafim,
                    ]);
               
               //exclusão de dados da tabela emprestimo
                DB::table('emprestimo')
                    ->where([
                    ['CodigoLivro', '=', $codLivro],
                    ['CPFAluno', '=', $CPFAluno]
               ])
                    ->delete();
               //atualização da tabela livro
               DB::table('livro')
                   ->where('codLivro',$codLivro)
                   ->update(['StatusLivro' =>0]);
               
               //gravaçãono historico
               $aluno = Aluno::where('cpf', $CPFAluno)->get()->first();
               $hist = new Historico;
                $hist->Atividade = "Devolveu um livro atrasado, bloqueado até ".$datamultafim;
                $hist->NomeAluno = $aluno -> nome;
                $hist ->CPF = $CPFAluno;
                $hist ->CodLivro = $codLivro;
                $hist ->save();
               
               //envio de mensagem ao usuário
               Session::flash('mensagem','Livro devolvido, aluno bloqueado por devolve-lo atrasado');
                return redirect()
               ->action('LivroController@Devolucao');
               
                   
           }else{
            //Se Livro for devolvido antes da data limite
          
               
               //atualização da tabela aluno.
           DB::table('aluno')
            ->where('CPF', $CPFAluno)
            ->update(['StatusAluno' =>0]);
           
               //atualização da tabela livro
           DB::table('livro')
               ->where('codlivro',$codLivro)
               ->update(['StatusLivro' =>0]);
           
               //Exclusão dos dados da tabela empréstimo
           DB::table('emprestimo')
               ->where([
                    ['CodigoLivro', '=', $codLivro],
                    ['CPFAluno', '=', $CPFAluno]
               ])->delete();
           
               //Gravação no historico
              $aluno = Aluno::where('cpf', $CPFAluno)->get()->first();
               $hist = new Historico;
                $hist->Atividade = "Devolveu um livro emprestado";
                $hist->NomeAluno = $aluno -> nome;
                $hist ->CPF = $CPFAluno;
                $hist ->CodLivro = $codLivro;
                $hist ->save();
           
               
               //mensagem retornada ao usuário
           Session::flash('mensagemSuccess','Livro devolvido.');
           return redirect()
               ->action('LivroController@Devolucao');
       }
     }
        
    }
}
