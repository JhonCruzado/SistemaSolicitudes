<?php

namespace App\Http\Livewire;

use App\Models\Compra;
use App\Models\DetalleCompra;
use Livewire\Component;
use Livewire\WithPagination;

class ComprasRealizadas extends Component
{
    use WithPagination;
    protected $paginationTheme = 'simple-bootstrap';
    public $paginate = 5;
    public $idSolicitud;

    public $_detalle = false;

    public function render()
    {
        $solicitudes = Compra::orderBy('id_solicitud','DESC')->paginate($this->paginate);
        $detalle = DetalleCompra::where('solicitud_id', '=', $this->idSolicitud)->get();

        return view('livewire.solicitudes.realizadas', compact('solicitudes', 'detalle'));
    }

    public function verDetalle($id)
    {
        $this->idSolicitud = $id;
        $this->_detalle = true;
    }
}
