<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Http\Livewire\Auth;
use App\Models\SolicitudCompra;
use App\Models\Colaborador;
use App\Models\Departamento;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $nombres = [];
    public $valores = [];
    public function render()
    {
        $egresos = DB::table('solicitud_compra')->select(DB::raw('SUM(monto_total) as total'))->get();
        $sc = SolicitudCompra::all()->count();
        $dp = Departamento::all()->count();
        $ar = Area::all()->count();
        $co = Colaborador::all()->count();
        $us = User::all()->count();

        return view('dashboard', compact('egresos','sc', 'dp', 'ar','co', 'us'));
    }
}
