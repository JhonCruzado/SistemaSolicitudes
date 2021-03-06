<?php

namespace App\Http\Livewire;

use App\Models\SolicitudCompra;
use App\Models\DetalleCompra;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ComprasRealizadas extends Component
{
    use WithPagination;
    protected $paginationTheme = 'simple-bootstrap';
    public $paginate = 5;
    public $idSolicitud;

    public $_detalle = false;
    public $_procesar = false;

    public function render()
    {
        $solicitudes = DB::table('solicitud_compra as sc')
            ->select('sc.id_solicitud as id_solicitud','sc.fecha as fecha','c.nombres as nombre','sc.grado_urgencia as grado_urgencia','sc.monto_total as monto_total','sc.cantidad_total as cantidad_total','sc.estado')
            ->join('colaborador as c', 'c.id_colaborador', '=', 'sc.colaborador_id')
            ->orderBy('sc.id_solicitud','DESC')
            ->where('c.nombres', '=', Auth::user()->nombre)
            ->paginate($this->paginate);
        $detalle = DetalleCompra::where('solicitud_id', '=', $this->idSolicitud)->get();

        $datos = DB::table('colaborador as c')
        ->select(DB::raw('CONCAT(car.cargo, " ", dp.area) AS cargo'),'c.nombres')
        ->join('cargo as car', 'car.id_cargo', '=', 'c.cargo_id')
        ->join('colaborador_area as cd', 'cd.colaborador_id', '=', 'c.id_colaborador')
        ->join('area as dp', 'dp.id_area', '=', 'cd.area_id')
        ->where('c.nombres', '=', Auth::user()->nombre)
        ->get();

        return view('livewire.solicitudes.realizadas', compact('solicitudes', 'detalle','datos'));
    }

    public function verDetalle($id)
    {
        $this->idSolicitud = $id;
        $this->_detalle = true;
    }

    public function procesar($id)
    {
        $this->idSolicitud = $id;
        $this->_procesar = true;
    }

    public function procesarsolicitud($opc)
    {
        $this->dispatchBrowserEvent('alertSuccess', ['title' => "Solicitud procesada", 'text' => "Se ha procesado correctamente!"]);
        $this->limpiarCampos();
    }

    public function pdf($id)
    {
        $solicitudes = SolicitudCompra::join('detalle_solicitud_compraa as d', 'solicitud_compra.id_solicitud', '=', 'd.solicitud_id')
            ->where('solicitud_compra.id_solicitud', '=', $id)->get();

         $datos = DB::table('colaborador as c')
        ->select(DB::raw('CONCAT(car.cargo, " ", dp.area) AS cargo'),'c.nombres')
        ->join('cargo as car', 'car.id_cargo', '=', 'c.cargo_id')
        ->join('colaborador_area as cd', 'cd.colaborador_id', '=', 'c.id_colaborador')
        ->join('area as dp', 'dp.id_area', '=', 'cd.area_id')
        ->where('c.nombres', '=', Auth::user()->nombre)
        ->get();
        /* $empresa = Empresa::first(); */
        //return view('livewire.ventas.pdf', compact('ventas'));
        $pdf = PDF::loadView('livewire.solicitudes.pdf', compact('solicitudes','datos'));
        return $pdf->stream('proforma-compra.pdf');
    }

    public function limpiarCampos()
    {
        $this->_procesar = false;
    }
}
