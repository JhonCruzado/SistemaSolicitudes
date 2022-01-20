<x-modal class="modal-md">
    <div class="modal-header">
        <h6 class="modal-title m-title" id="myModalLabel33">
            <b class="text-wprimary">Procesar </b> - Solicitud
        </h6>
    </div>
    <form wire:submit.prevent="procesarsolicitud(2)" class="needs-validation" name="apertura" novalidate>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg">
                    <h6>
                        <i class="fal fa-paper-plane"></i></i>&nbsp;&nbsp;Información de la solicitud de compra
                    </h6>
                    <div class="row">
                        <div class="col-lg col-md mb-1">
                             <p>La solicitud de compra tiene las aprobaciones necesarias para su procesamiento, por ende esta será enviada por correo electrónico al área de Logística para adquisición.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button wire:click="limpiarCampos" type="button" class="btn btn-outline-dark">Cancelar</button>
            <button type="submit" class="btn btn-primary">Procesar</button>
        </div>
    </form>
</x-modal>


