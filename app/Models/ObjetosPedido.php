<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetosPedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'order_id',
        'name',
        'price',
        'quantity',
    ];

    public function order()
    {
        return $this->belongsTo(Pedido::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
