@extends('layouts.master')
@section('title', 'Pago')
@section('content')
        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{route('inicio')}}">Inicio</a>
                        </li>
                        <li>Checkout - Resumen</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">

                            <h1>Resumen</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="{{route('checkout1')}}"><i class="fa fa-map-marker"></i><br>Direccion</a>
                                </li>
                                <li class="active"><a><i class="fa fa-eye"></i><br>Resumen</a>
                                </li>
                            </ul>

                            <div class="content">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Descuento</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($articulos as $articulo)
                                            @if($articulo['cant']>0)
                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            <img src="{{URL::to('img/'.$articulo['item']['nombre_img'].'_square.jpg')}}" alt="">
                                                        </a>
                                                    </td>
                                                    <td><a href="#">{{$articulo['item']['descripcion']}}</a>
                                                    </td>
                                                    <td>{{$articulo['cant']}}</td>
                                                    <td>${{$articulo['item']['precio']}}</td>
                                                    <td>$0.00 editar</td>
                                                    <td>${{$articulo['item']['precio']*$articulo['cant']}}</td>

                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5">Total</th>
                                                <th>${{$precioTotal}}</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.content -->

                            <div class="box-footer">

                                <div class="pull-right">
                                    <form action="{{route('checkout')}}" method="POST" class="col-md-6">
                                        <script
                                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                data-key="pk_test_hTNCGjanBSugz51966XFJMjr"
                                                data-amount="{{$precioTotal*100}}"
                                                data-name="Paga con Tarjeta"
                                                data-description=""
                                                data-image="{{URL::to('favicon.png')}}"
                                                data-locale="auto">
                                        </script>
                                        <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                                        {{csrf_field()}}
                                    </form>

                                    <div id="paypal-button" class="col-md-6"></div>

                                </div>
                            </div>

                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col-md-9 -->

                <div class="col-md-3">

                    <div class="box" id="order-summary">
                        <div class="box-header">
                            <h3>Resumen</h3>
                        </div>
                        <!--<p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>-->

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <th>${{$precioTotal}}</th>
                                </tr>
                                <tr>
                                    <td>Envio</td>
                                    <th>$0.00</th>
                                </tr>
                                <tr>
                                    <td>IVA</td>
                                    <th>$0.00</th>
                                </tr>
                                <tr class="total">
                                    <td>Total</td>
                                    <th>${{$precioTotal}}</th>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        var total = {{$precioTotal}};

        paypal.Button.render({
            env: 'sandbox', // sandbox | production

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                sandbox:    'AQjLLsVXwImiMpkvLu2mfmZmNQ50J0umWMaBVZZSvj1eeoroeShTWDAh-8SycMFLx-OfPaQ7VJftNZzW',
                production: ''
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {

                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: total.toFixed(2), currency: 'MXN' }//"'"+total.toFixed(2)+"'"
                            }
                        ]
                    }
                });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment
                return actions.payment.execute().then(function() {
                    window.location = '{{route('paypal')}}';
                });
            }
        }, '#paypal-button');
    </script>
@endsection
