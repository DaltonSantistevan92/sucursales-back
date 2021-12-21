<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    //
    public function find($id){
        $proveedor = Proveedor::find($id);
        $response = [];

        if($proveedor){
            $response = [
                'status' => true,
                'mensaje' => 'si hay datos',
                'proveedor' => $proveedor
            ];
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'no hay datos',
                'proveedor' => null
            ];
        }
        return response()->json($response);

    }

    public function get(){
        $proveedores = Proveedor::where('estado', 'A')->orWhere('estado', 'I')->orderBy('razon_social','asc')->get();
        $response = [];

        if ($proveedores->count() > 0) {
            $response = [
                'cantidad' => $proveedores->count(),
                'data' => $proveedores
            ];
        }else{
            $response = [
                'cantidad' => 0,
                'data' => []
            ];
        }
        return response()->json($response);
    }

    public function getByEstado($estado){
        $proveedores = Proveedor::where('estado', $estado)->orderBy('razon_social','asc')->get();
        $response = [];

        if ($proveedores->count() > 0) {
            $response = [
                'cantidad' => $proveedores->count(),
                'data' => $proveedores
            ];
        }else{
            $response = [
                'cantidad' => 0,
                'data' => []
            ];
        }
        return response()->json($response);
    }

    public function createProveedor(Request $request){
        $proveedor = (object)$request->proveedor;

        $razon_social = ucfirst($proveedor->razon_social);
        $ruc = $proveedor->ruc;
        $response = [];

        if($proveedor){
            $exiteProveedor = Proveedor::where('razon_social',$razon_social)->get()->first();
            $exiteRuc = Proveedor::where('ruc',$ruc)->get()->first();

            if($exiteProveedor){
                $response = [
                    'estado' => false,
                    'mensaje' => 'El proveedor ya existe',
                    'proveedor' => null
                ];
            }else
            if($exiteRuc){
                $response = [
                    'estado' => false,
                    'mensaje' => 'El ruc del proveedor ya existe',
                    'proveedor' => null
                ];
            }else{
                $nuevoProveedor = new Proveedor();
                $nuevoProveedor->ruc = $ruc;
                $nuevoProveedor->razon_social = $razon_social;
                $nuevoProveedor->email = $proveedor->email;
                $nuevoProveedor->telefono = $proveedor->telefono;
                $nuevoProveedor->telefono2 = $proveedor->telefono2;
                $nuevoProveedor->direccion = $proveedor->direccion;
                $nuevoProveedor->estado = 'A';

                if($nuevoProveedor->save()){
                    $response = [
                        'estado' => true,
                        'mensaje' => 'El proveedor se ha guardado',
                        'proveedor' => $nuevoProveedor
                    ];
                }else{
                    $response = [
                        'estado' => false,
                        'mensaje' => 'El proveedor no se puede guardar',
                        'proveedor' => null
                    ];
                }
            }
        }else{
            $response = [
                'estado' => false,
                'mensaje' => 'No ahi datos para procesar',
                'proveedor' => null
            ];
        }
        return response()->json($response);
    }
}
