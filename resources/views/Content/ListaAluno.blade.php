@extends('Layout.principal') 
@section('title')
Lista de Alunos 
@endsection 
@section('content')
<div class="sidebar-nav">
    
        <div class="sidebar" align="center">
            <ul>
                
                <li><div class="BoxMenu actived">Lista de alunos</div></li>
                <li><div class="BoxMenu">Lista de livros</div></li>
               
                
            </ul>
        </div>
    </div>
<br/>
<div class="poscentralized">
    <div class="">
        <table class="table table-striped">
            <tr>
            <th>ID</th>
            <th>Aluno</th>
            <th>Data de Nascimento</th>
            <th>CPF</th>
            <th>Opções</th>
            </tr>
            @foreach($aluno as $a)
            <tr>
            <td>{{$a -> IdAluno}}</td>
            <td>{{$a -> nome}}</td>
            <td>{{$a -> datnasc}}</td>
            <td>{{$a -> CPF}}</td>
            <td>
                <a href="{{action('MainController@removeAluno',$a->IdAluno)}}">
                    <i class="glyphicon glyphicon-trash fa-2x" aria-hidden="true"></i>
                </a>&nbsp; &nbsp;
            <i class="glyphicon glyphicon-search fa-2x" aria-hidden="true"></i></td>
            </tr>
           @endforeach
            
        </table>
    </div>
</div>
@stop
