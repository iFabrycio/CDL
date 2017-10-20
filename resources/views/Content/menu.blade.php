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
                <input type="text" class="form-control"  name="Pesquisa" placeholder="Procurar Livros"/>
                <a href="/pesquisar/livro"><span class="form-control-feedback glyphicon glyphicon-search"></span></a>
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
        <div class="BoxButton" style="border-right:none;">
            <figure class="figure">
                <div class="poscentralized">
                    <i class="fa fa-hand-o-left fa-5x"></i>
                </div>
                <figcaption class="align-text" align="center">
                    Devolução
                </figcaption>

            </figure>
        </div>
        <div class="BoxButton">
            <figure class="figure">
                <div class="poscentralized">
                    <i class="fa fa-bookmark-o fa-5x"></i>
                </div>
                <figcaption class="align-text" align="center">
                    Reserva
                </figcaption>

            </figure>
        </div>
        <div class="BoxButton" onclick="MenuLista()" style="border-top-right-radius:5px; border-bottom-right-radius:5px; border-left:none;">
            <figure class="figure">
                <div class="poscentralized">
                    <i class="fa fa-list-alt fa-5x"></i>
                </div>
                <figcaption class="align-text" align="center">
                    Listas
                </figcaption>

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
        <tr>
            <td>{{$l -> Titulo}}</td>
            <td>{{$l -> codLivro}}</td>
            <td><a href="/livro/emprestar/{{$l->IdLivro}}"><button class="btn btn-success" value="Emprestar">Emprestar</button></a></td>
        </tr>
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

    

    


@stop
