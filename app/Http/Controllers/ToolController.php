<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;


class ToolController extends Controller{

    public function viewImage($folder,$file){
        $existe = Storage::disk($folder)->exists($file);

        if($existe){
            $archivo = Storage::disk($folder)->get($file);
               return new Response($archivo, 200);
        }else{
            $data = [
                'estado' => false,
                'mensaje' => 'Imagen no existe',
                'error' => 404
            ];
        }
        return response()->json($data);
    }

    public function uploadFile(Request $request){

        if($request->hasFile('img_user-0')){
            $imagen = $request->file('img_user-0');

            $filenamewithextension = $imagen->getClientOriginalName();   //Archivo con su extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);                //Sin extension
            $extension = $request->file('img_user-0')->getClientOriginalExtension();    //Obtener extesion de archivo
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            Storage::disk('productos')->put($filenametostore, fopen($request->file('img_user-0'), 'r+'));

            $response = [
                'estado' => true,
                'imagen' => $filenametostore,
                'mensaje' => 'La imagen se ha subido al servidor'
            ];
        }else{
            $response = [
                'estado' => false,
                'imagen' => '',
                'mensaje' => 'No hay un archivo para procesar'
            ];
        }

        return response()->json($response);
    }

    public function getYears($estado){

        $estado = strtoupper($estado);
        $years = Year::where('estado', $estado)->get();
        $response = [];

        if($years->count() > 0)
            $response = $years;

        return response()->json($response);
    }

    public function getMonths(){
        $meses = [
            [
                'value' => 1,
                'mes' => 'Enero'
            ],[
                'value' => 2,
                'mes' => 'Febrero'
            ],[
                'value' => 3,
                'mes' => 'Marzo'
            ],[
                'value' => 4,
                'mes' => 'Abril'
            ],[
                'value' => 5,
                'mes' => 'Mayo'
            ],[
                'value' => 6,
                'mes' => 'Junio'
            ],[
                'value' => 7,
                'mes' => 'Julio'
            ],[
                'value' => 8,
                'mes' => 'Agosto'
            ],[
                'value' => 9,
                'mes' => 'Septimebre'
            ],[
                'value' => 10,
                'mes' => 'Octubre'
            ],[
                'value' => 11,
                'mes' => 'Noviembre'
            ],[
                'value' => 12,
                'mes' => 'Diciembre'
            ]
        ];

        return response()->json($meses);
    }
}
