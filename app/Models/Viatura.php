<?php

namespace App\Models;

use Illuminate\Support\Str;
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
        'descricao',
        'equipamento',
    ];
    public function getImagemUrlAttribute()
    {
        if (!$this->imagem) {
            return null;
        }

        if (Str::startsWith($this->imagem, ['http://', 'https://'])) {
            return $this->imagem;
        }

        if (Str::startsWith($this->imagem, 'images/')) {
            return asset($this->imagem);
        }

        return asset('storage/' . $this->imagem);
    }
    public function venda()
    {
        return $this->hasOne(Venda::class);
    }
}
