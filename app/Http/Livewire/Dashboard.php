<?php

namespace App\Http\Livewire;

use App\Models\Compra;
use App\Models\Colaborador;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $nombres = [];
    public $valores = [];
    public function render()
    {
        /* $solicitudes = DB::table('solicitud_compra')->select(DB::raw('SUM(total) as total'))->get();
        $egresos = DB::table('compra')->select(DB::raw('SUM(total) as total'))->get();
        $inventario = DB::table('kardex')->get()->last(); 
        DB::table('detalle_solicitud_compraa')->count(DB::raw('DISTINCT producto'));*/

        $sc = Compra::all()->count();
        $pr = DB::table('detalle_solicitud_compraa')->count(DB::raw('DISTINCT producto'));
        $co = Colaborador::all()->count();
        $us = User::all()->count();
        return view('dashboard', compact('sc', 'pr', 'co', 'us'));
    }
}
