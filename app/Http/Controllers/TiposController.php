<?php

namespace App\Http\Controllers;

use App\Productos;
use App\Subtipos;
use App\TiposProductos;
use Illuminate\Http\Request;

class TiposController extends Controller
{
    public function editar(Request $request, $id = null)
    {
        //$file = $request->file('img_ppl[]');
//        dd($file);
        $producto = TiposProductos::all()->find($id);
        if($request->id_categoria != 0)
            $producto->id_categoria = $request->id_categoria;

        if($request->descripcion != '')
            $producto->descripcion = $request->descripcion;

        //$producto->nombre_img = $file->getClientOriginalName();
        $producto->save();

        return redirect()->route('admin-tipos');
    }

    public function crear(Request $request)
    {
        $subtipo = new TiposProductos();
        $subtipo->id_categoria = $request->id_categoria;
        $subtipo->descripcion = $request->descripcion;
        $subtipo->save();
        return redirect()->route('admin-tipos');
    }

    public function eliminar($id)
    {
        $tipo = TiposProductos::all()->find($id);
        $subtipos = Subtipos::all()->where('id_tipo', '=', $tipo->id);
        foreach ($subtipos as $subtipo)
        {
            $productos = Productos::all()->where('id_subtipo', '=', $subtipo->id);
            foreach ($productos as $producto)
                $producto->delete();
            $subtipo->delete();
        }

        $tipo->delete();
        return redirect()->route('admin-tipos');
    }
}
