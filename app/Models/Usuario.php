<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Persona;
use App\Models\Rol;
use App\Models\Compra;



class Usuario extends Model
{
    use HasFactory;

    protected $table ="users";
    protected $hidden = ['password', 'email_verified_at'];
    protected $filleable = [
        'person_id','rol_id','email','usuario','img','email_verified_at','password','estado','remember_token'
    ];

    public function empleo(){
        return $this->hasMany(empleo::class);
    }

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function rol(){
        return $this->belongsTo(Rol::class);
    }

    public function compra(){
        return $this->hasMany(Compra::class);
    }

}
