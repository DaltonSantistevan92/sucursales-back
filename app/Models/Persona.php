<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = "personas";
    protected $filleable = ["cedula", "nombres", "apellidos", "telefono", "direccion", "estado"];

    public function persona(){
        return $this->hasMany(Persona::class);
    }


}

