<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Categoria;
use App\Models\Proveedor;

class Producto extends Model
{
    use HasFactory;

    protected $table = "productos";
    protected $filleable = ["proveedor_id","categoria_id","nombre","foto","codigo","stock_minimo","stock_macimo","precio_compra","precio_venta","margen","fecha","stock","estado"]; 

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
   
}
