@extends('Layout.principal') @section('title') Cadastro @endsection
@section('back')
<a href="/home">
    Voltar
</a>
@endsection
@section('content')

<br/>
<br/>
<br/>
<br/>
<br/>
<div class="poscentralized">
    <div class="BoxButton" onclick="RedirectToFormAluno()" style="border-right:none; border-bottom-left-radius: 5px; border-top-left-radius: 5px; ">
        <figure class="figure">
            <div class="poscentralized">
                <i class="fa fa-address-book fa-5x"></i>
            </div>
            <figcaption class="align-text" align="center">
                Cadastrar Aluno
                
            </figcaption>
        </figure>
    </div>
    <div class="BoxButton" onclick="RedirectToFormLivro()" style="border-bottom-right-radius: 5px; border-top-right-radius: 5px; ">
        <figure class="figure">
            <div class="poscentralized">
                <i class="fa fa-book fa-5x"></i>
            </div>
            <figcaption class="align-text" align="center">
                Cadastrar Livros
            </figcaption>

        </figure>
    </div>
</div>
@stop
