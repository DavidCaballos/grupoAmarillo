<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'status',
        'name',
    ];

    public function user() { 
        return $this->belongsTo(User::class); 
    }

    public function orderItems() { 
        return $this->hasMany(ObjetosPedido::class, 'order_id'); 
    }

    public function shipping() { 
        return $this->hasOne(Envio::class);
    } 

    public function transaction() { 
        return $this->hasOne(Transaccion::class); 
    }
}
