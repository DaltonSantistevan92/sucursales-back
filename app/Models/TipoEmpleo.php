<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEmpleo extends Model{

    use HasFactory;
    protected $table = "tipo_empleados";

    public function negocio(){
        return $this->hasMany(Negocio::class);
    }
}
