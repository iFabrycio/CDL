@extends('Layout.principal') @section('title') Lista de Alunos @endsection 
@section('back')
<a href="/home">
    Voltar
</a>
@endsection
@section('content')

<div class="container poscentralized">
        <div class="row">
            @if(Session::has('mensagem'))
            <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"> &nbsp; &times;</a>
                {{Session::get('mensagem')}}
            </div>
            @endif
    </div>
</div>
    <table class="table table-hover">
    @foreach($aluno as $a)
        <tr>
        <td>{{$a->nome}}</td>
        </tr>
        @endforeach
    </table>

@stop