@extends('Layout.principal') @section('title') Lista de Alunos @endsection 
@section('back')
<a href="/home">
    Voltar
</a>
@endsection
@section('content')


<div class="poscentralized">
<table class="table table-hover">
    <tr>
    <th>Data</th>
    <th>Atividade</th>
    <th>Nome do aluno</th>
    <th>CPF</th>
    <th>Código do livro</th>
    </tr>
    </table> 
</div>
@stop
