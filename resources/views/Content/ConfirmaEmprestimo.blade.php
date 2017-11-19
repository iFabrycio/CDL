@extends('Layout.principal')
@section('title')
Empréstimo de Livros 
@endsection 
@section('back')
<a href="/home">
    Voltar
</a>
@endsection
@section('content')
<div class="poscentralized">
<div class="sizeEmprestimo">
    
    <form class="form-default form-group"  method ="post" action="{{action('LivroController@Emprestimo')}}"align="center">
        {{ csrf_field() }}
<div class="panel panel-default ">
    <div class="panel panel-heading" align="center">Confirmar empréstimo</div>
            <div class="padding">
        
            <input type="hidden" class="form-control" value="{{$livro->codLivro}}" name="CodigoLivro">
                
            <input type="hidden" class="form-control" value="{{$livro->NumeroPaginas}}" name="Pages">
            
            <label for="CPF">Insira o CPF</label>
               
            <input class="form-control" id="CPF" name="CPF" placeholder="Digite o CPF aqui"/>
            <br/>
            <input class="btn btn-success" type="submit" value="Emprestar">
        </div>
    </div>

        </form>
</div>
</div>
  
@stop

