
@extends('layouts.master')
@section('title', 'Inicio')
@section('content')
        <div id="content">

            <div class="container">
                <div class="col-md-12">
                    <div id="main-slider">
                        <div class="item">
                            <img src="{{URL::to('img/banners/main-slider-1.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="{{URL::to('img/banners/main-slider-2.jpg')}}" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="{{URL::to('img/banners/main-slider-3.jpg')}}" alt="">
                        </div>
                    </div>
                    <!-- /#main-slider -->
                </div>
            </div>

            <!-- *** ADVANTAGES HOMEPAGE ***
 _________________________________________________________ -->
            <div id="advantages">

                <div class="container">
                    <div class="same-height-row">
                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-heart"></i>
                                </div>

                                <h3><a>AMAMOS A NUESTROS CLIENTES</a></h3>
                                <p>PrinTee ofrece los mejor de si para que sus clientes tengan la mejor experiencia de compra en linea.</p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-tags"></i>
                                </div>

                                <h3><a>LOS MEJORES PRECIOS</a></h3>
                                <p>Tenemos los mejores precios que se ofrecen en el mercado.</p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-thumbs-up"></i>
                                </div>

                                <h3><a href="#">LA MEJOR CALIDAD</a></h3>
                                <p>Te ofrecemos la mejor calidad en cada uno de nuestros productos.</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container -->

            </div>
            <!-- /#advantages -->

            <!-- *** ADVANTAGES END *** -->

            <!-- *** HOT PRODUCT SLIDESHOW ***
 _________________________________________________________ -->
            <div id="hot">

                <div class="box">
                    <div class="container">
                        <div class="col-md-12">
                            <h2>Lo Mas Nuevo</h2>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="product-slider">
                        @foreach($productos as $producto)
                            <div class="item">
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
                                    <div class="ribbon new">
                                        <div class="theribbon">NUEVO</div>
                                        <div class="ribbon-background"></div>
                                    </div>
                                    <div class="text">
                                        <h3><a href="{{route('producto', $producto->id)}}">{{$producto->descripcion}}</a></h3>
                                        <p class="price">${{$producto->precio}}</p>
                                    </div>
                                    <!-- /.text -->
                                </div>
                                <!-- /.product -->
                            </div>
                        @endforeach

                    </div>
                    <!-- /.product-slider -->
                </div>
                <!-- /.container -->

            </div>
            <!-- /#hot -->

            <!-- *** HOT END *** -->

            <!-- *** GET INSPIRED ***
 _________________________________________________________ -->
            <div class="container" data-animate="fadeInUpBig">
                <div class="col-md-12">
                    <div class="box slideshow">
                        <h3>Descrube PrinTee</h3>
                        <p class="lead">Descubre lo nuevo de PrinTee</p>
                        <div id="get-inspired" class="owl-carousel owl-theme">
                            <div class="item">
                                <a href="{{route('categoria', 2)}}">
                                    <img src="{{URL::to('img/banners/nueva-colec-h.jpg')}}" alt="Hombres" class="img-responsive">
                                </a>
                            </div>
                            <div class="item">
                                <a href="{{route('subtipo',2)}}">
                                    <img src="{{URL::to('img/banners/vestidos.jpg')}}" alt="Get inspired" class="img-responsive">
                                </a>
                            </div>
                            <div class="item">
                                <a href="{{route('categoria', 1)}}">
                                    <img src="{{URL::to('img/banners/nueva-colec-m.jpg')}}" alt="Get inspired" class="img-responsive">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- *** GET INSPIRED END *** -->


        </div>
        <!-- /#content -->
@endsection