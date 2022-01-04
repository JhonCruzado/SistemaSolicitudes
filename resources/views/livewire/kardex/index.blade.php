<main class="content-body">
    <div class="d-flex justify-content-between mb-2">
        <h2 class="content-header-title float-start mb-0 text-dark">Kardex</h2>
        <a target="_blank" class="btn btn-danger" href="/tarjeta-kardex/{{ $idProducto }}">
            <i class="fas fa-file-pdf"></i>&nbsp;&nbsp;PDF
        </a>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card box-shadow">
                <div class="card-body">
                    <h6 class="mb-1">Filtros</h6>
                    <div class="select2-container" wire:ignore>
                        <select class="select2 form-select" id="select2-basic" name="genre_id" wire:model="genre_id">
                            <option value="">--- Seleccionar Producto ---</option>
                            @foreach ($productos as $p)
                                <option value="{{ $p->id_producto }}">{{ $p->producto }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Accordion start -->
    <div class="row">
        <div class="col-sm-12 mb-3">
            <div class="table-responsive bg-white table-shadow">
                <table class="table table-hover table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th colspan="4"></th>
                            <th colspan="2" class="text-success">ENTRADAS</th>
                            <th colspan="2" class="text-danger">SALIDAS</th>
                            <th colspan="2" class="text-primary">SALDO</th>
                        </tr>
                        <tr>
                            <th>Fecha</th>
                            <th>N° Documento</th>
                            <th>Operación</th>
                            <th>Valor Unitario</th>
                            <th>Cantidad</th>
                            <th>Valor</th>
                            <th>Cantidad</th>
                            <th>Valor</th>
                            <th>Cantidad</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kardex as $k)
                            <tr>
                                <td width="10%">{{ date('d/m/Y', strtotime($k->fecha)) }}</td>
                                <td width="15%">{{ $k->nrodocumento }}</td>
                                <td width="8%" class="text-center">
                                    @if ($k->operacion == 'Compra')
                                        <span
                                            class="badge rounded-pill badge-light-success">{{ $k->operacion }}</span>
                                    @else
                                        <span class="badge rounded-pill badge-light-danger">{{ $k->operacion }}</span>
                                    @endif
                                </td>
                                <td width="10%">{{ number_format($k->valor_unitario, 2) }}</td>
                                <td>{{ $k->operacion == 'Compra' ? $k->cantidad : 0 }}</td>
                                <td>{{ $k->operacion == 'Compra' ? number_format($k->valor, 2) : 0 }}</td>
                                <td>{{ $k->operacion == 'Venta' ? $k->cantidad : 0 }}</td>
                                <td>{{ $k->operacion == 'Venta' ? number_format($k->valor, 2) : 0 }}</td>
                                <td>{{ $k->stock_total }}</td>
                                <td>{{ number_format($k->valor_total, 2) }}</td>
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
                        {{ $kardex->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('rs/vendors/css/forms/select/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/colors.css') }}">
    @endpush

    @push('scripts')
        <script src="{{ asset('rs/vendors/js/forms/select/select2.full.min.js') }}"></script>
        <script src="{{ asset('rs/js/scripts/forms/form-select2.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#select2-basic').on('change', function(e) {
                    @this.set('idProducto', e.target.value);
                });
            });
        </script>
    @endpush
</main>
