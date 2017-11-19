@extends('Layout.principal')
@section('title')
Alterar senha
@endsection
@section('back')
<a href="/home">Voltar</a>
@endsection

@section('content')

<div class="poscentralized">
    <div class="formulario">
        <form class="form form-group">
        <label for="i_senha_antiga">
            Senha atual
            </label>
            <input class="form-control">
        </form>
    </div>
</div>

@stop