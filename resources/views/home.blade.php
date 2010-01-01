@extends('Layout.principal') @section('content')

<br/>
<br/>
<br/>
<br/>
<br/>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" align="center">
                <div class="DashBoard">
                    <div class="panel-heading">Clube de Leitura - Academia HackTown</div>
                </div>
                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    Bem vindo {{ Auth::user()->name }}, você será redirecionado para o menu príncipal logo.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('redirect')
http-equiv="refresh" content="5; url=/home"

@stop
