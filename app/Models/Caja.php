<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    protected $table = 'caja';
    protected $primaryKey = "id_caja";

    protected $fillable = [
        'descripcion',
        'tipoMovimiento',
        'monto',
        'saldo',
        'fecha',
        'estado',
        'estadoMovimiento',
    ];

    public $timestamps = false;
}
