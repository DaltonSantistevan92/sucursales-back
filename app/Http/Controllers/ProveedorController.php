<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    //
    public function get(){
        $proveedores = Proveedor::where('estado', 'A')->orderBy('razon_social')->get();
        $response = [];

        if (count($proveedores) > 0) {
            $response = [
                'estado' => true,
                'mensaje' => 'Existen datos',
                'proveedor' => $proveedores
            ];
        }else{
            $response = [
                'estado' => false,
                'mensaje' => 'No existen datos',
                'proveedor' => null
            ];
        }

        return response()->json($response);
    }
}
