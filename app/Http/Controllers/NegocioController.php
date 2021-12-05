<?php

namespace App\Http\Controllers;

use App\Models\Negocio;
use Illuminate\Http\Request;

class NegocioController extends Controller{

    public function create(Request $request){
        $negocio = (object)$request->negocio;
        $response = [];

        if($negocio){
            $existNegocio = Negocio::where('nombre', $negocio->nombre)->first();

            if($existNegocio){  //Existe negocio con ese nombre
                $response = [
                    'estado' => false,
                    'mensaje' => 'Ya existe un negocio con ese nombre'
                ];
            }else{
                $new  = new Negocio();
                $new->tipo_negocio_id = $negocio->tipo_negocio_id;
                $new->tipo_empleo_id = $negocio->tipo_empleo_id;
                $new->empleado_id = $negocio->empleado_id;
                $new->seccion_id = $negocio->seccion_id;
                $new->nombre = ucfirst($negocio->nombre);
                $new->provincia_id = $negocio->provincia_id;
                $new->ciudad_id = $negocio->ciudad_id;
                $new->horario_id = $negocio->horario_id;
                $new->foto = "defualt-negocio.jpg";
                $new->ubicacion = ucfirst($negocio->ubicacion);
                $new->estado = 'A';
                $new->save();

                $response = [
                    'estado' => true,
                    'mensaje' => 'Se ha registrado un nuevo negocio'
                ];
            }
        }else{
            $response = [
                'estado' => false,
                'mensaje' => 'No hay datos para procesar'
            ];
        }

        return response()->json($response);
    }
}
