<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NegocioController extends Controller{

    public function create(Request $request){
        $negocio = (object)$request->negocio;

        return response()->json($negocio);
    }
}
