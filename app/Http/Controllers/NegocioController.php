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
            $existEmpleado = Negocio::where('empleado_id', $negocio->empleado_id)->first();

            if($existNegocio){  //Existe negocio con ese nombre
                $response = [
                    'estado' => false,
                    'mensaje' => 'Ya existe un negocio con ese nombre'
                ];
            }else
            if($existEmpleado){
                $response = [
                    'estado' => false,
                    'mensaje' => 'El empleado ya tiene asignado un negocio !!'
                ];
            }
            else{
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

    public function get(){
        $negocios = Negocio::where('estado', 'A')->orWhere('estado', 'I')->orderBy('nombre', 'asc')->get();
        $response = [];

        if($negocios->count() > 0){
            foreach($negocios as $n){
                $n->tipoNegocio;
                $n->tipoEmpleo;
                $n->empleado->persona;
                $n->empleado->usuario;
                $n->provincia;
                $n->ciudad;
                $n->horario;
                $n->seccion;
            }

            $response = [
                'cantidad' => $negocios->count(),
                'data' => $negocios
            ];
        }else{
            $response = [
                'cantidad' => 0,
                'data' => []
            ];
        }

        return response()->json($response);
    }

    public function find($id){
        $negocio = Negocio::find($id);

        if($negocio){
            $negocio->tipoNegocio;
            $negocio->tipoEmpleo;
            $negocio->empleado->persona;
            $negocio->empleado->usuario;
            $negocio->empleado->tipo_empleo;
            $negocio->provincia;
            $negocio->ciudad;
            $negocio->horario;
            $negocio->seccion;
        }else{
            $negocio = false;
        }

        return response()->json($negocio);
    }

    public function updateStatus(Request $request){
        $negocioData = (object)$request->negocio;

        $msj = '';
        $negocio = Negocio::find($negocioData->id);
        $negocio->estado = $negocioData->estado;
        $negocio->save();

        if($negocio->estado == 'A'){
            $msj = 'El negocio está activo !!';
            $estado = 'text-primary';
        }else
        if($negocio->estado == 'I'){
            $msj = 'El negocio ahora se encuentra inactivo !!';
            $estado = 'text-warning';
        }else
        if($negocio->estado = 'E'){
            $msj = 'Se ha eliminado el negocio';
            $estado = 'text-danger';
        }

        $response = [
            'estado' => true,
            'mensaje' => $msj,
            'estado' => $estado
        ];

        return response()->json($response);
    }
}
