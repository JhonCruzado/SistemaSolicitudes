<?php

namespace App\Http\Livewire;

use App\Models\Colaborador;
use App\Models\Departamento;
use App\Models\Area;
use App\Models\Cargo;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;

class Colaboradores extends Component
{
    use WithPagination;
    protected $paginationTheme = 'simple-bootstrap';
    public $idColaborador, $dni,$nombres, $cargo_id, $direccion, $telefono, $email;
    public $paginate = 5;
    public $nItems = 0;
    public $cargo, $search;
    public $cregistrado,$cargoanterior;
    public $_create = false; //Modal create
    public $_edit = false; //Modal edit

    protected $listeners = ['limpiarCampos', 'update', 'delete'];

    protected $rules = [
        'dni'=>'required|numeric',
        'nombres' => 'required',
        'cargo_id' => 'required|nullable',
        'direccion' => 'required',
        'telefono' => 'required|numeric',
        'email' => 'required|nullable'
    ];

    protected $validationAttributes = [
        'cargo_id' => 'cargo',
    ];

    public function render()
    {
        $cargos = Cargo::get();
        $colaboradores = Colaborador::orderBy('id_colaborador','DESC')
        ->where('cargo_id', 'like', '%' . $this->cargo . '%')
        ->where('nombres', 'like', '%' . $this->search . '%')
        ->where('dni', 'like', '%' . $this->search . '%')
        ->paginate($this->paginate);
        $this->nItems = $colaboradores->count();

        return view('livewire.colaboradores.index', compact('colaboradores','cargos'));
    }

    public function buscandoDatos()
    {
        $nrodoc = $this->dni;
        if (strlen($nrodoc)== 8) {
            $url = Http::get('https://dniruc.apisperu.com/api/v1/dni/'.$nrodoc.'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InNhbXllc2h1YTcyN0BnbWFpbC5jb20ifQ.0z14bKT2JWPsbs2y9j40RWrW_RvG9XaXtwUh2MRGOyQ');
            if ($url->json('nombres')) {
                $this->nombres = $url->json('nombres').' '.$url->json('apellidoPaterno').' '.$url->json('apellidoMaterno');
            } else{
                $this->dispatchBrowserEvent('alertWarning', ['title' => "Datos incorrectos", 'text' => "Error inesperado, no se encontraron resultados !!"]);
                return 0;
            }
        } else if (strlen($nrodoc) >8){
             $this->dispatchBrowserEvent('alertWarning', ['title' => "Datos incorrectos", 'text' => "Error inesperado, por favor verifique sus datos ingresados !!"]);
             return 0;
        } else if (strlen($nrodoc) == 0){
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

        $dnis = Colaborador::where('dni', '=', $this->dni)->count();
        $cargos = Colaborador::where('cargo_id', '=', $this->cargo_id)->get();
        $cantCargos = Colaborador::where('cargo_id', '=', $this->cargo_id)->count();
        $cantDep = Departamento::count();
        $cantAreas = Area::count();

        if($dnis > 0){
            $this->dispatchBrowserEvent('alertWarning', ['title' => "Error", 'text' => "El DNI ingresado ya se encuentra registrado!"]);
             return 0;
        } else{
            if ($cargos->count() == 0) {
                $cargo_old = 0;
            }else{
                foreach ($cargos as $c ) {
                    $cargo_old = $c->cargo_id;
                }
            }

            if ($cargo_old == 2 && $cantCargos == $cantAreas) {
                $this->dispatchBrowserEvent('alertWarning', ['title' => "Error", 'text' => "El cargo seleccionado ya no puede ser asignado!"]);
                return 0;
            } else if ($cargo_old == 3 && $cantCargos == $cantDep) {
                $this->dispatchBrowserEvent('alertWarning', ['title' => "Error", 'text' => "El cargo seleccionado ya no puede ser asignado!"]);
                return 0;
            } else if ($cargo_old == 4 && $cantCargos == 1) {
                $this->dispatchBrowserEvent('alertWarning', ['title' => "Error", 'text' => "El cargo seleccionado ya no puede ser asignado!"]);
                return 0;
            } else{
                Colaborador::create($validatedData);
                $this->dispatchBrowserEvent('alertSuccess', ['title' => "Colaborador registrado", 'text' => "Se ha registrado correctamente!"]);
                $this->limpiarCampos();
            }
        }
    }

    public function edit(Colaborador $model)
    {
        $this->idColaborador = $model->id_colaborador;
        $this->nombres = $model->nombres;
        $this->dni = $model->dni;
        $this->cargo_id = $model->cargo_id;
        $this->telefono = $model->telefono;
        $this->email = $model->email;
        $this->direccion = $model->direccion;
        $this->_edit = true;
    }

    public function update($id)
    {
        $validatedData = $this->validate();

        if ($this->email) {
            $this->validate(['email' => 'email']);
        }

        Colaborador::findOrFail($id)->update($validatedData);
        $this->dispatchBrowserEvent('alertSuccess', ['title' => "Colaborador actualizado", 'text' => "Se ha actualizado correctamente!"]);
        $this->limpiarCampos();
    }

    public function delete($id)
    {
        Colaborador::findOrFail($id)->delete();

        if ($this->nItems === 1) {
            $this->previousPage();
        }

        $this->dispatchBrowserEvent('alertSuccess', ['title' => "Colaborador eliminado", 'text' => "Se ha eliminado correctamente!"]);
        $this->limpiarCampos();
    }

    public function limpiarCampos()
    {
        $this->reset(['idColaborador', 'dni','nombres', 'cargo_id','direccion','telefono','email']);
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
