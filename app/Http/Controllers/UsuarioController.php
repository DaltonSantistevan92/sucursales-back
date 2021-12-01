<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller{

    public function login(Request $request){
        $usuarioData = (object)$request->usuario;
        $response = [];

        if($usuarioData){
            $usuario = Usuario::where('email', $usuarioData->email)->first();

            if($usuario){
                // $encriptado =  Hash::make($usuarioData->password);

                if (Hash::check($usuarioData->password, $usuario->password)) {
                    $response = [
                        'status' => true,
                        'message' => 'Access the system',
                        'data' => $usuario
                    ];
                }else{
                    $response = [
                        'status' => false,
                        'message' => 'Password incorrect',
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
