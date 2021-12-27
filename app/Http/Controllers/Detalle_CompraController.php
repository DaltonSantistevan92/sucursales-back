<?php

namespace App\Http\Controllers;

use App\Models\Detalle_Compra;
use App\Models\Producto;
use Illuminate\Http\Request;

class Detalle_CompraController extends Controller
{
    //

    public function create(Request $request){
        $detallecompra = (array)$request->detallecompra;
        $response = [];
       
        if(is_array($detallecompra)){
            foreach($detallecompra as $dc){            
                $nuevo = new Detalle_Compra();
                $nuevo->compra_id = $dc['compra_id'];
                $nuevo->producto_id = $dc['producto_id'];
                $nuevo->cantidad = $dc['cantidad'];
                $nuevo->precio = $dc['precio'];
                $nuevo->total = $dc['total'];
                $nuevo->save();
            }
            $response = [
                'estado' => true,
                'mensaje' => 'Guardando'
            ];
        }else{
            $response = [
                'estado' => false,
                'mensaje' => 'no hay datos para procesar',
            ];
        }
        return response()->json($response);
    }







   

}
