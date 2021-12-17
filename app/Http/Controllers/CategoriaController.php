<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;


class CategoriaController extends Controller
{
    //
    public function createCategory(Request $request){
        $categoria = (object)$request->categoria;

        $detalle = ucfirst($categoria->detalle);
        $response = [];

        if($categoria){          
            $existeCategoria = Categoria::where('detalle', $detalle)->get()->first();
            
            if($existeCategoria){
                $response = [
                    'estado' => false,
                    'mensaje' => 'La categoria ya existe',
                    'categoria' => null
                ];
            }else{
                $nuevoCateroria = new Categoria();
                $nuevoCateroria->detalle = $detalle;
                $nuevoCateroria->estado = 'A';

                if($nuevoCateroria->save()){
                    $response = [
                        'estado' => true,
                        'mensaje' => 'La Categoria se ha guardado',
                        'categoria' => $nuevoCateroria
                    ];
                }else{
                    $response = [
                        'estado' => false,
                        'mensaje' => 'La Categoria no se puede guardar',
                        'categoria' => null
                    ];
                }   
            }         
        }else{
            $response = [
                'estado' => false,
                'mensaje' => 'No ahi datos para procesar',
                'categoria' => null
            ];
        }
        return response()->json($response);

    }

    public function get(){
        $categorias = Categoria::where('estado', 'A')->orderBy('detalle')->get();
        $response = [];

        if (count($categorias) > 0) {
            $response = [
                'estado' => true,
                'mensaje' => 'Existen datos',
                'categoria' => $categorias
            ];
        }else{
            $response = [
                'estado' => false,
                'mensaje' => 'No existen datos',
                'categoria' => null
            ];
        }

        return response()->json($response);
    }
}
