@extends('Layout.principal') @section('title') Cadastrar Livros @endsection @section('content')


    <!--
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">

                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Endereço e Contato
                        </h4>
                    </div>
                </a>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </div>
                    </div>
</div>
-->
    <div class="poscentralized" style="margin-top:50px;">
        <div class="form-group" style="width:500px;">
            <form class="form-horizontal">
                <div class="group" align="center">
                <div class="form-group group1">
                    <label for="Titulo">Titulo</label>
                    <input id="Titulo" name="Titulo" class="form-control"/>

                    <label for="Ano">Ano</label>
                    <input id="Ano" name="Ano" class ="form-control"/>

                    <label for = "FotoCapa">Capa</label>
                    <input id="Fotocapa" name="FotoCapa" class="form-control"/>

                    <label for="NumeroPaginas">Numero de Páginas</label>
                    <input id="NumeroPaginas" name="Numeropaginas" class="form-control"/>
                    
                    <label for="IdAutor">Autor</label>
                    <input id="IdAutor" name="IdAutor" class="form-control"/>
                    
                    <label for="IdEditora">Editora</label>
                    <input id="IdEditora" name="IdEditora" class="form-control"/>
                </div>
                 
                <div class="form-group group2">
                    <label for="CDU">CDU</label>
                    <input id="CDU" name="CDU" class="form-control">

                    <label for="CDD">CDD</label>
                    <input id="CDD" name="CDD" class="form-control">

                    <label for="ISBN">ISBN</label>
                    <input id="ISBN" name="ISBN" class="form-control"/>

                    <label for="NumEdicao">Nº da edição</label>
                    <input id="NumEdicao" name="NumEdicao" class="form-control"/>
            
                    <label for="NumVolume">Volume</label>
                    <input id="NumVolume" name="NumVolume" class="form-control"/>
                    
                    <label for="IdGenero">Genero</label>
                    <input id="IdGenero" name="IdGenero" class="form-control"/>
                </div>
                <input type="submit" class="btn btn-success "value="Concluir"/>
           </div>
                    </form>
        </div>
    </div>
        
    @stop
