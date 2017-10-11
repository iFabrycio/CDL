@extends('Layout.principal')
@section('back')
<a href="/home">
    Voltar
</a>
@endsection
@section('title')
Lista
@endsection

@section('content')

<br/>
<br/>
<br/>
<br/>
<br/>
<div class="poscentralized">
    <div class="BoxButton" onclick="RedirectToListAluno()" style="border-right:none; border-bottom-left-radius: 5px; border-top-left-radius: 5px; ">
        <figure class="figure">
            <div class="poscentralized">
                <i class="fa fa-group fa-5x"></i>
            </div>
            <figcaption class="align-text" align="center">
                Lista de Alunos
                
            </figcaption>
        </figure>
    </div>
    <div class="BoxButton" onclick="RedirectToListLivro()" style="border-bottom-right-radius: 5px; border-top-right-radius: 5px; ">
        <figure class="figure">
            <div class="poscentralized">
                <i class="fa fa-book fa-5x"></i>
            </div>
            <figcaption class="align-text" align="center">
                Listas de Livros
            </figcaption>

        </figure>
    </div>
</div>

@stop