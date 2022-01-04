<main>
    <div class="d-flex justify-content-between mb-2">
        <h2 class="content-header-title float-start mb-0 text-dark">Datos de la empresa</h2>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <form class="card box-shadow">
                <div class="card-body">
                    <div class="mb-1">
                        <label class="form-label label" for="basic-addon-name">Nombre</label>
                        <input wire:model.defer="nombre" type="text"
                            class="form-control @error('nombre') is-invalid @enderror" required />
                        @error('nombre')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label class="form-label label" for="basic-addon-name">RUC</label>
                        <input wire:model.defer="ruc" type="number"
                            class="form-control @error('ruc') is-invalid @enderror" required />
                        @error('ruc')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-1">
                        <label class="form-label label">Margen de utilidad</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">%</span>
                            </div>
                            <input wire:model.defer="margen" type="number"
                                class="form-control @error('margen') is-invalid @enderror" required />
                            @error('margen')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label label" for="basic-addon-name">Teléfono</label>
                        <input wire:model.defer="telefono" type="number"
                            class="form-control @error('telefono') is-invalid @enderror" required />
                        @error('telefono')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label class="form-label label" for="basic-addon-name">Dirección</label>
                        <input wire:model.defer="direccion" type="text"
                            class="form-control @error('direccion') is-invalid @enderror" required />
                        @error('direccion')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="$emit('confirmUpdate',{{ $idEmpresa }})"
                        class="btn btn-primary">
                        <i class="fas fa-save"></i>&nbsp;&nbsp;
                        <span>Guardar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @push('js')
        <script>
            var isRtl = $('html').attr('data-textdirection') === 'rtl'
            const url = 'info-empresa';

            /****** Start events for Categoria *****/

            Livewire.on('confirmUpdate', id => {
                Swal.fire(
                    alertBody("Los datos de la empresa serán actualizados.", 'btn-primary')
                ).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo(url, 'save', id);
                    }
                })
            });

            Livewire.on('alertSuccess', msj => {
                toastr['success'](`${msj}`, 'Progress Bar', {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                    rtl: isRtl
                });
            })

            window.addEventListener('alertSuccess', event => {
                toastr['success'](`${event.detail.text}`, `${event.detail.title}`, {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                    rtl: isRtl
                });
            })

            /****** End events for Tipo *****/

            function alertBody(texto, button) {
                let body = {
                    title: '¿Estás seguro?',
                    text: texto,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn round me-1 ' + button + '',
                        cancelButton: 'btn round btn-secondary',
                    }
                }
                return body;
            }
        </script>
    @endpush
</main>
