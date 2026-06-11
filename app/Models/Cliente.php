<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'nif',
        'morada',
    ];

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
}
