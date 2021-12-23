<?php

namespace App\Http\Controllers;

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
}
