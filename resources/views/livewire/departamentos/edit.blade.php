<x-modal>
    <div class="modal-header">
        <h6 class="modal-title m-title" id="myModalLabel33">
            <b class="text-wprimary">Editar</b> - Departamento
        </h6>
    </div>
    <form class="needs-validation" novalidate>
        <div class="modal-body">
            <div class="mb-1">
                <label class="form-label" for="basic-addon-name">Nombre</label>
                <input wire:model.defer="departamento" type="text"
                    class="form-control @error('departamento') is-invalid @enderror" aria-label="Name"
                    aria-describedby="basic-addon-name" required />
                @error('departamento')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-1">
                <label class="form-label" for="select-country1">Estado</label>
                <select wire:model.defer="estado" class="form-select @error('estado') is-invalid @enderror"
                    id="select-country1" required>
                    <option value="">--- Seleccionar ---</option>
                    <option value="Habilitado">Habilitado</option>
                    <option value="Deshabilitado">Deshabilitado</option>
                </select>
                @error('estado')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button wire:click="limpiarCampos" type="button" class="btn btn-outline-secondary">Cancelar</button>
            <button wire:click="$emit('confirmUpdate',{{ $idDepartamento }})" type="button" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
</x-modal>
