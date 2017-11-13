@extends('Layout.principal') @section('title') Lista de Alunos @endsection 
@section('back')
<a href="/home">
    Voltar
</a>
@endsection
@section('content')


<div class="poscentralized">
    <div class="historico">
<table class="table table-hover">
    {{$historico ->links()}}
    <tr>
    <th>Data</th>
    <th>Atividade</th>
    <th>Nome do aluno</th>
    <th>CPF</th>
    <th>Código do livro</th>
    </tr>
    @foreach($historico as $h)
    <tr>
    <td>{{$h -> DataHistorico}}</td>
    <td>{{$h -> Atividade}}</td>
    <td>{{$h -> NomeAluno}}</td>
    <td>{{$h -> CPF}}</td>
    <td>{{$h -> CodLivro}}</td>
    </tr>
    @endforeach
    </table> 
    {{$historico ->links()}}
   
</div>
    </div>
@stop
