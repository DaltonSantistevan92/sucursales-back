<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Compra;

class Status extends Model
{
    use HasFactory;

    protected $table ="status";  
    protected $filleable = ['status'];

    public function compra(){
        return $this->hasMany(Compra::class);
    }
}
