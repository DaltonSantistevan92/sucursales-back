<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Producto_Negocio;
use App\Models\Detalle_Compra;

class Producto extends Model
{
    use HasFactory;

    protected $table = "productos";
    protected $filleable = ["proveedor_id","categoria_id","nombre","foto","codigo","precio_compra","precio_venta","margen","fecha","estado"]; 

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function producto_negocio()
    {
        return $this->hasMany(Producto_Negocio::class);
    }

    public function detalle_compra(){
        return $this->hasMany(Detalle_Compra::class);
    }
   
}
