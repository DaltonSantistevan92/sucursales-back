<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model{
    use HasFactory;

    protected $table = "provincias";

    public function negocio(){
        return $this->hasMany(Negocio::class);
    }
}
