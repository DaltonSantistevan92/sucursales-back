<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function login(Request $request){
        $usuarioData = (object)$request->usuario;
        $response = [];

        if($usuarioData){
            $usuario = Usuario::where('email', $usuarioData->email)->first();

            if($usuario){
                if($usuario->password == $usuarioData->password){
                    $response = [
                        'status' => true,
                        'message' => 'Access the system',
                        'data' => $usuario
                    ];
                }
            }else{
                $response = [
                    'status' => false,
                    'message' => 'Email no found !!'
                ];
            }
        }else{
            $response = [
                'status' => false,
                'message' => 'No exist data'
            ];
        }

        return response()->json($response);
    }
}
