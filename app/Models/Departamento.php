<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamento';
    protected $primaryKey = 'id_departamento';

    protected $fillable = [
        'departamento',
        'estado'
    ];

    public function areas(){
        return $this->belongsTo(Area::class, 'departamento_id', 'id_departamento');
    }

    public function colDepars(){
        return $this->belongsTo(AsignarColaborador::class, 'departamento_id', 'id_departamento');
    }
     /*
    public function productos(){
        return $this->belongsTo(Producto::class, 'categoria_id', 'id_categoria');
    } */

    public $timestamps = false;
}
