<?php

namespace App\Http\Livewire;

use App\Models\Departamento;
use Livewire\Component;
use Livewire\WithPagination;

class Departamentos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'simple-bootstrap';
    protected $listeners = ['update', 'delete'];

    public $idDepartamento, $departamento; //Model Departamento
    public $estado = 'Habilitado';
    public $paginate = 5;
    public $search;

    public $_create = false;
    public $_edit = false;
    public $nItems = 0;

    protected $rules = [
        'departamento' => 'required|unique:departamento',
        'estado' => 'required|in:Habilitado,Deshabilitado',
    ];

    public function render()
    {
        $departamentos = Departamento::orderBy('id_departamento','DESC')
            ->where('departamento', 'like', '%' . $this->search . '%')
            ->paginate($this->paginate);
        $nItems = $departamentos->count();

        return view('livewire.departamentos.index' , compact('departamentos', 'nItems'));
    }

    public function save()
    {
        $validatedData = $this->validate();
        Departamento::create($validatedData);

        $this->dispatchBrowserEvent('alertSuccess', ['title' => "Departamento creado", 'text' => "Se ha creado correctamente!"]);
        $this->limpiarCampos();
    }

    public function edit(Departamento $model)
    {
        $this->idDepartamento = $model->id_departamento;
        $this->departamento = $model->departamento;
        $this->estado = $model->estado;

        $this->_edit = true; //show form to edit
    }

    public function update($id)
    {
        $model = Departamento::where('departamento', '=', $this->departamento)->first();

        if ($model == null || $model->id_departamento == $id) {
            $this->rules = array_replace($this->rules, ['departamento' => 'required']);
        }

        $validatedData = $this->validate();

        Departamento::findOrFail($id)->update($validatedData);

        $this->dispatchBrowserEvent('alertSuccess', ['title' => "Departamento actualizado", 'text' => "Se ha actualizado correctamente!"]);
        $this->limpiarCampos();
    }

    public function delete($id)
    {
        Departamento::findOrFail($id)->delete();

        if ($this->nItems === 1) {
            $this->previousPage();
        }

        $this->dispatchBrowserEvent('alertSuccess', ['title' => "Departamento eliminado", 'text' => "Se ha eliminado correctamente!"]);
        $this->limpiarCampos();
    }

    public function limpiarCampos()
    {
        $this->reset(['idDepartamento', 'departamento', 'estado']);
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
