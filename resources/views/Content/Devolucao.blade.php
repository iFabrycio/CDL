@extends('Layout.principal') @section('title') Devolução @endsection 
@section('back')
<a href="/home">
    Voltar
</a>
@endsection
@section('content')

<div class="poscentralized">
<div class="formulario">
    <h3 align=center>Devolução de livro</h3>
    <form class="form-default form-group"  method ="get" action="{{action('LivroController@DevolverLivro')}}" align="center">
        {{ csrf_field() }}


           
        
            <label for = "iCod">Código do livro</label>
                <input class="form-control" id="iCod" name = "codLivro" placeholder="Digite o código do livro" value="{{old('codLivro')}}"/>
                <hr/>
                
            <label for="CPF">Insira seu CPF</label>
            <input class="form-control" id="CPF" name="CPFAluno" placeholder="Digite seu CPF aqui"/>
            <br/>
            <input class="btn btn-success" type="submit" value="Devolver">

    

        </form>

        <div class="row">
            @if(Session::has('mensagem'))
            <div class="alert alert-warning" align=center>
            <a href="#" class="close" data-dismiss="alert" aria-label="close"> &nbsp; &times;</a>
                {{Session::get('mensagem')}}
            </div>
            @endif
            @if(Session::has('mensagemSuccess'))
            <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"> &nbsp; &times;</a>
                {{Session::get('mensagemSuccess')}}
            </div>
            @endif
        </div>
    </div>
    
    </div>
</div>



@stop
