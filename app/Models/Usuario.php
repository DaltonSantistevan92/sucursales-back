<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table ="users";
    protected $hidden = ['password', 'email_verified_at'];
    protected $filleable = [
        'person_id', 'rol_id', 'email', 'email_verified_at', 'password', 'estado'
    ];
}
