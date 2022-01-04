<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'area';
    protected $primaryKey = "id_area";

    protected $fillable = [
        'area',
        'departamento_id',
        'estado',
    ];

    public function departamentos(){
        return $this->hasOne(Departamento::class, 'id_departamento', 'departamento_id');
    }

    public function colAreas(){
        return $this->belongsTo(AsignarColaborador2::class, 'area_id', 'id_area');
    }
    /* public function productos(){
        return $this->hasOne(Producto::class, 'categoria_id', 'id_categoria');
    } */

    public $timestamps = false;
}
