<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;
    protected $table = 'detalle_solicitud_compraa';
    protected $primaryKey = 'id_detalle';

    protected $fillable = [
        'solicitud_id',
        'producto',
        'precio',
        'cantidad'
    ];

    public function solicitudes(){
        return $this->belongsTo(Compra::class, 'id_solicitud', 'solicitud_id');
    }

}
