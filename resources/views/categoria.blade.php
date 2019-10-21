
@extends('layouts.master')
@section('title', $categoria->descripcion)
@section('content')
    <div id="content">
        <div class="container">

            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="{{route('inicio')}}">Inicio</a>
                    </li>

                    <li>
                        {{$categoria->descripcion}}
                    </li>
                </ul>
            </div>

            <div class="col-md-3">
                <!-- *** MENUS AND FILTERS ***
_________________________________________________________ -->
                <div class="panel panel-default sidebar-menu">

                    <div class="panel-heading">
                        <h3 class="panel-title">Categorías</h3>
                    </div>

                    <div class="panel-body">

                        <ul class="nav nav-pills nav-stacked category-menu">
                            @foreach($categorias as $c)
                                <li>
                                    <a href="{{route('categoria', $c->id)}}">{{$c->descripcion}}</a>
                                    <ul>
                                        @foreach($tipos as $t)
                                            @if($t->id_categoria == $c->id)

                                                <li><a href="{{route('tipo', $t->id)}}">{{$t->descripcion}}</a>
                                                </li>

                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach

                        </ul>

                    </div>
                </div>



                <!-- *** MENUS AND FILTERS END *** -->

                <div class="banner">
                    <a href="{{URL::to('subtipo', 2)}}">
                        <img src="{{URL::to('img/banners/vestidos.jpg')}}" alt="Vestidos" class="img-responsive">
                    </a>
                </div>
            </div>

            <div class="col-md-9">
                <div class="box">
                    <h1>{{$categoria->descripcion}}</h1>
                    <!--<p>In our Ladies department we offer wide selection of the best products we have found and carefully selected worldwide.</p>-->
                </div>



                <div class="row products">

                    @foreach($productos as $producto)
                        <div class="col-md-3 col-sm-4">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="{{route('producto', $producto->id)}}">
                                                <img src="{{URL::to('img/productos/producto_'.$producto->id.'.jpg')}}" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="{{route('producto', $producto->id)}}">
                                                <img src="{{URL::to('img/productos/producto_'.$producto->id.'_2.jpg')}}" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{route('producto', $producto->id)}}" class="invisible">
                                    <img src="{{URL::to('img/productos/producto_'.$producto->id.'.jpg')}}" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="{{route('producto', $producto->id)}}">Fur coat with very but very very long name</a></h3>
                                    <p class="price">$ {{$producto->precio}}</p>
                                    <p class="buttons">
                                        <a href="{{route('producto', $producto->id)}}" class="btn btn-default">Ver Detalles</a>
                                        <a href="{{route('agregar-al-carrito', $producto->id)}}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Agregar</a>
                                    </p>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>
                @endforeach
                    <!-- /.col-md-4 -->
                </div>
                <!-- /.products -->

                <div class="pages">


                    <ul class="pagination">
                        {{$productos}}
                    </ul>
                </div>


            </div>
            <!-- /.col-md-9 -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /#content -->
@endsection


