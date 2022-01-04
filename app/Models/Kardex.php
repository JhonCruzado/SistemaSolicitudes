<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    use HasFactory;

    protected $table = 'kardex';
    protected $primaryKey = "id_kardex";

    protected $fillable = [
        'fecha',
        'producto_id',
        'descripcion',
        'nrodocumento',
        'valor_unitario',
        'cantidad',
        'valor',
        'stock_total',
        'valor_total',
    ];

    public function productos(){
        return $this->hasOne(Producto::class, 'id_producto', 'producto_id');
    }

    public $timestamps = false;
}
