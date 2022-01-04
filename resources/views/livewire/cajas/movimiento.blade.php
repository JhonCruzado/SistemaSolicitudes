<main class="content-body">
    <div class="d-flex justify-content-between mb-2">
        <h2 class="content-header-title float-start mb-0 text-dark">Historial de Movimientos</h2>
        <a target="_blank" class="btn btn-outline-primary" href="/reporte-movimiento">
            <i class="fal fa-file-pdf"></i>&nbsp;&nbsp;Generar Reporte
        </a>
    </div>
        @if($cantdatos == 0 || $lastregister->estado == 0)
            <div class="d-flex justify-content-between mb-2">
                <div>
                    <button id="ingresar" type="button" class="btn btn-primary" wire:click="$set('_ingreso', true)" disabled>
                    <i class="fal fa-plus-circle"></i>&nbsp;&nbsp;Ingreso&nbsp;&nbsp;
                    </button>
                </div>
                <div class="text-center d-flex align-items-center">
                    <button type="button" class="btn btn-primary {{$cantidadApertura != 0 ? 'd-none' : "" }}" wire:click="$set('_aperturacaja', true)">
                    &nbsp;&nbsp;Abrir Caja&nbsp;&nbsp;<i class="fal fa-lock-open-alt"></i>
                    </button>
                    @if($cantidadApertura != 0)
                        <span class="text-success">
                            La caja ya fue apertura y cerrada.
                        </span>
                    @endif
                </div>
                <div>
                    <button id="egresar" type="button"  class="btn btn-danger" wire:click="$set('_egreso', true)" disabled>
                        <i class="fal fa-minus-circle"></i>&nbsp;&nbsp;Retiro&nbsp;&nbsp;
                    </button>
                </div>
            </div>
        @else
            <div class="d-flex justify-content-between mb-2">
                <button id="ingresar" type="button" class="btn btn-primary" wire:click="$set('_ingreso', true)" >
                    <i class="fal fa-plus-circle"></i>&nbsp;&nbsp;Ingreso&nbsp;&nbsp;
                </button>
                <button id="cerrar" type="button" class="btn btn-danger" wire:click="$set('_cierrecaja', true)">
                    &nbsp;&nbsp;Cerrar Caja&nbsp;&nbsp;<i class="fal fa-lock-open-alt"></i>
                </button>
                <button id="egresar" type="button"  class="btn btn-danger" wire:click="$set('_retiro', true)" >
                    <i class="fal fa-minus-circle"></i>&nbsp;&nbsp;Retiro&nbsp;&nbsp;
                </button>
            </div>
        @endif
    <div class="row">
        <div class="col-sm-12 mb-3">
            <div class="table-responsive bg-white box-shadow">
                <table class="table table-hover"  style="text-align:center">
                    <thead class="table-secondary">
                        <tr>
                            <th>ID</th>
                            <th>Fecha / Hora</th>
                            <th>Descripción</th>
                            <th>Monto</th>
                            <th>Saldo Actual</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movimientos as $m)
                            <tr>
                                <td>
                                    {{ $m->id_caja }}
                                </td>
                                <td>
                                    <div>
                                        {{ date('d/m/Y', strtotime($m->fecha)) }}
                                    </div>
                                    <div>
                                        {{\Carbon\Carbon::parse($m->fecha)->subMinute()->diffForHumans()}}
                                    </div>
                                </td>
                                <td>
                                    {{ $m->descripcion }}
                                </td>
                                <td class="text-center" >
                                    @if($m->tipoMovimiento == 1)
                                        <span class="badge rounded-pill badge-light-success">
                                            S/. {{ number_format($m->monto, 2) }}
                                        </span>
                                    @else
                                        <span class="badge rounded-pill badge-light-danger">
                                            S/. {{ number_format($m->monto, 2) }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    S/. {{ number_format($m->saldo, 2) }}
                                </td>
                                <td class="text-center">
                                    @if($m->estadoMovimiento == '1')
                                        <span class="badge rounded-pill badge-light-success">
                                            Procesado
                                        </span>
                                    @else
                                        <span class="badge rounded-pill badge-light-danger">
                                            Cancelado
                                        </span>
                                    @endif
                                </td>

                                @if($m->descripcion == "Venta")
                                    @foreach($venta as $v)
                                        @if(date('d-m-Y H:i', strtotime($v->fecha)) == date('d-m-Y H:i', strtotime($m->fecha)))
                                            <td>
                                                <button type="button"
                                                class="btn btn-icon btn-icon rounded-circle btn-flat-success title-detalle " wire:click="verDetalle({{ $v->id_venta }})" wire:loading.attr="disabled">
                                                    <i class="fas fa-clipboard-list"></i>
                                                </button>
                                                <a target="_blank"
                                                    class="btn btn-icon rounded-circle btn-flat-danger title-pdf"
                                                    href="/factura-venta/{{ $v->id_venta }}">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                            </td>
                                        @endif
                                    @endforeach
                                @elseif($m->descripcion == "Compra")
                                    @foreach($compra as $c)
                                        @if(date('d-m-Y H:i', strtotime($c->fecha)) == date('d-m-Y H:i', strtotime($m->fecha)))
                                            <td>
                                                <button type="button"
                                                class="btn btn-icon btn-icon rounded-circle btn-flat-success title-detalle " wire:click="verDetalle2({{ $c->id_compra }})" wire:loading.attr="disabled">
                                                    <i class="fas fa-clipboard-list"></i>
                                                </button>
                                            </td>
                                        @endif
                                    @endforeach
                                @else
                                    @if($m->estadoMovimiento == 1)
                                        @if($m->descripcion == "Apertura de Caja")
                                            <td>
                                                <button type="button"
                                                    class="btn btn-icon btn-icon rounded-circle btn-flat-success title-edit"
                                                    wire:click="edit({{ $m->id_caja}})" wire:loading.attr="disabled" >
                                                    <i class="far fa-pen"></i>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-icon btn-icon rounded-circle btn-flat-danger title-delete"
                                                    wire:click="$emit('confirmDelete',{{ $m->id_caja }})"
                                                    wire:loading.attr="disabled" disabled>
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        @else
                                            <td>
                                                <button type="button"
                                                    class="btn btn-icon btn-icon rounded-circle btn-flat-success title-edit"
                                                    wire:click="edit({{ $m->id_caja}})" wire:loading.attr="disabled" >
                                                    <i class="far fa-pen"></i>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-icon btn-icon rounded-circle btn-flat-danger title-delete"
                                                    wire:click="$emit('confirmDelete',{{ $m->id_caja }})"
                                                    wire:loading.attr="disabled">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        @endif
                                    @else
                                        <td>
                                            <button type="button"
                                                class="btn btn-icon btn-icon rounded-circle btn-flat-success title-edit"
                                                wire:click="edit({{ $m->id_caja}})" wire:loading.attr="disabled" disabled>
                                                <i class="far fa-pen"></i>
                                            </button>
                                            <button type="button"
                                                class="btn btn-icon btn-icon rounded-circle btn-flat-danger title-delete"
                                                wire:click="$emit('confirmDelete',{{ $m->id_caja }})"
                                                wire:loading.attr="disabled" disabled>
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    @endif
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex px-1 align-items-center">
                    <div class="col-lg-1">
                        <div class="mb-1">
                            <label class="form-label" for="basicSelect">Mostrar</label>
                            <select wire:model="paginate" class="form-select form-select-sm" id="basicSelect">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg">
                        {{ $movimientos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($_ingreso)
        @include('livewire.cajas.ingreso')
    @endif
    @if (isJL(Auth::user()->roles->rol) || isV(Auth::user()->roles->rol))
        @if ($_aperturacaja)
            @if($cantidadApertura == 0)
                @include('livewire.cajas.aperturacaja')
            @endif
        @endif
    @else
        @if ($_aperturacaja)
            @if($cantdatos == 0 || $lastregister->estado == 0)
                @include('livewire.cajas.mensaje')
            @endif
        @endif
    @endif

    @if ($_cierrecaja)
        @include('livewire.cajas.cierrecaja')
    @endif
    @if ($_retiro)
        @include('livewire.cajas.retiro')
    @endif
    @if ($_edit)
        @include('livewire.cajas.editarcaja')
    @endif
    @if ($_detalle)
        @include('livewire.cajas.detalle')
    @endif
    @if ($_detalle2)
        @include('livewire.cajas.detallecompra')
    @endif

    @push('js')
        <script>
            var isRtl = $('html').attr('data-textdirection') === 'rtl'
            const url = 'cajas';

            /****** Start events for Categoria *****/

            Livewire.on('confirmUpdate', id => {
                Swal.fire(
                    alertBody("El movimiento será actualizado.", 'btn-primary')
                ).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo(url, 'update', id);
                    }
                })
            });

            Livewire.on('confirmDelete', id => {
                Swal.fire(
                    alertBody("El movimiento será eliminado.", 'btn-danger')
                ).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo(url, 'delete', id);
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

             Livewire.on('alertWarning', msj => {
                toastr['warning'](`${msj}`, 'Progress Bar', {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                    rtl: isRtl
                });
            })

            window.addEventListener('alertWarning', event => {
                toastr['warning'](`${event.detail.text}`, `${event.detail.title}`, {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                    rtl: isRtl
                });
            })

            Livewire.on('alertUpdate', msj => {
                toastr['success'](`${msj}`, 'Progress Bar', {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                    rtl: isRtl
                });
            })

            window.addEventListener('alertUpdate', event => {
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
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn round ' + button + '',
                        cancelButton: 'btn round btn-flat-dark',
                    }
                }
                return body;
            }

        </script>
    @endpush

</main>


