
@extends('layouts.master')
@section('title', $subtipo->descripcion)
@section('content')
        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li>
                            <a href="{{route('inicio')}}">Inicio</a>
                        </li>

                        <li>
                            <a href="{{route('categoria', $categoria->id)}}">{{$categoria->descripcion}}</a>
                        </li>

                        <li>
                            <a href="{{route('tipo', $tipo->id)}}">{{$tipo->descripcion}}</a>
                        </li>

                        <li>{{$subtipo->descripcion}}</li>
                    </ul>
                </div>
                    <div class="box">
                        <h1>{{$subtipo->descripcion}}</h1>
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
                                    <h3><a href="{{route('producto', $producto->id)}}">{{$producto->descripcion}}</a></h3>
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


                    </div>
                    <!-- /.products -->

                    <div class="pages">
                        {{$productos}}
                    </div>


                </div>
                <!-- /.col-md-9 -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
@endsection

