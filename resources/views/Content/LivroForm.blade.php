@extends('Layout.principal') @section('title') Cadastrar Livros @endsection

@section('back')
<a href="/cadastro">
    Voltar
</a>
@endsection

@section('content')


    @foreach ($errors ->all() as $error)
<div class="poscentralized">
    <div class="alert alert-danger widthed" align="center">{{$error}}
    </div>
</div>
    @endforeach

    <div class="poscentralized" style="margin-top:50px;">
        
        <div class="form-group" style="width:500px;">
            <form class="form-horizontal" method="post" action="{{ url('/cadastro/Livro/Submit') }}">
                
                {{ csrf_field() }}
                
                <div class="group" align="center">
                <div class="form-group group1">
                    <label for="Titulo">Titulo</label>
                    <input id="Titulo" name="Titulo" class="form-control"  value="{{    old('Titulo')   }}" />

                    <label for="Ano">Ano</label>
                    <input id="Ano" name="Ano" class="form-control" value="{{ old('Ano') }}"/>

                    <label for = "FotoCapa">Capa</label>
                    <input id="Fotocapa" name="FotoCapa" class="form-control"  value="{{ old('FotoCapa') }}" />

                    <label for="NumeroPaginas">Numero de Páginas</label>
                    <input id="NumeroPaginas" name="NumeroPaginas" class="form-control"  value="{{ old('NumeroPaginas') }}" />
                    
                    <label class="form-control-label" for="iAutor">Autor:</label>
                    <select class="form-control selectpicker" name="IdAutor" id="iAutor">
                        <option value="">Selecione um Autor</option>
                        @foreach ($autores as $autor)
                        <option value="{{ $autor->IdAutor }}">{{ $autor->nome }}</option>
                        @endforeach
                        
                    </select>
                    
                    <label class ="form-control-label" for="iGenero">Genero:</label>
                    <select class="form-control" name="IdGenero" id="iGenero">
                        <option value="">Selecione um Genero</option>
                    @foreach($genero as $genero)
                        <option value="{{$genero->IdGenero}}">{{$genero->nome}}</option>
                        @endforeach
                    </select>
                    
                    
                </div>
                 
                <div class="form-group group2">
                    <label for="CDU">CDU</label>
                    <input id="CDU" name="CDU" class="form-control"  value="{{ old('CDU') }}">

                    <label for="CDD">CDD</label>
                    <input id="CDD" name="CDD" class="form-control"  value="{{ old('CDD') }}">

                    <label for="ISBN">ISBN</label>
                    <input id="ISBN" name="ISBN" class="form-control"  value="{{ old('ISBN') }}"/>

                    <label for="NumEdicao">Nº da edição</label>
                    <input id="NumEdicao" name="NumEdicao" class="form-control"  value="{{ old('NumEdicao') }}"/>
            
                    <label for="NumVolume">Volume</label>
                    <input id="NumVolume" name="NumVolume" class="form-control"  value="{{ old('NumVolume') }}"/>
                    
                       <label class="form-control-label" for="iEditora">Editora:</label>
                    <select class="form-control" name="IdEditora" id="iEditora">
                        <option value="">Selecione uma editora</option>
                        @foreach ($editora as $editor)
                        <option value="{{ $editor->IdEditora }}">{{ $editor->nome }}</option>
                        @endforeach
                    </select>
                    
                </div>
                <input type="submit" class="btn btn-success "value="Concluir"/>
                </div>
            
                    </form>
        </div>
    </div>
<div class="divider">
    <hr/>
</div>
<div class="container poscentralized">
    <div class="row">
        @if (Session::has('mensagem'))
        <div class="alert alert-success">
            <a href="#" class="close" aria-label="close" data-dismiss="alert">&times;</a>
            {{ Session::get('mensagem') }}
        </div>
        @endif
        <div>
            <section align="center">
        <div class="withed" style="display:inline-block; margin-right:50px;">            
            <form class="form-horizontal" method="post" action="{{ route('autor.cadastrar') }}">
                
                {{ csrf_field() }}
                
                <div class="form-group">
                    <label class="form-control-label" for="i_nome-autor">
                        Nome do autor:
                    </label>
                    <input required class="form-control" name="nome" value="{{ old('nome') }}" id="i_nome-autor"/>
                </div>
                
                <div class="form-group">
                    <button class="btn btn-success" type="submit">
                        <i class="fa fa-save"></i> Cadastrar autor
                    </button>
                </div>
            </form>
        </div>
        
        <div style="display:inline-block;" class="withed">            
            <form class="form-horizontal" method="post" action="{{ route('editora.cadastrar') }}">
                
                {{ csrf_field() }}
                
                <div class="form-group">
                    <label class="form-control-label" for="i_nome-editora">
                        Nome da editora:
                    </label>
                    <input required class="form-control" name="nome" value="{{ old('nome') }}" id="i_nome-editora"/>
                </div>
                
                <div class="form-group">
                    <button class="btn btn-success" type="submit">
                        <i class="fa fa-save"></i> Cadastrar editora
                    </button>
                </div>
            </form>
        </div>
        
        <div class="withed" style="display:inline-block; margin-left:50px;">            
            <form class="form-horizontal" method="post" action="{{ route('genero.cadastrar') }}">
                
                {{ csrf_field() }}
                
                <div class="form-group">
                    <label class="form-control-label" for="i_nome-genero">
                        Nome do genero:
                    </label>
                    <input required class="form-control" name="nome" value="{{ old('nome') }}" id="i_nome-genero"/>
                </div>
                
                <div class="form-group">
                    <button class="btn btn-success" type="submit">
                        <i class="fa fa-save"></i> Cadastrar genero
                    </button>
                </div>
            </form>
        </div>
            
            </section>
        </div>
</div>
</div>
<br/>
<br/>
<br/>
<br/>
<br/>
        
    @stop
