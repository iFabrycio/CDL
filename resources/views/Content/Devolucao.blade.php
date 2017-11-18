@extends('Layout.principal') @section('title') Devolução @endsection 
@section('back')
<a href="/home">
    Voltar
</a>
@endsection
@section('content')

<div class="poscentralized">
<div class="sizeEmprestimo">

    <form class="form-default form-group"  method ="get" action="{{action('LivroController@DevolverLivro')}}" align="center">
        {{ csrf_field() }}
<div class="panel panel-default ">
    <div class="panel panel-heading" align="center">Devolver livro</div>
            <div class="padding">
        
            <label for = "iCod">Código do livro</label>
                <input class="form-control" id="iCod" name = "codLivro" placeholder="Digite o código do livro" value="{{old('codLivro')}}"/>
                <hr/>
                
            <label for="CPF">Insira seu CPF</label>
            <input class="form-control" id="CPF" name="CPFAluno" placeholder="Digite seu CPF aqui"/>
            <br/>
            <input class="btn btn-success" type="submit" value="Devolver">
        </div>
    </div>

        </form>
</div>
</div>
<div class="container poscentralized">
        <div class="row">
            @if(Session::has('mensagem'))
            <div class="alert alert-warning">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"> &nbsp; &times;</a>
                {{Session::get('mensagem')}}
            </div>
            @endif
            @if(Session::has('mensagemSuccess'))
            <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"> &nbsp; &times;</a>
                {{Session::get('mensagemSuccess')}}
            </div>
            @endif
        </div>
    </div>


@stop
