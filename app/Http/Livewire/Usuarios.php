<?php

namespace App\Http\Livewire;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Usuarios extends Component
{
    use WithPagination;
    protected $paginationTheme = 'simple-bootstrap';
    protected $listeners = ['update'];
    public $paginate = 5;
    public $search;
    public $idUsuario, $nombre, $email, $password, $confirm_password, $rol_id, $estado = 'Habilitado';
    public $_create = false;
    public $_edit = false;

    protected $rules = [
        'nombre' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8',
        'confirm_password' => 'required|min:8',
        'rol_id' => 'required|numeric',
        'estado' => 'required|in:Habilitado,Deshabilitado',
    ];

    protected $validationAttributes = [
        'confirm_password' => 'confirmar contraseña',
        'password' => 'contraseña'
    ];

    public function render()
    {
        $roles = Rol::all();
        $usuarios = User::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->paginate);
        return view('livewire.usuarios.usuarios', compact('usuarios', 'roles'));
    }

    public function save()
    {
        $validatedData = $this->validate();

        if ($this->password === $this->confirm_password) {
            $validatedData = array_replace($validatedData, ['password' => Hash::make($this->password)]);
            User::create($validatedData);

            $this->dispatchBrowserEvent('alertSuccess', ['title' => "Mensaje", 'text' => "Se ha creado correctamente!"]);
            $this->limpiarCampos();
        }
    }

    public function edit(User $model)
    {
        $this->idUsuario = $model->id;
        $this->nombre = $model->nombre;
        $this->email = $model->email;
        $this->estado = $model->estado;
        $this->rol_id = $model->rol_id;

        $this->_edit = true;
    }

    public function update($id)
    {
        if (!$this->password && !$this->confirm_password) {
            unset($this->rules['password']);
            unset($this->rules['confirm_password']);
            $validatedData = $this->validate();
        }else{
            $validatedData = $this->validate();
            if ($this->password === $this->confirm_password) {
                $validatedData = array_replace($validatedData, ['password' => Hash::make($this->password)]);
            }
        }

        User::findOrFail($id)->update($validatedData);

        $this->dispatchBrowserEvent('alertSuccess', ['title' => "Mensaje", 'text' => "Se actualizó correctamente!"]);
        $this->limpiarCampos();
    }

    public function limpiarCampos()
    {
        $this->reset(['idUsuario', 'nombre', 'email', 'password', 'confirm_password', 'rol_id']);
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
