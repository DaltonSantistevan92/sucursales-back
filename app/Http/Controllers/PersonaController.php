<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller{
    
    public function getPersons(){
        $persons = Persona::where('estado', 'A')->get();

        return response()->json($persons);
    }

    public function savePersona(Request $request){
        $data = (object)$request->persona;
        $response = [];

        if(!isset($data) || $data == null){
            $response = [
                'status' => false,
                'mensaje' => 'No hay datos para procesar',
                'persona' => null
            ];
        }else{
            $response = $this->procesandoDatos($data);
        }
        return $response;
    }

    //URL
    public function save(Request $request){
        $data = (object)$request->persona;
        $response = [];

        if(!isset($data) || $data == null){
            $response = [
                'status' => false,
                'mensaje' => 'No hay datos para procesar',
                'persona' => null
            ];
        }else{
            $response = $this->procesandoDatos($data);
        }
        return response()->json($response);
    }

    private function procesandoDatos($data){
        $existePersona = Persona::where('cedula',$data->cedula)->get()->first();
        $response = [];

        if($existePersona == null){
            $nuevaPersona = new Persona();
            $nuevaPersona->cedula = $data->cedula;
            $nuevaPersona->nombres = $data->nombres;
            $nuevaPersona->apellidos = $data->apellidos;
            $nuevaPersona->telefono = $data->telefono;
            $nuevaPersona->direccion = $data->direccion;
            $nuevaPersona->estado = 'A';
            
            if($nuevaPersona->save()){
                $response = [
                    'status' => true,
                    'mensaje' => 'Se ha guardado la persona',
                    'persona' => $nuevaPersona
                ];
            }else{
                $response = [
                    'status' => false,
                    'mensaje' => 'No se puede guardar la persona',
                    'persona' => null
                ];
            }
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'La persona ya se encuentra registrada',
                'persona' => $existePersona
            ];

        }
        return $response;

    }


}
