<x-modal>
    <div class="modal-header">
        <h6 class="modal-title m-title" id="myModalLabel33">
            <b class="text-wprimary">Editar</b> - Contacto
        </h6>
    </div>
    <form class="needs-validation" novalidate>
        <div class="modal-body">
            <h6>Información del proveedor</h6>
            <div class="row">
                <div class="col-lg">
                    <div class="mb-1">
                        <label class="form-label" for="select-country1">Documento</label>
                        <select wire:model.defer="documento"
                            class="form-select @error('documento') is-invalid @enderror" required>
                            <option value="">--- Seleccionar ---</option>
                            @foreach ($tipoDoc as $t)
                                <option value="{{ $t->id }}">{{ $t->tipo }}</option>
                            @endforeach
                        </select>
                        @error('documento')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-lg">
                    <div class="mb-1">
                        <label class="form-label label">Nro Documento</label>
                        <div class="input-group">
                            <input wire:model.defer="nrodocumento" type="number" class="form-control">
                            <a wire:click="buscandoDatos()" class="btn btn-primary" id="button-addon2" type="button">
                                <i class="far fa-search-plus"></i>
                            </a>
                        </div>
                        @error('nrodocumento')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-1">
                <label class="form-label">Nombre</label>
                <input wire:model.defer="raz_social" type="text"
                    class="form-control @error('raz_social') is-invalid @enderror" required />
                @error('raz_social')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-1">
                <label class="form-label">Dirección</label>
                <input wire:model.defer="direccion" type="text"
                    class="form-control @error('direccion') is-invalid @enderror" required />
                @error('direccion')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <h6>Información del contacto</h6>
            <div class="mb-1">
                <label class="form-label">Nombre</label>
                <input wire:model.defer="contacto" type="text"
                    class="form-control @error('contacto') is-invalid @enderror" required />
                @error('contacto')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-1">
                        <label class="form-label">Telefono</label>
                        <input wire:model.defer="telefono" type="text"
                            class="form-control @error('telefono') is-invalid @enderror" required />
                        @error('telefono')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-lg">
                    <div class="mb-1">
                        <label class="form-label">Correo</label>
                        <input wire:model.defer="email" type="text"
                            class="form-control @error('email') is-invalid @enderror" required />
                        @error('email')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button wire:click="limpiarCampos" type="button" class="btn btn-outline-dark"
                data-bs-dismiss="modal">Cancelar</button>
            <button wire:click="$emit('confirmUpdate',{{ $idProveedor }})" type="button" class="btn btn-primary" data-bs-dismiss="modal">Actualizar</button>
        </div>
    </form>
</x-modal>
