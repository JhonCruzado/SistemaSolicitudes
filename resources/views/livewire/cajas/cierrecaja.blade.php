<x-modal class="modal-md">
    <div class="modal-header">
        <h6 class="modal-title m-title" id="myModalLabel33">
            <b class="text-wsecondary">Cerrar</b> - Caja
        </h6>
    </div>
    <form wire:submit.prevent="save(3)" class="needs-validation" novalidate>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg">
                    <h6>
                        <i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;Información del cierre de caja
                    </h6>
                    <div class="row">
                        <div class="col-lg col-md mb-1">
                            {{-- <input wire:model.defer="descripcion" name="abrir" type="hidden" class="form-control @error('descripcion') is-invalid @enderror" disabled/> --}}
                            <p>Luego de realizar las diversar operaciones de ingresos y retiros de dinero en el transcurso del día, se procede a cerrar caja con un saldo actual de: <b>{{$lastregister->saldo}} soles.</b></p>
                            <span class="text-danger mt-2 d-block">
                                <b>Nota:</b> Una vez realizado esto, ya no se podra volver a aperturar la caja en el transcurso del dia.
                            </span>

                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-lg-6 col-md-6 mb-1">
                            <label class="form-label">Monto</label>
                            <input wire:model.defer="monto" type="number"
                                class="form-control @error('monto') is-invalid @enderror" placeholder="00.00"
                                required />
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button wire:click="limpiarCampos" type="button" class="btn btn-outline-dark">Cancelar</button>
            <button type="submit" class="btn btn-danger">Close</button>
        </div>
    </form>
</x-modal>


