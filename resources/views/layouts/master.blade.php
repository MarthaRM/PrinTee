<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Obaju e-commerce template">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>
        Printee - @yield('title')
    </title>

    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="{{URL::to('css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{URL::to('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::to('css/animate.min.css')}}" rel="stylesheet">
    <link href="{{URL::to('css/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{URL::to('css/owl.theme.css')}}" rel="stylesheet">

    <!-- theme stylesheet -->
    <link href="{{URL::to('css/style.default.css')}}" rel="stylesheet" id="theme-stylesheet">


    <script src="{{URL::to('js/respond.min.js')}}"></script>

    <link rel="shortcut icon" href="{{URL::to('favicon.png')}}">


    <!-- your stylesheet with modifications -->
    <link href="{{URL::to('css/custom.css')}}" rel="stylesheet">



</head>

<body>

<!-- *** TOPBAR ***
_________________________________________________________ -->
<div id="top">
    <div class="container">
        <!--<div class="col-md-6 offer" data-animate="fadeInDown">
            <a href="#" class="btn btn-success btn-sm" data-animate-hover="shake">Offer of the day</a>  <a href="#">Get flat 35% off on orders over $50!</a>
        </div>-->
        <div class="col-md-6 col-md-offset-6" data-animate="fadeInDown">
            <ul class="menu">
                @if(Auth::check())
                    <li>
                        @if(Auth::user()->id_tipo ==2)
                            <a href="{{route('admin-productos')}}">{{Auth::user()->nombre}} {{Auth::user()->ap}} {{Auth::user()->am}}</a>
                            @else
                            <a href="#">{{Auth::user()->nombre}} {{Auth::user()->ap}} {{Auth::user()->am}}</a>
                        @endif
                    </li>

                    <li><a href="{{route('logout')}}">Cerrar Sesión</a>
                    </li>

                @else
                <li><a href="#" data-toggle="modal" data-target="#login-modal">Inicia Sesión</a>
                </li>
                <li><a href="{{route('register')}}">Registrate</a>
                </li>
                @endif
                <!--<li><a href="contact.html">Contacto</a>-->


            </ul>
        </div>
    </div>
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
        <div class="modal-dialog modal-sm">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="Login">Inicia Sesión</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('login')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="text" class="form-control" id="email-modal" name="email" placeholder="email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password-modal" name="password" placeholder="contraseña">
                        </div>

                        <p class="text-center">
                            <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Iniciar Sesión</button>
                        </p>

                    </form>

                    <p class="text-center text-muted">No tienes cuenta aún?</p>
                    <p class="text-center text-muted"><a href="{{route('register')}}"><strong>Registrate Ahora!</strong></a></p>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- *** TOP BAR END *** -->

<!-- *** NAVBAR ***
_________________________________________________________ -->

<div class="navbar navbar-default yamm" role="navigation" id="navbar">
    <div class="container">
        <div class="navbar-header">

            <a class="navbar-brand home" href="{{route('inicio')}}" data-animate-hover="bounce">
                <img src="{{URL::to('img/logo.png')}}" alt="Obaju logo" class="hidden-xs" style="width: 120px;">
                <img src="{{URL::to('img/logo.png')}}" alt="Obaju logo" class="visible-xs" style="width: 93px;"><span class="sr-only">Printee - ir a inicio</span>
            </a>
            <div class="navbar-buttons">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-align-justify"></i>
                </button>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                    <span class="sr-only">Toggle search</span>
                    <i class="fa fa-search"></i>
                </button>
                <a class="btn btn-default navbar-toggle" href="">
                    <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs">{{session()->has('cart') ?  session()->get('cart')->cantTotal : '' }}</span>
                </a>
            </div>
        </div>
        <!--/.navbar-header -->

        <div class="navbar-collapse collapse" id="navigation">

            <ul class="nav navbar-nav navbar-left">
                <li class="active"><a href="{{route('inicio')}}">Inicio</a>
                </li>
                @foreach($categorias as $categoria)
                    <li class="dropdown yamm-fw">
                        <a href="{{route('categoria', $categoria->id)}}" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">{{$categoria->descripcion}} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        @foreach($tipos as $tipo)
                                            @if($tipo->id_categoria == $categoria->id)
                                                <div class="col-sm-3">
                                                    <a href="{{route('tipo', $tipo->id)}}"><h5>{{$tipo->descripcion}}</h5></a>
                                                    <ul>
                                                        @foreach($subtipos as $subtipo)
                                                            @if($subtipo->id_tipo == $tipo->id)
                                                                <li><a href="{{route('subtipo', $subtipo->id)}}">{{$subtipo->descripcion}}</a>
                                                                </li>
                                                            @endif
                                                            @endforeach
                                                    </ul>
                                                </div>
                                                @endif
                                            @endforeach

                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
                    @endforeach


            </ul>

        </div>
        <!--/.nav-collapse -->

        <div class="navbar-buttons">

            <div class="navbar-collapse collapse right" id="basket-overview">
                <a href="{{route('carrito')}}" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm">{{session()->has('cart') ?  session()->get('cart')->cantTotal : '' }} </span></a>
            </div>
            <!--/.nav-collapse -->

            <div class="navbar-collapse collapse right" id="search-not-mobile">
                <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
                    <span class="sr-only">Toggle search</span>
                    <i class="fa fa-search"></i>
                </button>
            </div>

        </div>

        <div class="collapse clearfix" id="search">

            <form class="navbar-form" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar...">
                    <span class="input-group-btn">

			<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>

		    </span>
                </div>
            </form>

        </div>
        <!--/.nav-collapse -->

    </div>
    <!-- /.container -->
</div>
<!-- /#navbar -->

<!-- *** NAVBAR END *** -->



<div id="all">

    @yield('content')


    <!-- *** FOOTER ***
 _________________________________________________________ -->
        <div id="footer" data-animate="fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <!--<h4>Pages</h4>

                        <ul>
                            <li><a href="text.html">About us</a>
                            </li>
                            <li><a href="text.html">Terms and conditions</a>
                            </li>
                            <li><a href="faq.html">FAQ</a>
                            </li>
                            <li><a href="contact.html">Contact us</a>
                            </li>
                        </ul>

                        <hr>-->

                        <h4>Usuarios</h4>

                        <ul>
                            <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                            </li>
                            <li><a href="{{route('register')}}">Registro</a>
                            </li>
                        </ul>

                        <hr class="hidden-md hidden-lg hidden-sm">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Categorias</h4>
                        @foreach($categorias as $categoria)
                            <h5><a href="{{route('categoria', $categoria->id)}}">{{$categoria->descripcion}} </a></h5>
                            <ul>
                                @foreach($tipos as $tipo)
                                    @if($tipo->id_categoria == $categoria->id)
                                        <li><a href="{{route('tipo', $tipo->id)}}">{{$tipo->descripcion}}</a>
                                        </li>
                                    @endif
                                @endforeach

                            </ul>
                        @endforeach




                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Donde encontrarnos</h4>

                        <p><strong>PrinTee</strong>
                            <br>#00 Avenida
                            <br>Ciudad
                            <br>CP
                            <br>Estado
                            <br>
                            <strong>Pais</strong>
                        </p>

                        <!--<a href="contact.html">Go to contact page</a>-->

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->



                    <div class="col-md-3 col-sm-6">

                        <!--<h4>Get the news</h4>

                        <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

                        <form>
                            <div class="input-group">

                                <input type="text" class="form-control">

                                <span class="input-group-btn">

                                    <button class="btn btn-default" type="button">Subscribe!</button>

                                </span>

                            </div>
                            <!-- /input-group
                        </form>-->

                        <hr>

                        <h4>Permanece conectado</h4>

                        <p class="social">
                            <a href="#" class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="instagram external" data-animate-hover="shake"><i class="fa fa-instagram"></i></a>
                            <a href="#" class="gplus external" data-animate-hover="shake"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="email external" data-animate-hover="shake"><i class="fa fa-envelope"></i></a>
                        </p>


                    </div>
                    <!-- /.col-md-3 -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#footer -->

        <!-- *** FOOTER END *** -->




        <!-- *** COPYRIGHT ***
 _________________________________________________________ -->
        <div id="copyright">
            <div class="container">
                <div class="col-md-6">
                    <p class="pull-left">© 2018 María Fernanda Peruyero Núñez & Martha Elena Rodríguez Medina.</p>

                </div>
                <div class="col-md-6">
                    <p class="pull-right">Template by <a href="https://bootstrapious.com/e-commerce-templates">Bootstrapious</a> & <a href="https://fity.cz">Fity</a>
                        <!-- Not removing these links is part of the license conditions of the template. Thanks for understanding :) If you want to use the template without the attribution links, you can do so after supporting further themes development at https://bootstrapious.com/donate  -->
                    </p>
                </div>
            </div>
        </div>
        <!-- *** COPYRIGHT END *** -->



</div>
<!-- /#all -->




<!-- *** SCRIPTS TO INCLUDE ***
_________________________________________________________ -->

<script src="{{URL::to('js/jquery-1.11.0.min.js')}}"></script>
<script src="{{URL::to('js/bootstrap.min.js')}}"></script>
<script src="{{URL::to('js/jquery.cookie.js')}}"></script>
<script src="{{URL::to('js/waypoints.min.js')}}"></script>
<script src="{{URL::to('js/modernizr.js')}}"></script>
<script src="{{URL::to('js/bootstrap-hover-dropdown.js')}}"></script>
<script src="{{URL::to('js/owl.carousel.min.js')}}"></script>
<script src="{{URL::to('js/front.js')}}"></script>




</body>

</html>