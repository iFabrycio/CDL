@extends('Layout.principal')
@section('title')
Informações dos Livros 
@endsection

@section('back')
<a href="/lista/Livro">
    Voltar
</a>
@endsection

@section('content')

<div class="jumbotron">
    <div class="poscentralized">
        <h2>{{$livro->Titulo}}</h2>
    </div>
    <div class="poscentralized">
        <div class = "BoxDetails">
        @if(empty($livro->FotoCapa))
           <img src="/No-image-found.jpg" alt = "Foto de capa"/>
            @else
            <img src="/No-image-found.jpg" alt = "Foto de capa" width ="200" height="200"/>
            @endif
        </div>
        <div class="BoxDetails">
            <ul>
                <li><b>Código: </b>{{$livro->codLivro}}</li>
                <li><b>Ano: </b>{{$livro->Ano}}</li>
                <li><b>Foto de capa: </b>{{$livro->FotoCapa}}</li>
                <li><b>Numero de páginas: </b>{{$livro->NumeroPaginas}}</li>
                <li><b>CDU: </b>{{$livro->CDU}}</li>
                <li><b>CDD: </b>{{$livro->CDD}}</li>
            </ul>
        </div>
        <div class="BoxDetails">

            <ul>
                <li><b>ISBN: </b>{{$livro->ISBN}}</li>
                <li><b>Edicao: </b>{{$livro->NumEdicao}}</li>
                <li><b>Volume: </b>{{$livro->NumVolume}}</li>
                <li><b>Autor: </b>{{$livro->autor->nome}}</li>
                <li><b>Genero: </b>{{$livro->genero->nome}}</li>
                <li><b>Editora: </b>{{$livro->editora->nome}}</li>
            </ul>
        </div>     
     </div>
</div>

@stop