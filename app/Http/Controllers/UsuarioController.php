<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\PersonaController;
use App\Models\Cliente;

class UsuarioController extends Controller{
    private $personaCtrl;

    public function __construct()
    {
        $this->personaCtrl = new PersonaController();
    }


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

    public function saveUser(Request $request){
        $usuario = (object)$request->usuario;
        $response = [];

        if(!isset($usuario) || $usuario == null){
            $response = [
                'status' => false,
                'mensaje' => 'No hay datos para procesar',
                'usaurio' => null
            ];
        }else{          
            $responsePersona = $this->personaCtrl->savePersona($request);
            $person_id = $responsePersona['persona']->id;

            $password = $usuario->password;
            $encriptado = Hash::check($password);
            $rol_id = intval($usuario->rol_id);

            $nuevoUsuario = new Usuario();
            $nuevoUsuario->person_id = $person_id;
            $nuevoUsuario->rol_id = $rol_id;
            $nuevoUsuario->email = $usuario->email;
            $nuevoUsuario->usuario = $usuario->usuario;
            $nuevoUsuario->img = $usuario->img;
            $nuevoUsuario->password = $encriptado;
            $nuevoUsuario->estado = 'A';
            $nuevoUsuario->remember_token = '';

            $existeUsuario = Usuario::where('person_id',$person_id)->get()->first();

            if($existeUsuario){
                $response = [
                    'status' => false,
                    'mensaje' => 'El usuario ya se encuentra registrado',
                    'usuario' => null
                ];
            }else{
                if($nuevoUsuario->save()){
                    //verifica si hay un rol cliente
                    if($nuevoUsuario->rol_id == 3){
                        //Crea un cliente y guarda
                        $nuevoCliente = new Cliente();
                        $nuevoCliente->persona_id = $person_id;
                        $nuevoCliente->estado = 'A';
                        $nuevoCliente->save(); 
                    }
                    $response = [
                        'status' => true,
                        'mensaje' => 'Se ha guardado el usuario',
                        'usuario' => $nuevoUsuario
                    ];
                }else{
                    $response = [
                        'status' => false,
                        'mensaje' => 'No se puede guardar el usuario',
                        'usuario' => null
                    ];
                }
            }
        }
        return response()->json($response);
    }

}
