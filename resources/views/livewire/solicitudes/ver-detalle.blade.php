<x-modal class="modal-md">
    <div class="modal-header">
        <h6 class="modal-title m-title" id="myModalLabel33">
            <b class="text-wprimary">Detalle</b> - solicitud
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalle as $d)
                        <tr>
                            <td>{{ $i += 1; }}</td>
                            <td>{{ $d->producto }}</td>
                            <td>{{ ($d->cantidad) }}</td>
                            <td>{{ Nformat($d->precio) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-modal>
