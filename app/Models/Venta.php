<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'venta';
    protected $primaryKey = 'id_venta';

    protected $fillable = [
        'cliente_id',
        'subtotal',
        'igv',
        'total',
        'fecha'
    ];

    public function detalles(){
        return $this->hasMany(DetalleVenta::class, 'venta_id', 'id_venta');
    }

    public function clientes(){
        return $this->hasOne(Cliente::class, 'id_cliente', 'cliente_id');
    }
}
