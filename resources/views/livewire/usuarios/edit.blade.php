<x-modal>
    <div class="modal-header">
        <h6 class="modal-title m-title" id="myModalLabel33">
            <b class="text-wprimary">Editar</b> - Usuario
        </h6>
    </div>
    <form class="needs-validation" novalidate>
        <div class="modal-body">
            <div class="mb-1">
                <label class="form-label">Nombre</label>
                <input wire:model.defer="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                    required />
                @error('nombre')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-1">
                <label class="form-label">Email</label>
                <input wire:model.defer="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    required />
                @error('email')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-1">
                <label class="form-label">Contraseña</label>
                <input wire:model.defer="password" type="password"
                    class="form-control @error('password') is-invalid @enderror" required />
                @error('password')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-1">
                <label class="form-label">Confirmar contraseña</label>
                <input wire:model.defer="confirm_password" type="password"
                    class="form-control @error('confirm_password') is-invalid @enderror" required />
                @error('confirm_password')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="row">
                <div class="col-lg">
                    <div class="mb-1">
                        <label class="form-label">Rol</label>
                        <select wire:model.defer="rol_id" class="form-select @error('rol_id') is-invalid @enderror"
                            id="select-country1">
                            <option value="">--- Seleccionar ---</option>
                            @foreach ($roles as $r)
                                <option value="{{ $r->id_rol }}">{{ $r->rol }}</option>
                            @endforeach
                        </select>
                        @error('rol_id')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-lg">
                    <div class="mb-1">
                        <label class="form-label">Estado</label>
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
            </div>
        </div>
        <div class="modal-footer">
            <button wire:click="limpiarCampos" type="button" class="btn btn-outline-secondary"
                data-bs-dismiss="modal">Cancelar</button>
            <button wire:click.prevent="$emit('confirmUpdate',{{ $idUsuario }})" type="button"
                class="btn btn-primary" data-bs-dismiss="modal">Actualizar</button>
        </div>
    </form>
</x-modal>
