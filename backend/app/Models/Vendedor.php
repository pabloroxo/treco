<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendedor extends Model
{
    protected $table = 'vendedores';

    protected $fillable = [
        'nome',
        'email',
    ];

    public function vendas(): HasMany
    {
        return $this->hasMany(Venda::class);
    }
}
