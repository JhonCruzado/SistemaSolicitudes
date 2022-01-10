<?php

namespace App\Http\Livewire;

use App\Models\Departamento;
use App\Models\Area;
use Livewire\Component;
use Livewire\WithPagination;
use DB;

class Areas extends Component
{
    use WithPagination;
    protected $paginationTheme = 'simple-bootstrap';
    protected $listeners = ['update', 'delete'];

    public $idArea, $area, $departamento_id; //Model area
    public $estado = 'Habilitado';
    public $departamento, $search;
    public $paginate =5;

    public $_create = false;
    public $_edit = false;
    public $nItems = 0;

    protected $rules = [
        'area' => 'required|unique:area',
        'departamento_id' => 'required|numeric',
        'estado' => 'required|in:Habilitado,Deshabilitado',
    ];

    protected $validationAttributes = [
        'departamento_id' => 'departamento'
    ];

    public function render()
    {
        $departamentos = Departamento::all();
        /* $areas = Area::orderBy('id_area','DESC')
            ->where('departamento_id', 'like', '%' . $this->departamento . '%')
            ->where('area', 'like', '%' . $this->search . '%')
            ->paginate($this->paginate); */
        $areas = DB::table('area as a')
            ->select('a.id_area','a.area','d.departamento','a.estado',)
            ->join('departamento as d', 'd.id_departamento', '=', 'a.departamento_id')
            ->where('a.departamento_id', 'like', '%' . $this->departamento . '%')
            ->where('a.area', 'like', '%' . $this->search . '%')
            ->paginate($this->paginate);

        $nItems = $areas->count();

        return view('livewire.areas.index', compact('departamentos','areas','nItems'));
    }

    public function save()
    {
        $validatedData = $this->validate();
        Area::create($validatedData);

        $this->dispatchBrowserEvent('alertSuccess', ['title' => "Área creada", 'text' => "Se ha creado correctamente!"]);
        $this->limpiarCampos();
    }

    public function edit(Area $model)
    {
        $this->idArea = $model->id_area;
        $this->area = $model->area;
        $this->departamento_id = $model->departamento_id;
        $this->estado = $model->estado;

        $this->_edit = true; //show form to edit
    }

    public function update($id)
    {
        $model = Area::where('area', '=', $this->area)
            ->where('departamento_id', '=', $this->departamento_id)->first();

        if ($model == null || $model->id_area == $id) {
            $this->rules = array_replace($this->rules, ['area' => 'required']);
        }

        $validatedData = $this->validate();
        Area::findOrFail($id)->update($validatedData);

        $this->dispatchBrowserEvent('alertSuccess', ['title' => "Área actualizada", 'text' => "Se ha actualizado correctamente!"]);
        $this->limpiarCampos();
    }

    public function delete($id)
    {
        Area::findOrFail($id)->delete();

        if ($this->nItems === 1) {
            $this->previousPage();
        }

        $this->dispatchBrowserEvent('alertSuccess', ['title' => "Área eliminada", 'text' => "Se ha eliminado correctamente!"]);
        $this->limpiarCampos();
    }

    public function selectedCompanyItem($item)
    {
        if ($item) {
            $this->categoria_id = $item;
        } else {
            $this->company = null;
        }
    }

    public function limpiarCampos()
    {
        $this->reset(['idArea', 'area', 'departamento_id', 'estado']);
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
