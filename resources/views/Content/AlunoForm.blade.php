@extends('Layout.principal') 
@section('back')
<a href="/cadastro">
    Voltar
</a>
@endsection
@section('title')
Cadastrar Aluno
@endsection
@section('content')

<br/><br/>

    @foreach ($errors ->all() as $error)
<div class="poscentralized">
    <div class="alert alert-danger widthed" align="center">{{$error}}
    </div>
</div>
    @endforeach


<div class="poscentralized" align="center">

    <form class="form-horizontal" method="POST" action="/cadastro/Aluno/submit">
        {{ csrf_field() }}





        <div class="panel-group" style="width:300px;" id="accordion">
            <div class="panel panel-default" >
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                    <div class="panel-heading">
                        <h4 class="panel-title" >

                            Sobre o aluno
                        </h4>
                    </div>
                </a>
                <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <label for="nome">Nome Completo:*</label>
                        <input name="nome" placeholder="Nome" class="form-control">
                        <label for="CPF">CPF:*</label>
                        <input name="CPF" placeholder="CPF" class="form-control">
                        <label for="datnasc">Data de Nascimento:*</label>
                        <input name="datnasc" type="date" placeholder="09/02/2000" class="form-control">
                        <label for="naturalidade">Naturalidade:</label>
                        <input name="naturalidade" placeholder="Naturalidade" class="form-control">
                        <label for="uf_natural">UF Natural:</label>
                        <input name="uf_natural" placeholder="UF Natural" class="form-control">
                        <label for="nome_mae">Nome da mãe:*</label>
                        <input name="nome_mae" placeholder="Nome da Mae" class="form-control">
                        <label for="nome_pai">Nome do Pai:</label>
                        <input name="nome_pai" placeholder="Nome do Pai" class="form-control">
                        <hr/>
                        <label for="nome_resp">Nome do responsável:</label>
                        <input name="nome_resp" placeholder="Nome do Responsável" class="form-control">
                        <label for="cpf_resp">CPF do Responsável:</label>
                        <input name="cpf_resp" placeholder="CPF do Responsável" class="form-control">
                        <label for="grau_resp">Grau do Responsável:</label>
                        <input name="grau_resp" placeholder="Grau do Responsável" class="form-control">

                    </div>

                </div>
            </div>
            <div class="panel panel-default">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">

                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Endereço e Contato
                        </h4>
                    </div>
                </a>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <label for="rua">Rua:</label>
                        <input name="rua" placeholder="Rua" class="form-control">
                        <label for="numero">Numero:</label>
                        <input type="number" min="1" name="numero" id="Numero" placeholder="numero" class="form-control">
                        <label for="bairro">Bairro:</label>
                        <input name="bairro" placeholder="Bairro" class="form-control">
                        <label for="complemento">Complemento:</label>
                        <input name="complemento" placeholder="complemento" class="form-control">
                        <label for="cep">CEP:</label>
                        <input name="cep" placeholder="CEP" class="form-control">
                        <label for="cidade">Cidade:</label>
                        <input name="cidade" placeholder="Cidade" class="form-control">
                        <label for="estado">Estado:</label>
                        <input name="estado" placeholder="Estado" class="form-control">
                        <hr/>
                        <label for="tel_celular">Celular:*</label>
                        <input name="tel_celular" placeholder="Celular" class="form-control">
                        <label for="tel_fixo">Fixo:*</label>
                        <input name="tel_fixo" placeholder="Fixo" class="form-control">
                        <label for="email">Email:</label>
                        <input name="email" placeholder="Email" type="Email" class="form-control">

                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                    <div class="panel-heading">
                        <h4 class="panel-title">

                            Sobre a escola
                        </h4>
                    </div>
                </a>
                <div id="collapse3" class="panel-collapse collapse">
                    <div class="panel-body">
                        <label for="tipo_escola">Tipo de Escola:*</label>
                        <select id="tipo_escola" class="form-control">
                    <option>Pública</option>
                    <option>Privada</option>
          </select>
                        <label for="escola_origem">Nome da Escola:*</label>
                        <input name="escola_origem" placeholder="Nome da escola" class="form-control">
                        <label for="serie">Ano:*</label>
                        <input name="serie" placeholder="Ano" class="form-control">
                        <label for="turno">Turno:*</label>
                        <input name="turno" placeholder="Turno" class="form-control">

                    </div>
                </div>
            </div>
        </div>
        <input class="btn btn-default" type="submit" value="Concluir" />
    </form>

</div>




@endsection
@section('footer')
<img src="hacktown-marca.png" alt="Logo" />
@stop