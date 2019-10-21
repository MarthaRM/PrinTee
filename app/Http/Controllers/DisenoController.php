<?php

namespace App\Http\Controllers;

use App\Diseños;
use App\ElementosDiseño;
use Illuminate\Http\Request;

class DisenoController extends Controller
{
    public function delete($id)
    {

        $diseno = Diseños::destroy($id);
        //dd($diseno);
        return redirect()->route('inicio');
    }
}
