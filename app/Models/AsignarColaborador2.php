<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignarColaborador2 extends Model
{
    use HasFactory;
    protected $table = 'colaborador_area';
    protected $primaryKey = "id_col_area";

    protected $fillable = [
        'colaborador_id',
        'area_id',
        'estado',
    ];

    public $timestamps = false;

    public function colaboradores(){
        return $this->hasOne(Colaborador::class, 'id_colaborador', 'colaborador_id');
    }

    public function areas(){
        return $this->hasOne(Area::class, 'id_area', 'area_id');
    }
}
