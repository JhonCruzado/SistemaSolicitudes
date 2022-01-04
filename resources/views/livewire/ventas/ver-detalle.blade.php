<x-modal class="modal-lg">
    <div class="modal-header">
        <h6 class="modal-title m-title" id="myModalLabel33">
            <b class="text-wprimary">Detalle</b> - Venta
        </h6>
        <button type="button" class="btn-close" wire:click="$set('_detalle',false)"></button>
    </div>
    @php
        $i = 0;
    @endphp
    <div class="modal-body">
        <div class="table-responsive bg-white table-shadow">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Descuento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalle as $d)
                        <tr>
                            <td>{{ $i += 1; }}</td>
                            <td width="60%">{{ $d->productos->producto }}</td>
                            <td>{{ Nformat($d->cantidad) }}</td>
                            <td>{{ Nformat($d->precio) }}</td>
                            <td>{{ Nformat($d->descuento) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-modal>