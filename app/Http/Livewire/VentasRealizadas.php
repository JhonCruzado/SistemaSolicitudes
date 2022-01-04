<?php

namespace App\Http\Livewire;

use App\Models\DetalleVenta;
use App\Models\Empresa;
use App\Models\Venta;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;

class VentasRealizadas extends Component
{
    use WithPagination;
    protected $paginationTheme = 'simple-bootstrap';
    public $paginate = 5;
    public $idVenta;

    public $_detalle = false;

    public function render()
    {
        $ventas = Venta::orderBy('id_venta','DESC')->paginate($this->paginate);
        $detalle = DetalleVenta::where('venta_id', '=', $this->idVenta)->get();

        return view('livewire.ventas.realizadas', compact('ventas', 'detalle'));
    }

    public function verDetalle($id)
    {
        $this->idVenta = $id;
        $this->_detalle = true;
    }

    public function pdf($id)
    {
        $ventas = Venta::join('detalle_venta as d', 'venta.id_venta', '=', 'd.venta_id')
            ->join('producto as p', 'p.id_producto', '=', 'd.producto_id')
            ->join('unidad_medida as m', 'm.id', '=', 'p.medida_id')
            ->where('venta.id_venta', '=', $id)->get();
        $empresa = Empresa::first();
        //return view('livewire.ventas.pdf', compact('ventas'));
        $pdf = PDF::loadView('livewire.ventas.pdf', compact('ventas','empresa'));
        return $pdf->stream('factura-venta.pdf');
    }
}
