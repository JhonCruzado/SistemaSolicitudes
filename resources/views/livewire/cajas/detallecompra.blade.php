<x-modal class="modal-lg">
    <div class="modal-header">
        <h6 class="modal-title m-title" id="myModalLabel33">
            <b class="text-wprimary">Detalle</b> - Compra
        </h6>
        <button type="button" class="btn-close" wire:click="$set('_detalle2',false)"></button>
    </div>
    @php
        $i = 0;
    @endphp
    <div class="modal-body">
        <div class="table-responsive bg-white table-shadow">
            <table class="table table-hover" style="text-align:center">
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
                    @foreach ($detallecompra as $de)
                        <tr>
                            <td>{{ $i += 1; }}</td>
                            <td width="60%">{{ $de->productos->producto }}</td>
                            <td style="text-align:center">{{ number_format($de->cantidad) }}</td>
                            <td style="text-align:center">{{ number_format($de->precio) }}</td>
                            <td style="text-align:center">{{ number_format($de->descuento) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="container mt-3">
                @foreach($compra2 as $co)
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-10" style="text-align:right">
                                    <p><b>Sub Total:</b></p>
                                </div>
                                <div class="col" style="text-align:center">
                                  <p>S/. {{ number_format($co->subtotal) }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-10" style="text-align:right">
                                    <p><b>IGV (18%):</b></p>
                                </div>
                                <div class="col" style="text-align:center">
                                    <p>S/. {{ number_format($co->igv) }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-10" style="text-align:right">
                                    <p><b>Total:</b></p>
                                </div>
                                <div class="col" style="text-align:center">
                                    <p>S/. {{ number_format($co->total) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-modal>
