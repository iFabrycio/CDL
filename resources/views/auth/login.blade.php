@extends('layout.principal')
@section('title')
Login
@endsection

@section('content')

<br/>
<br/>
<br/>
<br/>
<div class="poscentralized">
<div class="panell panel panel-default">
    <div class="panel panel-dashboard">
        Login</div>
<form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('CPF') ? ' has-error' : '' }}">
                            <label for="CPF" class="col-md-4 control-label">CPF</label>

                            <div class="col-md-6">
                                <input id="CPF" type="text" class="form-control" name="CPF" value="{{ old('CPF') }}" required autofocus>

                                @if ($errors->has('CPF'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('CPF') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Lembrar-me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Esqueceu a sua senha?
                                </a>
                            </div>
                        </div>
                    </form>
    </div>
</div>

    
@endsection
