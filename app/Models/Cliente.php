<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';
    protected $primaryKey = "id_cliente";

    protected $fillable = [
        'nombre',
        'documento',
        'nrodocumento',
        'direccion',
        'telefono',
        'email',
    ];

    public function tipos(){
        return $this->hasOne(TipoDocumento::class, 'id', 'documento');   
    }

    public function ventas(){
        return $this->belongsTo(Venta::class, 'cliente_id', 'id_cliente');
    }

    public $timestamps = false;
}
