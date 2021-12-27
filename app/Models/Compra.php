<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Negocio;
use App\Models\Usuario;
use App\Models\Status;
use App\Models\Detalle_Compra;




class Compra extends Model
{
    use HasFactory;

    protected $table ="compra";  
    protected $filleable = ['usuario_id','negocio_id','status_id','serie','subtotal','total','iva','fecha','estado'];

    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }
    
    public function negocio(){
        return $this->belongsTo(Negocio::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function detalle_compra(){
        return $this->hasMany(Detalle_Compra::class);
    }
}
