<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoNegocio extends Model{

    use HasFactory;
    protected $table = "tipo_negocio";

    public function negocio(){
        return $this->hasMany(Negocio::class);
    }

}
