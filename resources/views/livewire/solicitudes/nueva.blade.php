<main class="content-body">
    <div class="d-flex justify-content-between mb-2">
        <h2 class="content-header-title float-start mb-0 text-dark">Nueva solicitud de compra</h2>
    </div>
    @php
        function Nformat($money)
        {
            return number_format($money, 2, '.', ',');
        }
    @endphp
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="m-0">
                                    <i class="fas fa-box"></i>&nbsp;&nbsp;Información de la solicitud
                                </h6>
                            </div>
                            <div class="row">
                                <div class="col-lg mb-1">
                                    <div class="form-group mb-1 input">
                                        <label class="form-label label">Solicitante</label>
                                        <div class="input-group">
                                            <input value="{{ Auth::user()->nombre }}" type="text" class="form-control" disabled>
                                            {{-- <button wire:click="$set('_colaborador', true)" class="btn btn-info" id="button-addon2"
                                                type="button">
                                                <i class="far fa-user-plus"></i>
                                            </button> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 mb-1">
                                    <div class="form-group input">
                                        <label class="form-label label">Grado de Urgencia</label>
                                        {{-- <input wire:model="grado" class="form-control" type="text" > --}}
                                        <select wire:model="grado" class="form-select">
                                        <option value="">--- Opciones ---</option>
                                        @foreach ($grados as $g)
                                            <option value="{{ $g->id_urgencia }}">{{ $g->grado }}</option>
                                        @endforeach
                                    </select>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-lg-2 mb-1">
                                    <div class="form-group input">
                                        <label class="form-label label">Codigo</label>
                                        <div class="input-group">
                                            <input wire:model="codigo" type="number" class="form-control">
                                            <button wire:click="buscarProducto" class="btn btn-info" id="button-addon2"
                                                type="button">
                                                <i class="far fa-search-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-lg-5 mb-1">
                                    <div class="form-group input">
                                        <label class="form-label label">Producto</label>
                                        <input wire:model="producto" class="form-control" type="text" >
                                    </div>
                                </div>
                                <div class="col-lg mb-1">
                                    <div class="form-group input">
                                        <label class="form-label label">Precio</label>
                                        <input wire:model="precio" class="form-control box" type="number"
                                            placeholder="0.00">
                                    </div>
                                </div>
                                <div class="col-lg mb-1">
                                    <div class="form-group input">
                                        <label class="form-label label">Cantidad</label>
                                        <input wire:model="cantidad" class="form-control box" type="number"
                                            placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 mb-1">
                                    <div class="form-group input">
                                        <label class="form-label label">Subtotal</label>
                                        <input value="{{ Nformat($_subtotal) }}" class="form-control" type="text"
                                            placeholder="0.00" disabled>
                                    </div>
                                </div>
                                <form class="col-lg mb-1 text-end" wire:submit.prevent="addDetalle">
                                    <button type="submit" wire:loading.attr="disabled"
                                        class="btn btn-outline-primary mt-1" @if (!$add) disabled @endif>
                                        <i class="far fa-plus"></i>
                                        <span>Agregar</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-2">
                    <div class="table-responsive bg-white table-shadow">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Codigo</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                    <th>Quitar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($table) > 0)
                                    @foreach ($table as $t)
                                        <tr>
                                            <td>{{ $t['codigo'] }}</td>
                                            <td title="{{ $t['producto'] }}">
                                                {{ substr($t['producto'], 0, 30) }}{{ strlen($t['producto']) > 30 ? '...' : '' }}
                                            </td>
                                            <td>{{ Nformat($t['precio']) }}</td>
                                            <td>{{ $t['cantidad'] }}</td>
                                            <td>{{ Nformat($t['subtotal']) }}</td>
                                            <td>
                                                <button title="Quitar" wire:click="removeDetalle({{ $t['codigo'] }})"
                                                    class="btn icon-btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- <tr class="font-weight-bold">
                                        <td colspan="3"></td>
                                        <td>Total:</td>
                                        <td>{{ Nformat($total) }}</td>
                                        <td></td>
                                    </tr> --}}
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            No hay registros
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <h6>
                        <i class="fas fa-clipboard-list"></i>&nbsp;&nbsp;Datos de la solicitud
                    </h6>
                    <div class="form-group mb-1">
                        <label class="form-label label">Fecha</label>
                        <input type="date" value="{{ date('Y-m-d') }}" class="form-control" type="text" disabled>
                    </div>
                    <div class="form-group mb-1">
                        <label class="form-label label">Cantidad total</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">#</span>
                            </div>
                            <input type="number" class="form-control" placeholder="0.00" wire:model="cantotal" disabled>
                        </div>
                    </div>
                    <div class="form-group mb-1">
                        <label class="form-label label">Total</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">S/</span>
                            </div>
                            <input type="text" class="form-control" wire:model="total" placeholder="0.00" disabled>
                        </div>
                    </div>
                    <div class="text-center">
                        <button wire:click="save" type="button" wire:loading.attr="disabled" class="btn btn-primary mt-1">
                            <i class="fas fa-save"></i>
                            <span>Enviar solicitud</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($_colaborador)
        @include('livewire.solicitudes.colaboradores')
    @endif
    @push('js')
        <script>
            var isRtl = $('html').attr('data-textdirection') === 'rtl'
            const url = 'nueva-venta';
            window.addEventListener('alertSuccess', event => {
                toastr['success'](`${event.detail.text}`, `${event.detail.title}`, {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                    rtl: isRtl
                });
            });
            window.addEventListener('alertWarning', event => {
                toastr['warning'](`${event.detail.text}`, `${event.detail.title}`, {
                    closeButton: true,
                    tapToDismiss: false,
                    progressBar: true,
                    rtl: isRtl
                });
            })
        </script>
    @endpush
</main>
