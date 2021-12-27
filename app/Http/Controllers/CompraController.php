<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    //

    public function create(Request $request){
        $compra = (object)$request->compra;
        $response = [];

        if($compra){
            $existeCompra = Compra::where('serie',$compra->serie)->get()->first();

            if($existeCompra){
                $response = [
                    'estado' => false,
                    'mensaje' => 'La serie de la compra ya existe',
                    'compra' => null
                ];
            }else{
                $nuevaCompra = new Compra();
                $nuevaCompra->usuario_id = intval($compra->usuario_id);
                $nuevaCompra->negocio_id = intval($compra->negocio_id);
                $nuevaCompra->status_id = 1;
                $nuevaCompra->serie = $compra->serie;
                $nuevaCompra->subtotal = floatval($compra->subtotal);
                $nuevaCompra->total =  floatval($compra->total);
                $nuevaCompra->iva =  floatval($compra->iva);
                $nuevaCompra->fecha = date('Y-m-d');
                $nuevaCompra->estado = 'A';

                if($nuevaCompra->save()){
                    $response = [
                        'estado' => true,
                        'mensaje' => 'La compra se ha guardado correctamente',
                        'compra' => $nuevaCompra 
                    ];
                }else{
                    $response = [
                        'estado' => false,
                        'mensaje' => 'La compra no se ha podido guardar',
                        'compra' => null 
                    ];
                }
            }
        }else{
            $response = [
                'estado' => false,
                'mensaje' => 'No hay datos para procesar',
                'compra' => null 
            ];
        }

        return response()->json($response);

    }




}
