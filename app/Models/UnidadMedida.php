<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    use HasFactory;

    protected $table = 'unidad_medida';

    protected $fillable = [
        'medida'
    ];

    public function productos(){
        return $this->belongsTo(Producto::class, 'medida_id', 'id');
    }

    public $timestamps = false;
}
