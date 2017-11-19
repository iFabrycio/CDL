@extends('Layout.principal')
@section('back')
<a href="/lista/Aluno">
    Voltar
</a>
@endsection
@section('title')
    Detalhes do aluno
@endsection
@section('content')
<div class="jumbotron jumbo positioned"  >
    <h2 align="center">{{$aluno->nome}}</h2>
    <div class="poscentralized">
        <div class="BoxDetails" >
    <ul>
        <h3><b>Sobre o aluno:</b></h3>
        <li><b>CPF:</b> {{$aluno -> CPF}}</li>
        <li><b>Data de nascimento:</b> {{$datnasc}}</li>
        <li><b>E-mail:</b> {{$aluno -> email}}</li> 
        <li><b>Natural de:</b> {{$aluno ->naturalidade}} - {{$aluno -> uf_natural}}</li>
        <li><b>Nome da mãe:</b> {{$aluno ->nome_mae}}</li>
        <li><b>CPF da mãe:</b>{{$aluno ->CPF_mae}}</li>
        <li><b>Nome do pai:</b> {{$aluno ->nome_pai}}</li>
        <li><b>CPF da pai:</b>{{$aluno ->CPF_pai}}</li>
        <li><b>Nome do responsável:</b>{{$aluno ->nome_resp }}</li>
        <li><b>CPF do Responsável:</b> {{$aluno ->cpf_resp}}</li>
    </ul>
            </div>
        <div class="BoxDetails">
    <ul>
        <h3><b>Endereço e contato:</b></h3>
        <li><b>Rua:</b> {{$aluno -> rua}}</li>
        <li><b>Numero:</b> {{$aluno ->numero}}</li>
        <li><b>Bairro:</b> {{$aluno -> bairro}}</li>
        <li><b>Complemento:</b> {{$aluno-> complemento}}</li>
        <li><b>CEP:</b> {{$aluno ->cep}}</li>
        <li><b>Cidade:</b> {{$aluno -> cidade}} - {{$aluno->estado}}</li>
        <li><b>Telefone celular:</b> {{$aluno -> tel_celular}}</li>
        <li><b>Telefone fixo:</b> {{$aluno ->tel_fixo}}</li>
            </ul>
        </div>
            <div class="BoxDetails">
                <ul>
            <h3><b>Sobre sua escola:</b></h3>
                    <li><b>Escola:</b> {{$aluno -> escola_origem}}</li>
                    <li><b>Tipo de escola:</b> {{$aluno->tipo_escola}}</li>
                    <li><b>Ano:</b> {{$aluno -> serie}}</li>
    
    </ul>
            </div>
    </div>
</div>
@stop

