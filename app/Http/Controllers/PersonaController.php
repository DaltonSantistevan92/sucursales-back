<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller{
    
    public function getPersons(){
        $persons = Persona::where('estado', 'A')->get();

        return response()->json($persons);
    }
}
