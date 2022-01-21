<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Venta extends Model
{
    use HasFactory;

    protected $table = "detalle_venta";
    protected $filleable = ["venta_id","cliente_id","serie","subtotal","iva","total","fecha","estado"]; 
    public $timestamps = false; 

    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
