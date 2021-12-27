<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Producto;
use App\Models\Compra;


class Detalle_Compra extends Model
{
    use HasFactory;
    protected $table ="detalle_compra";  
    protected $filleable = ['compra_id','producto_id','cantidad','precio','total'];
    public $timestamps = false; 


    public function compra(){
        return $this->belongsTo(Compra::class);
    }

    public function producto(){
        return $this->belongsTo(Producto::class);
    }
    
}
