<x-modal class="modal-md">
    <div class="modal-header">
        <h6 class="modal-title m-title" id="myModalLabel33">
            <b class="text-wwarning">Aviso</b> - Importante
        </h6>
    </div>
    <form class="needs-validation" novalidate>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg">
                    <h6>
                        <i class="fad fa-exclamation-triangle"></i>&nbsp;&nbsp;Información
                    </h6>
                    <div class="row">
                        <div class="col-lg col-md mb-1">
                            <p>Usted no tiene acceso para aperturar la caja, solicite al administrador que realize la apertura!!!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button wire:click="limpiarCampos" type="button" class="btn btn-outline-secondary">Cerrar</button>
        </div>
    </form>
</x-modal>


