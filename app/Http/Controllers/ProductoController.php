<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto;

class ProductoController extends Controller
{
    //
    public function createProduct(Request $request){
        $producto = (object)$request->producto;

        $nombre = ucfirst($producto->nombre);
        $response = [];

        if($producto){
            $exiteProducto = Producto::where('nombre',$nombre)->get()->first();
            $existeCodigo = Producto::where('codigo',$producto->codigo)->get()->first();

            if($exiteProducto){
                $response = [
                    'estado' => false,
                    'mensaje' => 'El producto ya existe',
                    'producto' => null
                ];
            }else 
            if($existeCodigo){
                $response = [
                    'estado' => false,
                    'mensaje' => 'El codigo del producto ya existe',
                    'producto' => null
                ];
            }else{
                $nuevoProducto = new Producto();
                $nuevoProducto->proveedor_id = $producto->proveedor_id;
                $nuevoProducto->categoria_id = $producto->categoria_id;
                $nuevoProducto->nombre = $producto->nombre;
                $nuevoProducto->foto = $producto->foto;
                $nuevoProducto->codigo = $producto->codigo;
                $nuevoProducto->stock_minimo = $producto->stock_minimo;
                $nuevoProducto->stock_macimo  = $producto->stock_macimo;
                $nuevoProducto->precio_compra = 0.00;
                $nuevoProducto->precio_venta = $producto->precio_venta;
                $nuevoProducto->margen = $producto->precio_venta;
                $nuevoProducto->fecha = $producto->fecha;
                $nuevoProducto->stock = 0;
                $nuevoProducto->estado = 'A';

                if($nuevoProducto->save()){
                    $response = [
                        'estado' => true,
                        'mensaje' => 'El producto se ha guardado',
                        'producto' => $nuevoProducto
                    ];
                }else{
                    $response = [
                        'estado' => false,
                        'mensaje' => 'El producto no se puede guardar',
                        'producto' => null
                    ];
                }
            }
        }else{
            $response = [
                'estado' => false,
                'mensaje' => 'No ahi datos para procesar',
                'producto' => null
            ];
        }
        return response()->json($response);

    }

    public function get(){
        $productos = Producto::where('estado', 'A')->orderBy('nombre')->get();
        $response = [];

        if (count($productos) > 0) {
            $response = [
                'estado' => true,
                'mensaje' => 'Existen datos',
                'producto' => $productos
            ];
        }else{
            $response = [
                'estado' => false,
                'mensaje' => 'No existen datos',
                'producto' => null
            ];
        }
        return response()->json($response);
    }
}
