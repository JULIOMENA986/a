<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo_Realizado extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_inicio',
        'carro',
        'dueño',
        'mecanico',
        'fecha_termino',
        'mano_obra',
    ];
}
