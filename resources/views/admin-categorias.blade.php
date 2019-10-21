@extends('layouts.admin')
@section('title', 'Categorias')
@section('CA','class=active')
@section('box')

    <div class="col-md-9">
        <div class="box">
            <h1>Categorias</h1>
            <p class="lead">Agrega, edita o elimina cualquiera de las categorias.</p>
            <!--<p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>-->



            <div class="table-responsive" id="basket">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Categoria</th>
                        <th></th>
                        <th colspan="2"></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($categoria as $t)

                        <tr>

                            <td>{{$t->descripcion}}</td>

                            <td>
                                <a href="{{route('eliminar-categoria', $t->id)}}"><i class="fa fa-trash-o"></i></a>
                                <a><i class="fa fa-pencil" onclick="editar({{$t->id}})" data-toggle="modal" data-target="#modal"></i></a>
                            </td>
                        </tr>

                        <tr id="item-{{$t->id}}">

                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2"></td>
                        <td>
                            <a><i class="fa fa-plus" onclick="nuevo();" data-toggle="modal" data-target="#modal-nuevo"></i></a>
                        </td>
                    </tr>

                    </tbody>
                </table>
                <div class="pages">
                    {{$categoria}}
                </div>
            </div>
        </div>
    </div>
    <div id="modals">

    </div>
    <script>
        function editar(id) {
            //var txt = $("#detalles-"+id).text();

            $("#modals").empty();
            $("#modals").append(`
                    <div class="modal" id="modal" >
                        <div class="modal-dialog" role="dialog" tabindex="-1" aria-labelledby="windowTitleLabel">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3>Editar</h3>
                                </div>
                                <form action="{{route('editar-categoria')}}/`+id+`" enctype="multipart/form-data" method="get">
                                {{csrf_field()}}
                                    <div class="modal-body">

                                       <br>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Editar</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        </div>


                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
`);



            //console.log($("#detalles-"+id).text());


        }

        function nuevo() {
            //var txt = $("#detalles-"+id).text();

            $("#modals").empty();
            $("#modals").append(`
                    <div class="modal" id="modal-nuevo" >
                        <div class="modal-dialog" role="dialog" tabindex="-1" aria-labelledby="windowTitleLabel">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3>Editar</h3>
                                </div>
                                <form action="{{route('nuevo-categoria')}}" enctype="multipart/form-data" method="get">
                                {{csrf_field()}}
                                    <div class="modal-body">

                                        <br>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Crear</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
`);



            //console.log($("#detalles-"+id).text());


        }
    </script>
@endsection
