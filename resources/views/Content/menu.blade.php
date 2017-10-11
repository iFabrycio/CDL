@extends('Layout.principal') @section('title') Menu @endsection

@section('content')

<br/>
<br/>

<div class="poscentralized">
    <form role="search" class="navbar-form">
        <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Procurar Livros" />
            <span class="form-control-feedback glyphicon glyphicon-search"></span>
        </div>
    </form>
    
</div>
<br/>
<br/>
<br/>
<div class="poscentralized">

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
                 <i class="fa fa-hand-o-left fa-5x" ></i>
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
    
    <br/>
    <br/>
    @if(old('nome'))
<div class="alert alert-success pull-left"  align=center><h6>O(A) {{old('nome')}} foi adicionado a lista com sucesso!</h6></div>                                                   
@endif


@stop
