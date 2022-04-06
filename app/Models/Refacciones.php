<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refacciones extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'stock',
        'proveedor_fk',
    ];
}
