<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viatura extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca',
        'modelo',
        'matricula',
        'ano',
        'cor',
        'preco',
        'combustivel',
        'quilometragem',
        'imagem',
        'vendido',
    ];
}
