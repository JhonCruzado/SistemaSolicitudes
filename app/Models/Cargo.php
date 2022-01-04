<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $table = 'cargo';

    protected $fillable = [
        'cargo'
    ];

    public function colaboradores(){
        return $this->belongsTo(Colaborador::class, 'id_cargo', 'cargo_id');
    }

    public $timestamps = false;
}
