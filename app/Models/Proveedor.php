<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = "proveedores";
    protected $filleable = ['ruc','razon_social','email','telefono','telefono2','direccion','estado'];
}
