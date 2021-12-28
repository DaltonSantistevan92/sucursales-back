<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Detalle_Compra;
use Illuminate\Http\Request;

class CompraController extends Controller{

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

    public function get($negocio_id, $status_id, $year, $month){
        $compras = [];

        //Tdas las compras de todos los negocios de todos los estados
        if($negocio_id == 0 && $status_id == 0){
            $compras = Compra::whereYear('created_at', $year)->whereMonth('created_at', $month)
                ->orderBy('id', 'desc')->get();
        }else
        //Todas las compras de un negocio de todos los estados
        if($negocio_id > 0 && $status_id == 0){
            $compras = Compra::where('negocio_id', $negocio_id)->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('id', 'desc')->get();
        }else
        //Todas las compras de todos los negocios de un solo estado
        if($negocio_id == 0 && $status_id > 0){
            $compras = Compra::where('status_id', $status_id)->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('id', 'desc')->get();
        }else{
            //Todos las compras de un negocio y de un estado
            $compras = Compra::where('negocio_id', $negocio_id)->where('status_id', $status_id)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('id', 'desc')->get();
        }

        if($compras->count() > 0){
            for($i = 0; $i < $compras->count(); $i++){
                $elementos = Detalle_Compra::where('compra_id', $compras[$i]->id)->get();
                $compras[$i]['elementos'] = $elementos->count();

                $fecha = date("d/m/Y", strtotime($compras[$i]->fecha));
                $compras[$i]['fecha'] = $fecha;
            }
        }

        return response()->json($compras);
    }

    public function cantCompraEstado($negocio_id, $year, $month){
        $pendientes = 1;    $confirmados = 2;

        if($negocio_id == 0){
            $todos = Compra::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->orderBy('id', 'desc')->get();

            $cantPend = Compra::where('status_id', $pendientes)->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->orderBy('id', 'desc')->get();

            $cantConf = Compra::where('status_id', $confirmados)->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->orderBy('id', 'desc')->get();
        }else
        if($negocio_id > 0){
            $todos = Compra::where('negocio_id', $negocio_id)->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->orderBy('id', 'desc')->get();

            $cantPend = Compra::where('negocio_id', $negocio_id)->where('status_id', $pendientes)->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->orderBy('id', 'desc')->get();

            $cantConf = Compra::where('negocio_id', $negocio_id)->where('status_id', $confirmados)->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->orderBy('id', 'desc')->get();
        }

        $response = [
            'pendientes' => $cantPend->count(),
            'confirmados' => $cantConf->count(),
            'todos' => $todos->count()
        ];

        return response()->json($response);
    }
}
