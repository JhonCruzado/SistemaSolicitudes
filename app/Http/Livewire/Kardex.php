<?php

namespace App\Http\Livewire;

use App\Models\Empresa;
use App\Models\Kardex as ModelsKardex;
use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;

class Kardex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'simple-bootstrap';
    public $paginate = 5;

    public $idProducto;

    public function render()
    {
        $productos = Producto::all();
        $kardex = ModelsKardex::where('producto_id', '=', $this->idProducto)->paginate($this->paginate);

        return view('livewire.kardex.index', compact('productos', 'kardex'));
    }
    public function pdf($id = null)
    {
        if(!$id){
            echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
        }
        $kardex = ModelsKardex::where('producto_id', '=', $id)->get();
        $empresa = Empresa::first();
        //return view('livewire.kardex.pdf', compact('kardex'));
        $pdf = PDF::loadView('livewire.kardex.pdf', compact('kardex', 'empresa'));
        return $pdf->stream('kardex.pdf');
    }
}
