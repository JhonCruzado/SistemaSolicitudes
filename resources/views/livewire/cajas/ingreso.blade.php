<x-modal class="modal-md" >
    <div class="modal-header">
        <h6 class="modal-title m-title" id="myModalLabel33">
            <b class="text-wprimary">Ingresar</b> - Dinero
        </h6>
    </div>
    <form wire:submit.prevent="save(1)" class="needs-validation" novalidate>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg">
                    <h6>
                        <i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;Información del ingreso
                    </h6>
                    <div class="row">
                        <div class="col-lg col-md mb-1">
                            <label class="form-label">Descripción</label>
                            <input wire:model.defer="descripcion" type="text"
                                class="form-control @error('descripcion') is-invalid @enderror" required />
                            @error('descripcion')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 mb-1">
                            <label class="form-label">Monto</label>
                            <input wire:model.defer="monto" type="number"
                                class="form-control @error('monto') is-invalid @enderror" placeholder="00.00"
                                required />
                            @error('monto')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button wire:click="limpiarCampos" type="button" class="btn btn-outline-dark">Cancelar</button>
            <button type="submit" class="btn btn-primary" >Ingresar</button>
        </div>
    </form>
</x-modal>
