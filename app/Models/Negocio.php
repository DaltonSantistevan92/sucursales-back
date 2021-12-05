<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negocio extends Model{
    use HasFactory;

    protected $table = "negocios";
    protected $filleable = ["tipo_negocio_id", "tipo_empleo_id", "empleado_id", "seccion_id", "nombre",
                "provincia_id", "ciudad_id", "horario_id", "foto", "ubicacion", "estado"];


}
