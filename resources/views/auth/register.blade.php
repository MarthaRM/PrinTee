
@extends('layouts.master')

@section('content')
        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>Registrarse / Iniciar Sesion</li>
                    </ul>

                </div>

                <div class="col-md-6">
                    <div class="box">
                        <h1>Nueva Cuenta</h1>

                        <p class="lead">¿Aun no eres cliente?</p>
                        <p>Si tienes una cuenta con nostros podras comprar una gran variedad de ropa, accesorios y calzado! Registrarte no tardara ni un minuto!</p>

                        <hr>

                        <form action="{{route('register')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" value="1" name="id_tipo">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre"  name="nombre">
                            </div>
                            <div class="form-group">
                                <label for="ap">Apellido Paterno</label>
                                <input type="text" class="form-control" id="ap"  name="ap">
                            </div>
                            <div class="form-group">
                                <label for="am">Apellido Materno</label>
                                <input type="text" class="form-control" id="am"  name="am">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion</label>
                                <input type="text" class="form-control" id="direccion"  name="direccion">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control" id="telefono"  name="telefono">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i> Registrate</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box">
                        <h1>Iniciar Sesion</h1>

                        <p class="lead">¿Ya eres cliente?</p>
                        <hr>

                        <form action="{{route('login')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Inicia Sesion</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
@endsection
