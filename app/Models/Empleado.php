<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model{

    use HasFactory;
    protected $table = "empleados";
    protected $filleable = ['persona_id', 'user_id', 'tipo_empleado_id', 'estado'];

    //Relacion
    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function negocio(){
        return $this->hasMany(Negocio::class);
    }

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'user_id', 'id');
    }

    public function tipo_empleo(){
        return $this->belongsTo(TipoEmpleo::class, 'tipo_empleado_id', 'id');
    }
}
