<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model{

    use HasFactory;
    protected $table = 'ciudades';

    public function negocio(){
        return $this->hasMany(Negocio::class);
    }
}
