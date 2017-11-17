@extends('Layout.principal') @section('back')
<a href="/home">
    Voltar
</a> @endsection @section('title') Configurações @endsection @section('content')



<div class="poscentralized">

    <div class="config-menu ">
        <form class=" form form-group" action="{{action('AdminController@SetupDias')}}" method="get">
            <label>
<h3>Definir tempo de multa padrão:</h3>
    </label>

            <table class="table table-default" style="width:485px;">
                <tr>
                    <td>
                        <p>Numero de dias atrasados X</p>
                    </td>
                    <td>
                        <input name="Dias" class=" form form-control" type="number" min="1" max="10" style="width:80px; " />
                        <td>
                            <input class="btn btn-success" value="Definir" type="submit" />
                        </td>
                        <td>
                            <label class="label label-info">Definido Atualmente: {{$config->DiasMulta}}</label>
                        </td>
                </tr>
            </table>

        </form>

    </div>

</div>
@stop