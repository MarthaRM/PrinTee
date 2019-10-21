<?php

namespace App;


class Carrito
{
    public $articulos;
    public $cantTotal = 0;
    public $precioTotal = 0;
    public $idCliente;

    public function __construct($oldCart)
    {
        if($oldCart)
        {
            $this->articulos = $oldCart->articulos;
            $this->cantTotal = $oldCart->cantTotal;
            $this->precioTotal = $oldCart->precioTotal;
            $this->idCliente = $oldCart->idCliente;
        }
    }

    public function agregar($articulo, $id)
    {
        $storedItem = ['cant' => 0, 'precio' => $articulo->precio, 'item' => $articulo];
        if($this->articulos)
        {
            if(array_key_exists($id, $this->articulos))
            {
                $storedItem = $this->articulos[$id];
            }
        }
        $storedItem['cant']++;
        $storedItem['precio'] = $articulo->precio * $storedItem['cant'];
        $this->articulos[$id] = $storedItem;
        $this->cantTotal++;
        $this->precioTotal += $articulo->precio;
    }

    public function quitarUno($articulo, $id)
    {
        $storedItem = ['cant' => 0, 'precio' => $articulo->precio, 'item' => null];
        if($this->articulos)
        {
            if(array_key_exists($id, $this->articulos))
            {
                $storedItem = $this->articulos[$id];
            }
        }
        $storedItem['cant']--;
        $storedItem['precio'] = $articulo->precio * $storedItem['cant'];
        $this->articulos[$id] = $storedItem;
        $this->cantTotal--;
        $this->precioTotal -= $articulo->precio;
    }
}
