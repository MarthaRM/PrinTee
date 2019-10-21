@extends('layouts.admin')
@section('title', 'Subtipos')
@section('CS','class=active')
@section('box')

    <div class="col-md-9">
        <div class="box">
            <h1>Subtipos</h1>
            <p class="lead">Agrega, edita o elimina cualquiera de los subtipos.</p>
            <!--<p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>-->



            <div class="table-responsive" id="basket">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Subtipo</th>
                        <th>Tipo</th>
                        <th></th>
                        <th colspan="2"></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($subtipo as $s)

                        <tr>

                            <td>{{$s->descripcion}}</td>

                            <td>{{$tipos->find($s->id_tipo)->descripcion}}</td>

                            <td>
                                <a href="{{route('eliminar-subtipo', $s->id)}}"><i class="fa fa-trash-o"></i></a>
                                <a><i class="fa fa-pencil" onclick="editar({{$s->id}})" data-toggle="modal" data-target="#modal"></i></a>
                            </td>
                        </tr>

                        <tr id="item-{{$s->id}}">

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
                    {{$subtipo}}
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
                                <form action="{{route('editar-subtipo')}}/`+id+`" enctype="multipart/form-data" method="get">
                                {{csrf_field()}}
                                    <div class="modal-body">

                                       <br>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion">
                                        </div>

                                        <div class="form-group">
                                            <select id="id_tipo" name="id_tipo" class="form-control">
                                                <option value=0>Tipo</option>
                                              @foreach($tipos as $tipo)
                                                <option value="{{$tipo->id}}">{{$tipo->descripcion}}</option>
                                              @endforeach
                                            </select>
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
                                <form action="{{route('nuevo-subtipo')}}" enctype="multipart/form-data" method="get">
                                {{csrf_field()}}
                                    <div class="modal-body">

                                        <br>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion" required>
                                        </div>

                                        <div class="form-group">
                                            <select id="id_tipo" name="id_tipo" class="form-control" required>
                                                <option value=0>Subtipo</option>
                                              @foreach($tipos as $tipo)
                                                <option value="{{$tipo->id}}">{{$tipo->descripcion}}</option>
                                              @endforeach
                                            </select>
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
