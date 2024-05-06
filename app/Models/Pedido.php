<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory; 
    public function user() { 
        return $this->belongsTo (User::class); 
    } 
    public function orderItems() { 
        return $this->hasMany (ObjetosPedido::class); 
    }
    public function shipping() { 
        return $this->hasone (Envio::class);
     } 
    public function transaction() { 
        return $this->hasOne (Transaccion::class); 
    }
}
