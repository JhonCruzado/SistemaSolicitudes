<x-modal>
    <div class="modal-header">
        <h6 class="modal-title m-title" id="myModalLabel33">
            <b class="text-wprimary">Agregar</b> - Area
        </h6>
    </div>
    <form wire:submit.prevent="save" class="needs-validation" novalidate>
        <div class="modal-body">
            <div class="mb-1">
                <label class="form-label" for="basic-addon-name">Nombre</label>
                <input wire:model.defer="area" type="text"
                    class="form-control @error('area') is-invalid @enderror" aria-label="Name"
                    aria-describedby="basic-addon-name" required />
                @error('area')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="row">
                <div class="col-lg">
                    <label class="form-label" for="select2-form">Departamento</label>
                    <select wire:model.defer="departamento_id" class="form-select @error('departamento_id') is-invalid @enderror">
                        <option value="">--- Seleccionar ---</option>
                        @foreach ($departamentos as $d)
                            <option value="{{ $d->id_departamento }}">{{ $d->departamento }}</option>
                         @endforeach
                    </select>
                    @error('departamento_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-lg-4">
                    <label class="form-label" for="select-country1">Estado</label>
                    <select wire:model.defer="estado" disabled class="form-select @error('estado') is-invalid @enderror"
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
        </div>
        <div class="modal-footer">
            <button wire:click="limpiarCampos" type="button" class="btn btn-outline-secondary">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</x-modal>
