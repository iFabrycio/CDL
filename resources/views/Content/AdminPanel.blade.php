@extends('Layout.principal') @section('back')
<a href="/home">
    Voltar
</a> @endsection @section('title') Configurações @endsection @section('content')

<!-- Espaço paraexibição de mensagens de sucesso/erro -->
 @foreach ($errors ->all() as $error)
<div class="poscentralized">
    <div class="alert alert-danger widthed" align="center">{{$error}}
    </div>
</div>
@endforeach

<br/>
<div class="poscentralized">
@if(Session::has('mensagem'))
    
<div class="alert alert-success" style="">
    <a href="#" class="close" data-dismiss="alert" aria-label="close"> &nbsp; &times;</a> {{Session::get('mensagem')}}
</div>
@endif
@if(Session::has('mensagemError'))
    
<div class="alert alert-danger" style="">
    <a href="#" class="close" data-dismiss="alert" aria-label="close"> &nbsp; &times;</a> {{Session::get('mensagemError')}}
</div>
@endif
</div>



<!-- Tabela de visualização de usuários moderadores/administradores -->
<div class="poscentralized">
    <div class=" config-menu-usuarios">
        <label>
                <h3>Lista de Usuários:</h3>
        </label>
        <p>Usuários Moderadores/Administradores </p>
        <div class="btn btn-primary buttonadicionar " id="event-menu" onclick="MenuAdmin()">
            Adicionar usuário
        </div>


        <div class="ScrollStyle">
            <table class="table table-hover">
                @foreach($users as $u) @if($u->is_admin == 0)
                <tr class="success optionlista">
                    <td>
                        <div class="optionlista">{{$u ->name}}</div>
                    </td>
                    <td>
                        <a href="{{action('AdminController@DefinirNivel',$u->id)}}">
                            <div class="btn btn-primary">Tornar administrador</div>
                        </a>
                        <a href="{{action('AdminController@RemoverUsers',$u -> id)}}">
                            <div class="btn btn-danger">Remover</div>
                        </a>
                    </td>
                </tr>
                @else
                <tr class="info">
                    <td>
                        <div class="optionlista">{{$u ->name}}</div>
                    </td>
                    <td>
                        <a href="{{action('AdminController@DefinirNivel',$u->id)}}">
                            <div class="btn btn-danger">Retirar administrador</div>
                    </td>
                </tr>
                @endif @endforeach
            </table>
        </div>


    </div>

</div>
<!-- Menu lateral escondido para registro de usuários moderadores/Administradores -->
<div id="lateral">

    <div class="boxpanel">

        <form class="form" method="POST" action="/Admin/painel/register">
            {{ csrf_field() }}
            <label><h3>Registrar usuário</h3></label>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="">Nome de usuário</label>

                <div class="">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required> @if ($errors->has('name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('CPF') ? ' has-error' : '' }}">
                <label for="CPF" class="">CPF</label>

                <div class="">
                    <input id="CPF" type="text" class="form-control" name="CPF" value="{{ old('CPF') }}" required autofocus> @if ($errors->has('CPF'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('CPF') }}</strong>
                                    </span> @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class=""> Endereço de E-Mail </label>

                <div class="">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required> @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="">Senha</label>

                <div class="">
                    <input id="password" type="password" class="form-control" name="password" required> @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="">Confirme a senha</label>
                <div class="">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <div class="">
                    <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                    <div onclick="MenuAdmin()" class="btn btn-danger ">
                        Cancelar
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@stop
