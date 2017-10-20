@extends('Layout.principal')
@section('title')
Lista de Livros
@endsection
@section('back')
<a href="/lista/menu">
    Voltar
</a>
@endsection
@section('content')
<div class="poscentralized">

    <fieldset class="">
        <form class="form-group optionsMenu" method="get" action="/lista/Livro">
            <div class="OptionArea">
                <label for="iPesquisa">Pesquisar livro:</label>
            </div>
            <div class="OptionArea">
                <input id="iPesquisa" type=search class="form-control " value="{{old('Titulo')}}" placeholder="Digite aqui" name="Pesquisa" />
            </div>
            <div class="OptionArea">
                <label for="iSelect">Organizar por:</label>
            </div>
            <div class="OptionArea">
                <select class="form-control" name="organizar" id="iSelect">
                <option value="Titulo">Titulo</option>
                <option value="IdAutor">Autor</option>
                <option value="IdGenero">Genero</option>
                </select>
            </div>
            <div class="OptionArea">
                <input type="submit" class="btn btn-success" value="Organizar" />
            </div>
        </form>
    </fieldset>
</div>

<div class="poscentralized">

    <div class="">

        <table class="table table-striped table-responsive">
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Genero</th>
                <th>Código do livro</th>
                <th>Opções</th>
            </tr>
            @foreach($livro as $l)
            <tr>
                <td>{{$l->IdLivro}}</td>
                <td>{{$l->Titulo}}</td>
                <td>{{$l->autor->nome}}</td>
                <td>{{$l->genero->nome}}</td>
                <td>{{$l->codLivro}}</td>
                <td>
                <a href="{{action('LivroController@RemoveLivro',$l->IdLivro)}}"><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a>
               &nbsp; 
                <a href="{{action('LivroController@DetailLivro',$l->IdLivro)}}">
                    <i class="fa fa-info fa-2x" aria-hidden="true"></i></a>
                </td>
            </tr>
            @endforeach
            


        </table>
    </div>

</div>
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
@stop