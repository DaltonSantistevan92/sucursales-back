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

    public function usuario(){
        return $this->hasMany(Usuario::class);
    }

    public function tipo_empleo(){
        return $this->hasMany(TipoEmpleo::class);
    }
}
