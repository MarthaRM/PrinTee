<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Colores;
use App\DetallesImg;
use App\Imagenes;
use App\Productos;
use App\Subtipos;
use App\TiposProductos;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    public function getCategoria($id)
    {
        $categorias = Categorias::all();
        $tipos = TiposProductos::all();
        $subtipos = Subtipos::all();

        $idss = TiposProductos::select('id')->where('id_categoria', '=', $id)->get();
        $idst = Subtipos::select('id')->whereIn('id_tipo', $idss)->get();
        $productos = Productos::whereIn('id_subtipo', $idst)->paginate(6);
        $categoria = $categorias->find($id);
        return view('categoria', compact('categorias', 'tipos', 'subtipos', 'categoria', 'productos'));
    }

    public function getTipo($id)
    {
        $categorias = Categorias::all();
        $tipos = TiposProductos::all();
        $subtipos = Subtipos::all();

        $tipo = $tipos->find($id);
        $categoria = $categorias->find($tipo->id_categoria);
        $ids = Subtipos::select('id')->where('id_tipo', '=', $id)->get();
        $productos = Productos::whereIn('id_subtipo', $ids)->paginate(6);

        $cant = Productos::whereIn('id_subtipo', $ids)->count();

        return view('tipo', compact('categorias', 'tipos', 'subtipos', 'categoria', 'tipo', 'productos'));
    }

    public function getSubtipo($id)
    {
        $categorias = Categorias::all();
        $tipos = TiposProductos::all();
        $subtipos = Subtipos::all();



        $subtipo = $subtipos->find($id);
        $tipo = $tipos->find($subtipo->id_tipo);
        $categoria = $categorias->find($tipo->id_categoria);
        $productos = Productos::where('id_subtipo', '=', $id)->paginate(6);
        return view('subtipo', compact('categorias', 'tipos', 'subtipos', 'categoria', 'tipo', 'subtipo', 'productos'));
    }

    public function getProducto($id)
    {
        $categorias = Categorias::all();
        $tipos = TiposProductos::all();
        $subtipos = Subtipos::all();

        $producto = Productos::all()->find($id);
        $subtipo = $subtipos->find($producto->id_subtipo);
        //return $producto;
        $tipo = $tipos->find($subtipo->id_tipo);
        $categoria = $categorias->find($tipo->id_categoria);
        //$productos = Productos::where('id_subtipo', '=', $id)->paginate(6);
        $img = DetallesImg::all()->where('id_producto', '=', $producto->id);
        return view('producto', compact('categorias', 'tipos', 'subtipos', 'categoria', 'tipo', 'subtipo', 'producto', 'img'));
    }

    public function editarProducto(Request $request, $id = null)
    {
        //$file = $request->file('img_ppl[]');
//        dd($file);
        $producto = Productos::all()->find($id);
        if($request->id_subtipo != 0)
            $producto->id_subtipo = $request->id_subtipo;

        if($request->precio != '')
            $producto->precio = $request->precio;

        if($request->descripcion != '')
            $producto->descripcion = $request->descripcion;

        if($request->detalles != '')
            $producto->detalles = $request->detalles;

        if($request->id_color != 0)
        {
            $producto->id_color = $request->id_color;
        }
        else
        {
            if($request->color_nombre != '' && $request->hex != '#ffffff')
            {
                $color = new Colores();
                $color->descripcion = $request->color_nombre;
                $color->hex = $request->hex;
                $color->save();
                $producto->id_color = $color->id;
            }
        }

        if($request->material != '')
            $producto->material = $request->material;

        if($request->talla != '')
            $producto->talla = $request->talla;
            //$producto->nombre_img = $file->getClientOriginalName();
        $producto->save();

        if($request->hasFile('img_1'))
        {
            $name = 'producto_'.$id.'.jpg';
            $request->file('img_1')->storeAs('productos', $name);
        }

        if($request->hasFile('img_2'))
        {
            $name = 'producto_'.$id.'_2.jpg';
            $request->file('img_2')->storeAs('productos', $name);
        }


        if($request->hasFile('img'))
            foreach ($request->file('img') as $img)
            {
                $img_ant = Imagenes::all()->last();
                $name = 'producto_'.$producto->id.'_detalle_'.($img_ant->id+1).'.jpg';
                $img_db = new Imagenes();
                $img_db->id_producto = $producto->id;
                $img_db->nombre_img = $name;
                $img_db->save();
                $img->storeAs('detalles', $name);

            }

        return redirect()->route('admin-productos');
    }

    public function crearProducto(Request $request)
    {
        $producto = new Productos();
        $producto->id_subtipo = $request->id_subtipo;
        $producto->precio = $request->precio;
        $producto->descripcion = $request->descripcion;
        $producto->detalles = $request->detalles;
        if($request->color_nombre != '' && $request->hex != '#ffffff')
        {
            $color = new Colores();
            $color->descripcion = $request->color_nombre;
            $color->hex = $request->hex;
            $color->save();
            $producto->id_color = $color->id;

        }
        else
            $producto->id_color = $request->id_color;

        $producto->material = $request->material;
        $producto->nombre_img = "temporal";
        $producto->talla = $request->talla;//$producto->nombre_img = $file->getClientOriginalName();
        $producto->save();

        $producto = Productos::all()->last();
        $name = 'producto_'.$producto->id.'.jpg';
        $request->file('img_1')->storeAs('productos', $name);

        $name = 'producto_'.$producto->id.'_2.jpg';
        $request->file('img_2')->storeAs('productos', $name);


        foreach ($request->file('img') as $img)
        {
            $img_ant = Imagenes::all()->last();
            if($img_ant != null)
                $name = 'producto_'.$producto->id.'_detalle_'.($img_ant->id+1).'.jpg';
            else
                $name = 'producto_'.$producto->id.'_detalle_1.jpg';
            $img_db = new Imagenes();
            $img_db->id_producto = $producto->id;
            $img_db->nombre_img = $name;
            $img_db->save();
            $img->storeAs('detalles', $name);

        }

        return redirect()->route('admin-productos');
    }

    public function eliminar($id)
    {
        $name = 'producto_'.$id.'.jpg';
        Storage::delete('productos/'.$name);

        $name = 'producto_'.$id.'_2.jpg';
        Storage::delete('productos/'.$name);

        $imagenes= Imagenes::all()->where('id_producto', '=', $id);
        foreach ($imagenes as $imagen)
        {
            Storage::delete('detalles/'.$imagen->nombre_img);
            $imagen->delete();
        }
        Productos::all()->find($id)->delete();
        return redirect()->route('admin-productos');
    }

    public function test(Request $request, $id)
    {
        //if($request->file('img_ppl')->isValid())

        //
        $name = 'producto_'.$id.'.jpg';
        return $request->file('img_ppl')->storeAs('productos', $name);
    }

    public function getImg($id)
    {
        //return Imagenes::all()->where('id_producto', '=', $id)->toJson();
        $img = array();
        $imagenes = Imagenes::all()->where('id_producto', '=', $id);
        foreach ($imagenes as $imagen) {
            array_push($img, $imagen);
        }
        return $img;
    }

    public function eliminarImg($id)
    {

        $imagen = Imagenes::all()->find($id);
        //return $imagen;
        $id_p = $imagen->id_producto;
        Storage::delete('dealles/'.$imagen->nombre_img);
        $imagen->delete();

        $img = array();
        $imagenes = Imagenes::all()->where('id_producto', '=', $id_p);
        foreach ($imagenes as $imagen) {
            array_push($img, $imagen);
        }
        return $img;
    }


}


