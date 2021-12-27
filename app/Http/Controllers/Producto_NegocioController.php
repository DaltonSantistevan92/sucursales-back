<?php

namespace App\Http\Controllers;

use App\Models\Negocio;
use App\Models\Producto_Negocio;


use Illuminate\Http\Request;

class Producto_NegocioController extends Controller{

    public function getProductoByNegocio($negocio_id,$categoria_id,$estado){
        $response = [];   $aux = [];
        $estado = strtoupper($estado);
        $negocioExiste = Negocio::find($negocio_id);

        if($negocioExiste){
            $proNeg = Producto_Negocio::select('producto_id','stock')->where('negocio_id',$negocio_id)->get();
            if($categoria_id > 0){
                if($proNeg->count() > 0){
                    foreach($proNeg as $p){
                        $producto = $p->producto;
                         if($producto->categoria_id == $categoria_id && $producto->estado == $estado){
                             $aux[] = $p;
                         }
                    }
                    $response = $aux;
                }
            }else
            if($categoria_id == 0){
                if($proNeg->count() > 0){
                    foreach($proNeg as $p){
                        $producto = $p->producto;
                        if($producto->estado == $estado){
                            $aux[] = $p;
                        }
                    }
                    $response = $aux;
                }
            }
        }
        if(count($aux) > 0 ){
            foreach($response as $a){
                $a->producto->categoria;
            }
        }
        return response()->json($response);
    }
        



}