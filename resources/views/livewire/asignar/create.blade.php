<x-modal>
    <div class="modal-header">
        <h6 class="modal-title m-title" id="myModalLabel33">
            <b class="text-wprimary">Asignar</b> - Colaborador
        </h6>
    </div>
    <form wire:submit.prevent="save" class="needs-validation" novalidate>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg">
                    <div class="mb-1">
                        <label class="form-label" for="select2-form">Colaboradores</label>
                        <select wire:model.defer="colaborador_id" class="form-select @error('colaborador_id') is-invalid @enderror">
                            <option value="">--- Seleccionar ---</option>
                             @foreach ($colaboradores as $c)
                                <option value="{{ $c->id_colaborador }}">{{$c->nombres}} {{-- - {{$c->cargos->cargo}} --}}</option>
                            @endforeach
                        </select>
                            @error('colaborador_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg">
                    <div class="mb-1">
                        <label class="form-label" for="select2-form">Departamentos</label>
                        <select wire:model.defer="departamento_id" class="form-select @error('departamento_id') is-invalid @enderror">
                            <option value="">--- Seleccionar ---</option>
                            @foreach ($departamento as $d)
                                    <option value="{{ $d->id_departamento }}">{{ $d->departamento }}</option>
                                @endforeach
                        </select>
                            @error('departamento_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg">
                    <div class="mb-1">
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
        </div>
        <div class="modal-footer">
            <button wire:click="limpiarCampos" type="button" class="btn btn-outline-dark"
                data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Guardar</button>
        </div>
    </form>
</x-modal>
