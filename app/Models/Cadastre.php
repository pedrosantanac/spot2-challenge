<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cadastre extends Model
{
    use HasFactory;

    protected $fillable = [
        'superficie_terreno',
        'superficie_construccion',
        'valor_suelo',
        'subsidio'
    ];

    const TYPES = [
        1 => 'Áreas verdes',
        2 => 'Centro de barrio',
        3 => 'Equipamiento',
        4 => 'Habitacional',
        5 => 'Habitacional y comercial',
        6 => 'Industrial',
        7 => 'Sin Zonificación'
    ];
}
