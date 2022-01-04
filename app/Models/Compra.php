<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $table = 'solicitud_compra';
    protected $primaryKey = 'id_solicitud';

    protected $fillable = [
        'colaborador_id',
        'grado_urgencia',
        'monto_total',
        'cantidad',
        'fecha',
        'estado'
    ];

    public function detalles(){
        return $this->hasMany(DetalleCompra::class,'solicitud_id', 'id_solicitud');
    }

    public function colaboradores(){
        return $this->hasOne(Colaborador::class, 'id_colaborador', 'colaborador_id');
    }

}
