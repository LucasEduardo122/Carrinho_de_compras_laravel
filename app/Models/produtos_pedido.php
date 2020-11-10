<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produtos_pedido extends Model
{
    use HasFactory;

    protected $table = "produtos_pedidos";

    protected $fillable = [
        'pedido_id',
        'produto_id',
        'status',
        'valor'
    ];

    public function produtos() {
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
    }
}
