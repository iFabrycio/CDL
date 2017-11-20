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
        <h3>Alterar senha</h3>
        <form class="form form-group">
        <label for="i_senha_antiga">
            Senha atual
            </label>
            <input class="form-control">
            
            <label for="i_senha_nova">
            Nova senha
            </label>
            <input class="form-control">
            
            <label for="i_senha_nova_confirmation">
            Confirme a senha
            </label>
            <input class="form-control">
            <br/>
            <input type="submit" value="Alterar senha" class="btn btn-primary">
            <div class="btn btn-danger pull-right">Cancelar</div>
        </form>
    </div>
</div>

@stop