<?php

namespace App\Http\Livewire;

use App\Models\Empresa;
use Livewire\Component;

class InfoEmpresa extends Component
{
    protected $listeners = ['save'];
    public $idEmpresa, $nombre, $ruc, $telefono, $direccion, $margen;

    protected $rules = [
        'nombre' => 'required|max:40',
        'ruc' => 'required|min:11|max:11',
        'telefono' => 'required|max:15',
        'direccion' => 'required|max:80',
        'margen' => 'required|numeric|min:1|max:100'
    ];

    public function render()
    {
       /*  $empresa = Empresa::first();
        $this->idEmpresa = $empresa->id;
        $this->nombre = $empresa->nombre;
        $this->ruc = $empresa->ruc;
        $this->telefono = $empresa->telefono;
        $this->direccion = $empresa->direccion;
        $this->margen = $empresa->margen; */
        return view('info-empresa'/* ,compact('empresa') */);
    }

    public function save($id){
        $validatedData = $this->validate();
        Empresa::findOrFail($id)->update($validatedData);
        $this->dispatchBrowserEvent('alertSuccess', ['title' => "Mensaje", 'text' => "Se actualizó correctamente!"]);
    }
}
