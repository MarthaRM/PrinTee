@extends('layouts.admin')
@section('title', 'Productos')
@section('CP','class=active')
@section('box')

    <div class="col-md-9">
        <div class="box">
            <h1>Productos</h1>
            <p class="lead">Agrega, edita o elimina cualquiera de los productos.</p>
            <!--<p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>-->



            <div class="table-responsive" id="basket">
                <table class="table">
                    <thead>
                    <tr>
                        <th colspan="2">Producto</th>
                        <th>Detalles</th>
                        <th>Subtipo</th>
                        <th>Precio</th>
                        <th>Color</th>
                        <th>Talla</th>
                        <th>Material</th>
                        <th colspan="2"></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($productos as $producto)

                        <tr>
                            <td><img src="{{URL::to('img/productos/producto_'.$producto->id.'.jpg')}}" alt=""></td>
                            <td>{{$producto->descripcion}}</td>
                            <td id="detalles-{{$producto->id}}">{{$producto->detalles}}</td>
                            <td>{{$subtipos->find($producto->id_subtipo)->descripcion}}</td>
                            <td>${{$producto->precio}}</td>
                            <td>{{$colores->find($producto->id_color)->descripcion}}</td>
                            <td>{{$producto->talla}}</td>
                            <td>{{$producto->material}}</td>
                            <td>
                                <a href="{{route('eliminar-producto', $producto->id)}}"><i class="fa fa-trash-o"></i></a>
                                <a><i class="fa fa-pencil" onclick="editar({{$producto->id}})" data-toggle="modal" data-target="#modal"></i></a>
                            </td>
                        </tr>

                        <tr id="item-{{$producto->id}}">

                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="7"></td>
                        <td>
                            <a><i class="fa fa-plus" onclick="nuevo();" data-toggle="modal" data-target="#modal-nuevo"></i></a>
                        </td>
                    </tr>

                    </tbody>
                </table>
                <div class="pages">
                    {{$productos}}
                </div>
            </div>


        </div>
    </div>
    <div id="modals">

    </div>
    <script>
        function editar(id) {
            var imgDiv = "";
            //var txt = $("#detalles-"+id).text();
            $("#modals").empty();
            $("#modals").append(`
                    <div class="modal" id="modal" >
                        <div class="modal-dialog" role="dialog" tabindex="-1" aria-labelledby="windowTitleLabel">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3>Editar</h3>
                                </div>
                                <form action="{{route('editar-producto')}}/`+id+`" enctype="multipart/form-data" method="post">
                                {{csrf_field()}}
                                    <div class="modal-body">
                                        <div class="tabbable">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#tab1" data-toggle="tab">Detalles</a></li>
                                                <li><a href="#tab2" data-toggle="tab">Imagenes</a></li>
                                            </ul>
                                            <div class="tab-content" id="img-editar">

                                                <div class="tab-pane" id="tab2">

                                                    <div class="form-group">
                                                        <h4>Imagenes Principales</h4>
                                                        <div class="" id="frontal">
                                                            <h5>Imagen Frontal</h5>
                                                            <img src="{{URL::to('img/productos/producto_')}}`+id+'.jpg'+`" alt="">
                                                            <input type="file" class="form-control-file" id="img_1" name="img_1">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="" id="trasera">
                                                            <h5>Imagen Trasera</h5>
                                                            <img src="{{URL::to('img/productos/producto_')}}`+id+'_2.jpg'+`" alt="">
                                                            <input type="file" class="form-control-file" id="img_2" name="img_2">
                                                        </div>
                                                    </div>

                                                    <div id="img_detalle" class="form-group col-md-12">
                                                        <h4>Imagenes detalladas</h4>
                                                    </div>
                                                    <a><i class="fa fa-plus" onclick="addImg();"></i></a>

                                                </div>
                                                <div class="tab-pane active" id="tab1">
                                                    <br>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="detalles" name="detalles" placeholder="Detalles">
                                                    </div>
                                                    <div class="form-group">
                                                        <select id="id_subtipo" name="id_subtipo" class="form-control">
                                                            <option value=0>Subtipo</option>
                                                          @foreach($subtipos as $subtipo)
                                                            <option value="{{$subtipo->id}}">{{$subtipo->descripcion}}</option>
                                                          @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="number" id="precio" name="precio" class="form-control" placeholder="Precio">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <select id="id_color" name="id_color" class="form-control">
                                                            <option value=0>Color</option>
                                                            @foreach($colores as $colore)
                                                                <option value="{{$colore->id}}">{{$colore->descripcion}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <input type="text" id="color_nombre" name="color_nombre" class="form-control" placeholder="Nuevo Color">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <input type="color" id="hex" name="hex" class="form-control" value="#ffffff">
                                                    </div>
                                                    <div class="form-group">
                                                        <select id="talla" name="talla" class="form-control">
                                                            <option value="">Talla</option>
                                                            <option value="CH">CH</option>
                                                            <option value="M">M</option>
                                                            <option value="G">G</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="material" name="material" placeholder="Material">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Editar</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>




`);



            $.get('imagenes/'+id, function(res, sta){

                for(var i = 0;i < res.length;i++)
                {

                    $("#img_detalle").append(`
                        <div class="col-md-2">
                            <img src="{{URL::to('img/detalles/')}}`+'/'+res[i]['nombre_img']+`" alt="">
                            <a onclick="eliminarImg(`+res[i]['id']+`);"><i class="fa fa-trash-o"></i></a>
                        </div>`);
                }
            });


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
                                <form action="{{route('nuevo-producto')}}" enctype="multipart/form-data" method="post">
                                {{csrf_field()}}
                                    <div class="modal-body">
                                        <div class="tabbable">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#tab1" data-toggle="tab">Detalles</a></li>
                                                <li><a href="#tab2" data-toggle="tab">Imagenes</a></li>
                                            </ul>
                                            <div class="tab-content ">

                                                <div class="tab-pane" id="tab2">
                                                    <br>
                                                    <div class="form-group" id="img">
                                                        <label for="img_1">Imagen Frontal</label>
                                                        <input type="file" class="form-control-file" id="img_1" name="img_1" aria-describedby="fileHelp" required>
                                                        <small id="fileHelp" class="form-text text-muted">Esta es la imagen que aparecera en cada seccion del sitio.</small>
                                                    </div>

                                                    <div class="form-group" id="img">
                                                        <label for="img_2">Imagen Trasera</label>
                                                        <input type="file" class="form-control-file" id="img_2" name="img_2" aria-describedby="fileHelp" required>
                                                        <small id="fileHelp" class="form-text text-muted">Esta es la imagen que aparecera al posicionar el cursor sobre ka imaen frontal.</small>
                                                    </div>
                                                    <hr>
                                                    <div id="img_detalle">
                                                        <div class="form-group" id="img">
                                                            <label for="img[]">Imagen Detallada</label>
                                                            <input type="file" class="form-control-file" id="img[]" name="img[]" aria-describedby="fileHelp" required>
                                                            <small id="fileHelp" class="form-text text-muted">Estaimagen aparecera en los detalles del producto.</small>
                                                        </div>
                                                    </div>
                                                    <a><i class="fa fa-plus" onclick="img();"></i></a>

                                                </div>
                                                <div class="tab-pane active" id="tab1">
                                                    <br>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="detalles" name="detalles" placeholder="Detalles" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <select id="id_subtipo" name="id_subtipo" class="form-control" required>
                                                            <option value=0>Subtipo</option>
                                                          @foreach($subtipos as $subtipo)
                                                            <option value="{{$subtipo->id}}">{{$subtipo->descripcion}}</option>
                                                                                                  @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="number" id="precio" name="precio" class="form-control" placeholder="Precio" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <select id="id_color" name="id_color" class="form-control">
                                                                <option value=0>Color</option>
                                                                @foreach($colores as $colore)
                                                                    <option value="{{$colore->id}}">{{$colore->descripcion}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <input type="text" id="color_nombre" name="color_nombre" class="form-control" placeholder="Nuevo Color">
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <input type="color" id="hex" name="hex" class="form-control" value="#ffffff">
                                                        </div>
            <div class="form-group">
                <select id="talla" name="talla" class="form-control" required>
                    <option value=0>Talla</option>
                    <option value="CH">CH</option>
                    <option value="M">M</option>
                    <option value="G">G</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="material" name="material" placeholder="Material" required>
            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Crear</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
    </div>

</div>
</div>
</div>

</form>

</div>
</div>
</div>




`);



            //console.log($("#detalles-"+id).text());


        }

        function img() {
            $("#img_detalle").append(`
                <div class="form-group" id="img">
                    <label for="img[]">Imagen Detallada</label>
                    <input type="file" class="form-control-file" id="img[]" name="img[]" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Estaimagen aparecera en los detalles del producto.</small>
                </div>
            `);
        }

        function eliminarImg(id_img) {
            $.get('eliminar-img/'+id_img, function(res, sta){
                $("#img_detalle").empty();
                for(var i = 0;i < res.length;i++)
                {

                    $("#img_detalle").append(`
                        <div class="col-md-2">
                            <img src="{{URL::to('img/detalles/')}}`+'/'+res[i]['nombre_img']+`" alt="">
                            <a onclick="eliminarImg(`+res[i]['id']+`);"><i class="fa fa-trash-o"></i></a>
                        </div>`);
                }
            });
        }

        function addImg() {
            $("#img_detalle").append(`
                <div class="form-group" id="img">
                    <input type="file" class="form-control-file" id="img[]" name="img[]" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Estaimagen aparecera en los detalles del producto.</small>
                </div>
            `);
        }
    </script>
@endsection
