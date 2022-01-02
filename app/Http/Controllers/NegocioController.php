<?php

namespace App\Http\Controllers;

use App\Models\Negocio;
use App\Models\Producto_Negocio;
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

    public function getActivos($estado){
        $negocios = Negocio::where('estado',$estado)->orderBy('nombre', 'asc')->get();
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

    public function addSucursalNegocio(Request $request){

        $negocio = (object)$request->negocio;
        $productos = (array)$request->productos;
        $response = [];

        $mensajes = ""; $boolMensaje = false;

        if(is_array($productos)){
            //Recorrer el productos
            for($i = 0; $i < count($productos); $i++){
                $productos[$i] = (object)$productos[$i];
            }

            foreach($productos as $p){
                $prodNegExist = Producto_Negocio::where('producto_id', $p->id)->where('negocio_id', $negocio->id)->first();

                if($prodNegExist){
                    $mensajes = $mensajes." Producto ".$p->nombre.' ya registrado.';
                    $boolMensaje = true;
                }else{
                    $new = new Producto_Negocio();
                    $new->producto_id = $p->id;
                    $new->negocio_id = $negocio->id;
                    $new->stock = 0;
                    $new->stock_minimo = 0;
                    $new->stock_maximo = 0;
                    $new->estado = 'A';
                    $new->save();
                }
            }

            if($boolMensaje){
                $response = [
                    'estado' => true,
                    'mensaje' => $mensajes,
                    'factor' => 1
                ];
            }else{
                $response = [
                    'estado' => true,
                    'mensaje' => 'Productos agregados',
                    'factor' => 2
                ];
            }
        }else{
            $response = [
                'estado' => false,
                'mensaje' => 'No ha enviado productos',
                'factor' => 0
            ];
        }
        return response()->json($response);
    }

    public function viewNegocioProducto($id){

        $response = [];
        $negProd = Producto_Negocio::select('producto_id', 'stock', 'stock_minimo', 'stock_maximo')->where('negocio_id', $id)->get();

        if($negProd->count() > 0){
            foreach($negProd as $p){
                $p->producto->categoria;
                $p['stock'] = $p->stock;
                $p['stock_minimo'] = $p->stock_minimo;
                $p['stock_maximo'] = $p->stock_maximo;
            }
        }

        return response()->json($negProd);
    }


}
