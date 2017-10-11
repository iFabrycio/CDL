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
                <input id="iPesquisa" type=search class="form-control " value="{{old('Titulo')}}" placeholder="Digite o nome do livro aqui" name="Pesquisa" />
            </div>
            <div class="OptionArea">
                <label for="iSelect">Organizar por:</label>
            </div>
            <div class="OptionArea">
                <select class="form-control" name="organizar" id="iSelect">
                <option value="Titulo">Titulo</option>
                <option value="IdAutor">Autor</option>
                <option value="genero">Genero</option>
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

        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Genero</th>
                <th>Opções</th>
            </tr>
            @foreach($livro as $l)
            <tr>
                <td>{{$l->IdLivro}}</td>
                <td>{{$l->Titulo}}</td>
                <td>{{$l->autor->nome}}</td>
                <td>{{$l->genero->nome}}</td>
                <td>blah</td>
            </tr>
            @endforeach
            


        </table>
    </div>

</div>

<div class="poscentralized">
    <div class="alert alert-danger">Não foi possível achar o aluno</div>
</div>

<div class="poscentralized">
    <div class="alert alert-success">Alunos encontrados</div>
</div>

<div class="poscentralized">
    <div class="alert alert-success">Aluno encontrado</div>
</div>
@stop