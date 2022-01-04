<?php

namespace App\Http\Livewire;

use App\Models\Colaborador;
use App\Models\Departamento;
use App\Models\AsignarColaborador;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use DB;

class AsignarColaboradores extends Component
{
    use WithPagination;
    protected $paginationTheme = 'simple-bootstrap';
    public $id_col_dep, $colaborador_id, $departamento_id;
    public $estado = 'Habilitado';
    public $paginate = 5;
    public $nItems = 0;
    public $cargo, $search;
    public $_create = false; //Modal create
    public $_edit = false; //Modal edit

    protected $listeners = ['limpiarCampos', 'update', 'delete'];

    protected $rules = [
        'colaborador_id' => 'required|numeric',
        'departamento_id' => 'required|numeric',
        'estado' => 'required|in:Habilitado,Deshabilitado',
    ];

    protected $validationAttributes = [
        'colaborador_id' => 'colaborador',
        'departamento_id' => 'departamento',
    ];

    public function render()
    {
        $departamento = Departamento::
            whereNotExists(function($query)
            {
                $query->select(DB::raw(1))
                        ->from('colaborador_dep')
                        ->whereRaw('colaborador_dep.departamento_id = departamento.id_departamento');
            })->get();

        $colaboradores= Colaborador::
            where('cargo_id','=','3')
            ->whereNotExists(function($query)
            {
                $query->select(DB::raw(1))
                        ->from('colaborador_dep')
                        ->whereRaw('colaborador_dep.colaborador_id = colaborador.id_colaborador');
            })->get();

        $colDep = AsignarColaborador::orderBy('id_col_dep','DESC')
        ->where('colaborador_id', 'like', '%' . $this->cargo . '%')
        ->where('departamento_id', 'like', '%' . $this->search . '%')
        ->paginate($this->paginate);
        $this->nItems = $colDep->count();
        $cantAsignada = $colDep->count();

        return view('livewire.asignar.index',compact('departamento','colDep','colaboradores','cantAsignada'));
    }

    /* public function buscandoDatos()
    {
        $nrodoc = $this->dni;
        if (strlen($nrodoc)== 8) {
            $url = Http::get('https://dniruc.apisperu.com/api/v1/dni/'.$nrodoc.'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InNhbXllc2h1YTcyN0BnbWFpbC5jb20ifQ.0z14bKT2JWPsbs2y9j40RWrW_RvG9XaXtwUh2MRGOyQ');
            $this->nombres = $url->json('nombres').' '.$url->json('apellidoPaterno').' '.$url->json('apellidoMaterno');
        } else if (strlen($nrodoc) >8){
             $this->dispatchBrowserEvent('alertWarning', ['title' => "Datos incorrectos", 'text' => "Error inesperado, por favor verifique sus datos ingresados !!"]);
             return 0;
        } else if (strlen($nrodoc) == 0){
             $this->dispatchBrowserEvent('alertWarning', ['title' => "Error", 'text' => "Ingrese el número de documento!"]);
             return 0;
        }
    } */

    public function save()
    {
        $validatedData = $this->validate();
        AsignarColaborador::create($validatedData);
        $this->dispatchBrowserEvent('alertSuccess', ['title' => "Jefe de Departamento registrado", 'text' => "Se ha registrado correctamente!"]);
        $this->limpiarCampos();
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

        // Evaluando datos registrados
        /* $datos2 = Colaborador::where('dni', '=', $this->dni)->count(); */
        /* if($datos2 > 0){
            $this->dispatchBrowserEvent('alertWarning', ['title' => "Error", 'text' => "El DNI ingresado ya se encuentra registrado!"]);
             return 0;
        }
        else  */
        if ($this->cargo_id != 1) {
             $datos = Colaborador::where('cargo_id', '=', $this->cargo_id)->get();
             if ($datos->dni == $this->dni) {
                 Colaborador::findOrFail($id)->update($validatedData);
                $this->dispatchBrowserEvent('alertSuccess', ['title' => "Colaborador actualizado", 'text' => "Se ha actualizado correctamente!"]);
                $this->limpiarCampos();
             }
            $this->dispatchBrowserEvent('alertWarning', ['title' => "Error", 'text' => "No podemos actualizar al colaborador con el cargo seleccionado!"]);
             return 0;
        } else{
            Colaborador::findOrFail($id)->update($validatedData);
            $this->dispatchBrowserEvent('alertSuccess', ['title' => "Colaborador actualizado", 'text' => "Se ha actualizado correctamente!"]);
            $this->limpiarCampos();
        }
    }

    public function delete($id)
    {
        AsignarColaborador::findOrFail($id)->delete();

        if ($this->nItems === 1) {
            $this->previousPage();
        }

        $this->dispatchBrowserEvent('alertSuccess', ['title' => "Jefe asignado eliminado", 'text' => "Se ha eliminado correctamente!"]);
        $this->limpiarCampos();
    }

    public function limpiarCampos()
    {
        $this->reset(['id_col_dep', 'colaborador_id','departamento_id', 'estado']);
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
