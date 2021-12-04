<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller{

    public function getEmpleadoByCampo(String $campo, String $valor){
        $empleados = Empleado::where($campo, $valor)->get();
        $response = [];

        if($empleados->count() > 0){
            foreach($empleados as $e)
                $e->persona;

            $response = $empleados;
        }

        return response()->json($response);
    }
}
