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
            }
            else{
                $nuevoProveedor = new Proveedor();
                $nuevoProveedor->ruc = $proveedor->ruc;
                $nuevoProveedor->razon_social = $proveedor->razon_social;
                $nuevoProveedor->email = $proveedor->email;
                $nuevoProveedor->direccion = $proveedor->direccion;
                $nuevoProveedor->estado = 'A';
                $nuevoProveedor->save();

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
