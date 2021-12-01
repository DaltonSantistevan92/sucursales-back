<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Rol;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class MenuController extends Controller{

    public function get(String $rol_id, $parte = 0){

        $menus = Menu::where('rol_id', $rol_id)->where('id_seccion', $parte)
        ->orderBy('pos', 'asc')->get();

        $response = [];

        if($menus->count() > 0){
            $response = [
                'cantidad' => $menus->count(),
                'data' => $menus
            ];
        }else{
            $response = [
                'cantidad' => 0,
                'data' => []
            ];
        }

        return response()->json($response);
    }
}
