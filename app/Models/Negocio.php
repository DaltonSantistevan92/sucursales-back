<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Producto_Negocio;

class Negocio extends Model{
    use HasFactory;

    protected $table = "negocios";
    protected $filleable = ["tipo_negocio_id", "tipo_empleo_id", "empleado_id", "seccion_id", "nombre",
                "provincia_id", "ciudad_id", "horario_id", "foto", "ubicacion", "descripcion", "estado"];


    public function tipoNegocio(){
        return $this->belongsTo(TipoNegocio::class);
    }

    public function tipoEmpleo(){
        return $this->belongsTo(TipoEmpleo::class);
    }

    public function empleado(){
        return $this->belongsTo(Empleado::class);
    }

    public function seccion(){
        return $this->belongsTo(Seccion::class);
    }

    public function provincia(){
        return $this->belongsTo(Provincia::class);
    }

    public function ciudad(){
        return $this->belongsTo(Ciudad::class);
    }

    public function horario(){
        return $this->belongsTo(Horario::class);
    }

    public function producto_negocio()
    {
        return $this->hasMany(Producto_Negocio::class);
    }
}
