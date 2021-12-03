<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Horario;
use App\Models\Provincia;
use App\Models\Seccion;
use App\Models\TipoNegocio;
use Illuminate\Http\Request;

class GeneralController extends Controller{

    public function __construct(){ }

    public function getTiposNegocios(){
        $tipos = TipoNegocio::where('estado', 'A')->orderBy('tipo', 'Asc')->get();
        $response = [];

        if($tipos->count() > 0){
            $response = $tipos;
        }

        return response()->json($response);
    }

    public function getProvincias(){
        $provincias = Provincia::where('estado', 'A')->orderBy('provincia', 'Asc')->get();
        $response = [];

        if($provincias->count() > 0){
            $response = $provincias;
        }

        return response()->json($response);
    }

    public function getCiudades(String $provincia_id){
        $ciudades = Ciudad::where('provincia_id', $provincia_id)
            ->where('estado','A')->orderBy('ciudad', 'asc')->get();
        $response = [];

        if($ciudades->count() > 0){
            $response = $ciudades;
        }

        return response()->json($response);
    }

    public function getSecciones(){
        $secciones = Seccion::where('estado', 'A')->orderBy('tipo', 'asc')->get();
        $response = [];

        if($secciones->count() > 0){
            $response = $secciones;
        }

        return response()->json($response);
    }

    public function getHorarios(){
        $horarios = Horario::where('estado', 'A')->orderBy('inicio', 'asc')->get();
        $response = [];

        if($horarios->count()){
            $response = $horarios;
        }

        return response()->json($response);
    }
}
