
@extends('layouts.master')
@section('title', $producto->descripcion)
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

                        <li>
                            <a href="{{route('tipo', $subtipo->id)}}">{{$subtipo->descripcion}}</a>
                        </li>
                        <li>
                            {{$producto->descripcion}}
                        </li>
                    </ul>

                </div>

                <div class="col-md-12">

                    <div class="row" id="productMain">
                        <div class="col-sm-5">
                            <div id="mainImage">
                                <img src="{{URL::to('img/productos/producto_'.$producto->id.'.jpg')}}" alt="" class="img-responsive">
                            </div>

                        </div>
                        <div class="col-sm-7">
                            <div class="box">
                                <h1 class="text-center">{{$producto->descripcion}}</h1>
                                <p class="goToDescription"><a href="#details" class="scroll-to">Desliza para ver mas detalles</a>
                                </p>
                                <p class="price">${{$producto->precio}}</p>

                                <p class="text-center buttons">
                                    <a href="{{route('agregar-al-carrito', $producto->id)}}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Agregar al carrito</a>
                                </p>


                            </div>

                            <div class="row" id="thumbs">
                                @foreach($img as $i)
                                    <div class="col-xs-4 thumbs-prod">
                                        <a href="{{URL::to('img/detalles/'.$i->nombre_img)}}" class="thumb">
                                            <img src="{{URL::to('img/detalles/'.$i->nombre_img)}}" alt="" class="img-responsive">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>


                    <div class="box" id="details">
                        <p>
                            <h4>Detalles del Producto</h4>
                            <p>{{$producto->detalles}}</p>
                            <h4>Material</h4>
                            <ul>
                                <li>{{$producto->material}}</li>
                            </ul>
                            <h4>Talla</h4>
                            <ul>
                                <li>{{$producto->talla}}</li>
                            </ul>

                            <!--<blockquote>
                                <p><em>Define style this season with Armani's new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.</em>
                                </p>
                            </blockquote>-->

                    </div>

                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
@endsection
