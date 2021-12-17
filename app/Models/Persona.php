<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Usuario;
use App\Models\Cliente;


class Persona extends Model
{
    use HasFactory;

    protected $table = "personas";
    protected $filleable = ["cedula", "nombres", "apellidos", "telefono", "direccion", "estado"];

    public function usuario(){
        return $this->hasMany(Usuario::class);
    }

    public function cliente(){
        return $this->hasMany(Cliente::class);
    }


}

