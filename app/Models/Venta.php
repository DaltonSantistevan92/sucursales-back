<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Usuario;


class Venta extends Model
{
    use HasFactory;

    protected $table = "venta";
    protected $filleable = ["usuario_id","cliente_id","serie","subtotal","iva","total","fecha","estado"]; 
    public $timestamps = false; 

    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
