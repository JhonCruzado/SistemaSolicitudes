<?php

namespace App\Http\Livewire;

use App\Models\Proveedor;
use App\Models\TipoDocumento;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;

class Proveedores extends Component
{
    use WithPagination;
    protected $paginationTheme = 'simple-bootstrap';
    public $idProveedor, $raz_social, $documento, $nrodocumento, $direccion, $contacto, $telefono, $email;
    public $paginate = 5;
    public $nItems = 0;
    public $search;
    public $_create = false; //Modal create
    public $_edit = false; //Modal edit

    protected $listeners = ['update', 'delete'];

    protected $rules = [
        'raz_social' => 'required',
        'documento' => 'required|numeric',
        'nrodocumento' => 'required|numeric',
        'contacto' => 'required',
        'direccion' => 'required',
        'telefono' => 'required|numeric',
        'email' => 'nullable'
    ];

    protected $validationAttributes = [
        'raz_social' => 'nombre',
        'nrodocumento' => 'nro documento',
        'email' => 'correo',
        'contacto' => 'nombre'
    ];

    public function render()
    {
        $tipoDoc = TipoDocumento::all();
        $proveedores = Proveedor::orderBy('id_proveedor','DESC')->where('raz_social', 'like', '%' . $this->search . '%')
            ->orWhere('nrodocumento', 'like', '%' . $this->search . '%')->paginate($this->paginate);
        $this->nItems = $proveedores->count();

        return view('livewire.proveedores.index', compact('tipoDoc', 'proveedores'));
    }

    public function buscandoDatos()
    {
        $nrodoc = $this->nrodocumento;
        if (strlen($nrodoc)== 8 && $this->documento == 1) {
            $url = Http::get('https://dniruc.apisperu.com/api/v1/dni/'.$nrodoc.'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InNhbXllc2h1YTcyN0BnbWFpbC5jb20ifQ.0z14bKT2JWPsbs2y9j40RWrW_RvG9XaXtwUh2MRGOyQ');
            $this->raz_social = $url->json('nombres').' '.$url->json('apellidoPaterno').' '.$url->json('apellidoMaterno');
        } else if (strlen($nrodoc)== 11 && $this->documento == 2) {
            $url = Http::get('https://dniruc.apisperu.com/api/v1/ruc/'.$nrodoc.'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InNhbXllc2h1YTcyN0BnbWFpbC5jb20ifQ.0z14bKT2JWPsbs2y9j40RWrW_RvG9XaXtwUh2MRGOyQ');
           /*  dd($url->json()); */
            $this->raz_social = $url->json('razonSocial');
            $this->direccion = $url->json('direccion');
        } else if (strlen($nrodoc)== 12 && $this->documento == 3){
             $this->dispatchBrowserEvent('alertWarning', ['title' => "Datos no encontrados", 'text' => "Error inesperado, por favor registre sus datos!"]);
             return 0;
        } else  if ($this->documento == null){
             $this->dispatchBrowserEvent('alertWarning', ['title' => "Error", 'text' => "Seleccione un documento!"]);
             return 0;
        } else{
             $this->dispatchBrowserEvent('alertWarning', ['title' => "Error", 'text' => "Ingrese el número de documento!"]);
             return 0;
        }
    }

    public function save()
    {
        $validatedData = $this->validate();

        if ($this->email) {
            $this->validate(['email' => 'email']);
        }

        Proveedor::create($validatedData);

        $this->dispatchBrowserEvent('alertSuccess', ['title' => "Proveedor agregado", 'text' => "Se agregó correctamente!"]);
        $this->limpiarCampos();
    }

    public function edit(Proveedor $model)
    {
        $this->idProveedor = $model->id_proveedor;
        $this->raz_social = $model->raz_social;
        $this->documento = $model->documento;
        $this->nrodocumento = $model->nrodocumento;
        $this->direccion = $model->direccion;
        $this->contacto = $model->contacto;
        $this->telefono = $model->telefono;
        $this->email = $model->email;

        $this->_edit = true;
    }

    public function update($id)
    {
        $validatedData = $this->validate();

        if ($this->email) {
            $this->validate([
                'email' => 'email'
            ]);
        }

        Proveedor::findOrFail($id)->update($validatedData);

        $this->dispatchBrowserEvent('alertSuccess', ['title' => "Proveedor actualizado", 'text' => "Se actualizó correctamente!"]);
        $this->limpiarCampos();
    }

    public function delete($id)
    {
        Proveedor::findOrFail($id)->delete();

        if ($this->nItems === 1) {
            $this->previousPage();
        }

        $this->dispatchBrowserEvent('alertSuccess', ['title' => "Proveedor eliminado", 'text' => "Se eliminó correctamente!"]);
        $this->limpiarCampos();
    }

    public function limpiarCampos()
    {
        $this->reset(['idProveedor', 'raz_social', 'documento', 'nrodocumento', 'direccion', 'contacto', 'telefono', 'email']);
        $this->_create = false;
        $this->_edit = false;
        $this->limpiarValidation();
    }

    public function limpiarValidation()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
