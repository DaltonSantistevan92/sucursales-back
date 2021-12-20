<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;


class ToolController extends Controller
{
    //

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
}
