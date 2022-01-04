<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;
    protected $table = 'detalle_venta';
    protected $primaryKey = 'id_detalle';

    protected $fillable = [
        'venta_id',
        'producto_id',
        'cantidad',
        'precio',
        'descuento'
    ];

    public function ventas(){
        return $this->belongsTo(Venta::class, 'id_venta', 'venta_id');
    }

    public function productos(){
        return $this->hasOne(Producto::class, 'id_producto', 'producto_id');
    }
}
