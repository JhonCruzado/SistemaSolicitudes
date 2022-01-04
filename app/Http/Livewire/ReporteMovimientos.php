<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Empresa;
use Livewire\Component;
use Carbon\Carbon;
use PDF;

class ReporteMovimientos extends Component
{

    public function pdf()
    {
        //whereDate('caja.fecha','=',Carbon::today())
        $reporte = Caja::whereDate('fecha', '=', Carbon::today())->get();
        $lastregister = Caja::whereRaw('id_caja = (select max(`id_caja`) from caja)')->first();
        $empresa = Empresa::first();
        //return view('livewire.kardex.pdf', compact('kardex'));
        $pdf = PDF::loadView('livewire.cajas.reporteMovimientos', compact('empresa','reporte','lastregister'));
        return $pdf->stream('reporteMovimientos.pdf');
    }
}
