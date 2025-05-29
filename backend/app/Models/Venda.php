<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Venda extends Model
{
    protected $table = 'vendas';

    protected $fillable = [
        'vendedor_id',
        'valor',
        'data_venda',
    ];

    public function vendedor(): BelongsTo
    {
        return $this->belongsTo(Vendedor::class);
    }
}
