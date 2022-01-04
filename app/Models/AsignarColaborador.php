<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignarColaborador extends Model
{
    use HasFactory;
    protected $table = 'colaborador_dep';
    protected $primaryKey = "id_col_dep";

    protected $fillable = [
        'colaborador_id',
        'departamento_id',
        'estado',
    ];

    public $timestamps = false;

    public function colaboradores(){
        return $this->hasOne(Colaborador::class, 'id_colaborador', 'colaborador_id');
    }

    public function departamentos(){
        return $this->hasOne(Departamento::class, 'id_departamento', 'departamento_id');
    }
}
