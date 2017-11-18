@extends('Layout.principal')
@section('title')
Reserva de Livros
@endsection
@section('back')
<a href="/menu">
    Voltar
</a>
@endsection
@section('content')

    <div class="poscentralized" align="center">    
        <div class="sizeEmprestimo">
        <div class="panel panel-default ">
        <div class="panel-heading">
            Reservar livro
            </div>
        <div class="panel-body">
            <form class="form form-group" action="/Reservado" method="post">
                {{ csrf_field() }}
                <input type="hidden" value="{{$id}}" name="codLivro">
                <label form = "CPF">Digite seu CPF</label>
                <input class="form form-control" placeholder="CPF" name="CPF">
                <br/>
                <input type="submit" value="Reservar" class="btn btn-success"/>
            </form>
            </div>
        </div>
    </div>
</div>
@stop