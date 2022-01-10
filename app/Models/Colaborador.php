<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;

    protected $table = 'colaborador';
    protected $primaryKey = "id_colaborador";

    protected $fillable = [
        'dni',
        'nombres',
        'cargo_id',
        'direccion',
        'telefono',
        'email'
    ];

    public function cargos(){
        return $this->hasOne(Cargo::class, 'id_cargo', 'cargo_id');
    }

    public function asignacion(){
        return $this->belongsTo(AsignarColaborador::class, 'colaborador_id', 'id_colaborador');
    }

    public function asignacion2(){
        return $this->belongsTo(AsignarColaborador2::class, 'colaborador_id', 'id_colaborador');
    }

    public function solicitudes(){
        return $this->belongsTo(Venta::class, 'colaborador_id', 'id_colaborador');
    }

    public $timestamps = false;
}
