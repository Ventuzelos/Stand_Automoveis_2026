<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viatura extends Model
{
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

    public function venda()
    {
        return $this->hasOne(Venda::class);
    }
}
