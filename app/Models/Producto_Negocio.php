<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Producto;
use App\Models\Negocio;

class Producto_Negocio extends Model
{
    use HasFactory;
    protected $table = "producto_negocio";
    protected $filleable = ["producto_id","negocio_id","stock","stock_minimo","stock_maximo","estado"];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function negocio()
    {
        return $this->belongsTo(Negocio::class);
    }
}
