<x-modal>
    <div class="modal-header">
        <h6 class="modal-title m-title" id="myModalLabel33">
            <b class="text-wprimary">Agregar</b> - Colaborador
        </h6>
    </div>
    <form wire:submit.prevent="save" class="needs-validation" novalidate>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-5">
                    <div class="mb-1">
                        <label class="form-label">DNI</label>
                         <div class="input-group">
                            <input wire:model.defer="dni" type="text"
                                class="form-control @error('dni') is-invalid @enderror" required />
                            <a wire:click="buscandoDatos()" class="btn btn-primary" id="button-addon2" type="button">
                                <i class="far fa-search-plus"></i>
                            </a>
                        </div>
                        @error('dni')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-lg">
                    <div class="mb-1">
                        <label class="form-label" for="basic-addon-name">Nombres</label>
                        <input wire:model.defer="nombres" type="text" class="form-control @error('nombre') is-invalid @enderror"
                            aria-label="Name" aria-describedby="basic-addon-name" required disabled />
                        @error('nombre')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg">
                    <div class="mb-1">
                        <label class="form-label" for="select2-form">Cargo</label>
                        <select wire:model.defer="cargo_id" class="form-select @error('cargo_id') is-invalid @enderror">
                            <option value="">--- Seleccionar ---</option>
                            @foreach ($cargos as $d)
                                <option value="{{ $d->id_cargo }}">{{ $d->cargo }}</option>
                            @endforeach
                        </select>
                            @error('cargo_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                </div>
                <div class="col-lg">
                    <div class="mb-1">
                        <label class="form-label" for="basic-addon-name">Telefono</label>
                        <input wire:model.defer="telefono" type="number"
                            class="form-control @error('telefono') is-invalid @enderror" aria-label="Name"
                            aria-describedby="basic-addon-name" required />
                        @error('telefono')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-1">
                <label class="form-label" for="basic-addon-name">Email</label>
                <input wire:model.defer="email" type="text" class="form-control @error('email') is-invalid @enderror"
                    aria-label="Name" aria-describedby="basic-addon-name" required />
                @error('email')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-1">
                <label class="form-label" for="basic-addon-name">Direcci??n</label>
                <input wire:model.defer="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" aria-label="Name" aria-describedby="basic-addon-name" required />
                @error('direccion')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button wire:click="limpiarCampos" type="button" class="btn btn-outline-dark"
                data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Guardar</button>
        </div>
    </form>
</x-modal>
