@extends('Layout.principal') @section('title') Menu @endsection

@section('content')

<br/>
<br/>


<section>
    @if($tr == 1)
    <div class="content-menu">
    @else
    <div class="poscentralized">
    @endif
        <form role="search" class="navbar-form">
            <div class="form-group has-feedback">
                <input type="text" class="form-control"  name="Pesquisa" placeholder="Procurar livros para emprestar"/>
                <a href="/pesquisar/livro"><span class="form-control-feedback glyphicon glyphicon-search"> </span></a>
            </div>
        </form>

    </div>
    <br/>
    <br/>
    <br/>
    @if($tr == 1)
    <div class="content-menu">
    @else
    <div class="poscentralized">
    @endif
  
        <div class="BoxButton" onclick="MenuCadastro()" style="cursor: pointer; border-top-left-radius:5px; border-bottom-left-radius:5px; border-right:none;">
            <figure class="figure">

                <div class="poscentralized">
                    <i class="fa fa-sign-in fa-5x"></i>
                </div>
                <figcaption>
                    Cadastro
                </figcaption>

            </figure>
        </div>
        <div class="BoxButton" style=" cursor: pointer;border-right:none;" onclick= "Devolucao()">
            <figure class="figure">
                <div class="poscentralized">
                    <i class="fa fa-hand-o-left fa-5x"></i>
                </div>
                <figcaption class="align-text" align="center">
                    Devolução
                </figcaption>
            </figure>
        </div>
        <div class="BoxButton" style=" cursor: pointer;" onclick= "Historico()">
            <figure class="figure">
                <div class="poscentralized">
                    <i class="fa fa-clock-o fa-5x"></i>
                </div>
                <figcaption class="align-text" align="center">
                    Historico
                </figcaption>

            </figure>
        </div>
        <div class="BoxButton" style=" cursor: pointer;border-left:none;" onclick= "Reserva()">
            <figure class="figure">
                <div class="poscentralized">
                    <i class="fa fa-bookmark-o fa-5x"></i>
                </div>
                <figcaption class="align-text" align="center">
                    Reserva
                </figcaption>

            </figure>
        </div>
        <div class="BoxButton" onclick="MenuLista()" style="border-top-right-radius:5px; border-bottom-right-radius:5px; border-left:none;cursor: pointer;">
            <figure class="figure">
                <div class="poscentralized">
                    <i class="fa fa-list-alt fa-5x"></i>
                </div>
                <div class="poscentralized">
                <figcaption class="align-text" align="center">
                    Listas/Status
                </figcaption>
                    </div>
            </figure>
        </div>
    </div>

@if($tr == 1)
    
    
<div class="search-result">

    <table class="search-result-list table table-hover" >
        <tr>
            <th>Titulo</th>
            <th>Código</th>
            <th>Opção</th>
        </tr>
        @foreach ($livro as $l)
        @if($l -> isReserved == 0)
        <tr>
            <td>{{$l -> Titulo}}</td>
            <td>{{$l -> codLivro}}</td>
            <td><a href="/livro/emprestar/{{$l->IdLivro}}"><button class="btn btn-success" value="Emprestar">Emprestar</button></a>&nbsp;<a href="/Reserva/{{$l->IdLivro}}"><button class="btn btn-success" value="Emprestar">Reservar</button></a></td>
        </tr>
        @else
        <tr>
            <td>{{$l -> Titulo}}</td>
            <td>{{$l -> codLivro}}</td>
            <td><a href="/livro/emprestar/{{$l->IdLivro}}"><button class="btn btn-success" value="Emprestar">Emprestar</button></a>&nbsp;<a href="/Reserva/{{$l->IdLivro}}"><button class="btn btn-success" value="Emprestar" disabled>Reservar</button></a></td>
        </tr>
        @endif
        @endforeach
        
    </table>
    @if($trigger == 0)
<div class="poscentralized">
    <div class="alert alert-danger">Não foi possível achar o livro</div>
</div>
@else @if(count($livro)>1)
<div class="poscentralized">
    <div class="alert alert-success">{{count($livro)}} Livros encontrados</div>
</div>
@else
<div class="poscentralized">
    <div class="alert alert-success">{{count($livro)}} Livro encontrado</div>
</div>
@endif
@endif
</div>
@endif
        
<div class="container poscentralized">
        <div class="row">
            @if(Session::has('mensagem'))
            <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"> &nbsp; &times;</a>
                {{Session::get('mensagem')}}
            </div>
            @endif
            @if(Session::has('mensagemError'))
            <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"> &nbsp; &times;</a>
                {{Session::get('mensagemError')}}
            </div>
            @endif
        </div>
    </div>
    

    


@stop
