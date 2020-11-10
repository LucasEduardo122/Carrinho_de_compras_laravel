<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pedido extends Model
{
    use HasFactory;

    protected $table = "pedidos";

    protected $fillable = [
        'user_id',
        'status'
    ];
    
    public function produtos_pedidos() {
        return $this->hasMany(produtos_pedido::class)
        ->select(DB::raw('produto_id, sum(desconto) as descontos, sum(valor) as valores, count(1) as qtd' ))
        ->groupBy('produto_id')
        ->orderBy('produto_id', 'desc');
    }
}
