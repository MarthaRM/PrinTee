<?php

namespace App\Http\Controllers;

use App\Carrito;
use App\Categorias;
use App\Subtipos;
use App\TiposProductos;
use App\User;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function checkout(Request $request, $metodo)
    {

            if(!session()-> has('cart'))
            {
                return view('carrito');
            }
            $oldCart = session()->get('cart');
            $cart = new Carrito($oldCart);

            $user = User::find($request->userId);
            try {
                $response = $user->charge(($cart->precioTotal)*100, [
                    "currency" => "mxn",
                    "description" => "Compra en Printee",
                    "source" => $request->stripeToken,
                ]);
                session()->forget('cart');
                return redirect()->route('carrito');
            } catch (Exception $e) {
                //
            }

    }

    public function paypal()
    {
        session()->forget('cart');
        return redirect()->route('carrito');
    }

    public function checkout1()
    {
        $categorias = Categorias::all();
        $tipos = TiposProductos::all();
        $subtipos = Subtipos::all();

        $oldCart = session()->get('cart');
        $cart = new Carrito($oldCart);
        $articulos = $cart->articulos;
        $precioTotal = $cart->precioTotal;
        return view('checkout1', compact('articulos' , 'precioTotal', 'categorias', 'tipos', 'subtipos'));
    }
    public function checkout2()
    {
        $categorias = Categorias::all();
        $tipos = TiposProductos::all();
        $subtipos = Subtipos::all();

        $oldCart = session()->get('cart');
        $cart = new Carrito($oldCart);
        $articulos = $cart->articulos;
        $precioTotal = $cart->precioTotal;
        return view('checkout2', compact('articulos' , 'precioTotal', 'categorias', 'tipos', 'subtipos'));
    }

}
