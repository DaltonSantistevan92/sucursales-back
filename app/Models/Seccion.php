<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model{
    use HasFactory;

    protected $table = "secciones";

    public function negocio(){
        return $this->hasMany(Negocio::class);
    }
}
