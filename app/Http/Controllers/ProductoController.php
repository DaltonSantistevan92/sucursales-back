<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto;

class ProductoController extends Controller
{
    //
    public function create(Request $request){
        $producto = (object)$request->producto;

        $nombre = ucfirst($producto->nombre);
        $response = [];

        if($producto){
            $exiteProducto = Producto::where('nombre',$nombre)->get()->first();
            $existeCodigo = Producto::where('codigo',$producto->codigo)->get()->first();

            if($exiteProducto){
                $response = [
                    'estado' => false,
                    'mensaje' => 'El nombre del producto ya existe',
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
                $nuevoProducto->precio_compra = 0.00;
                $nuevoProducto->precio_venta = $producto->precio_venta;
                $nuevoProducto->margen = $producto->precio_venta;
                $nuevoProducto->fecha = date('Y-m-d');
                $nuevoProducto->estado = 'A';

                if($nuevoProducto->save()){
                    $response = [
                        'estado' => true,
                        'mensaje' => 'El producto se ha registrado',
                        'producto' => $nuevoProducto
                    ];
                }else{
                    $response = [
                        'estado' => false,
                        'mensaje' => 'El producto no se puede registrar',
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

    public function get($estado){
        $productos = Producto::where('estado',$estado)->orderBy('nombre','asc')->get();
        $response = [];

        if ($productos->count() > 0) {
            foreach($productos as $p){
                $p->categoria;
                $p->proveedor;
            }
            $response = [
                'cantidad' => $productos->count(),
                'data' => $productos
            ];
        }else{
            $response = [
                'cantidad' => $productos->count(),
                'data' => $productos
            ];
        }
        return response()->json($response);
    }

    public function find($id){
        $producto = Producto::find($id);
        $response = [];

        if($producto){
            $producto->categoria;
            $producto->proveedor;

            $response = [
                'status' => true,
                'mensaje' => 'Si hay datos',
                'producto' => $producto
            ];
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No hay datos',
                'producto' => null
            ];
        }
        return response()->json($response);

    }

    public function updateStatus(Request $request){
        $productoData = (object)$request->producto;

        $msj = '';
        $producto = producto::find($productoData->id);
        $producto->estado = $productoData->estado;
        $producto->save();

        if($producto->estado == 'A'){
            $msj = 'El producto está activo !!';
            $estado = 'text-primary';
        }else
        if($producto->estado == 'I'){
            $msj = 'El producto ahora se encuentra inactivo !!';
            $estado = 'text-warning';
        }else
        if($producto->estado = 'E'){
            $msj = 'Se ha eliminado el producto';
            $estado = 'text-danger';
        }

        $response = [
            'estado' => true,
            'mensaje' => $msj,
            'estado' => $estado
        ];

        return response()->json($response);
    }

    public function getProductoByCategoria($categoria_id, $estado){
        $response = [];

        if($categoria_id > 0 ){
            //Traer los productos por su categoria
            $productos = Producto::where('categoria_id', $categoria_id)->where('estado', $estado)->get();
        }else{
            //Traer todos los productos
            $productos = Producto::where('estado', $estado)->get();
        }

        if($productos->count() > 0){
            foreach($productos as $p){
                $p->categoria;
                $p->proveedor;
            }

            $response = $productos;
        }

        return response()->json($response);
    }

}
