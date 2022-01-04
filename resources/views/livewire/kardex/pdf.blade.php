<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tarjeta Kardex</title>
    <style>
        html {
            font-family: sans-serif;
            font-size: 13px;
        }

        #documento {
            border: 1px solid #000;
            padding: 3px 5px;
        }

        .header-container,
        .box-container {
            border: 1px solid #000;
            border-radius: 8px;
        }

        .header {
            width: 100%;
            text-align: center;
        }

        .header tbody tr td,
        .content tbody tr td {
            padding: 5px;
        }

        .header tbody tr td span {
            display: block;
        }

        .header-left {
            border-left: 1px solid #000;
        }

        .content,
        .detail,
        .values {
            width: 100%;
        }

        .detail tbody tr td {
            padding: 3px;
        }

        .values tbody tr td {
            padding: 2px;
        }

        .border {
            border-width: 1px;
            border-color: #000;
            border-style: solid;
        }

        .b-right {
            border-left: 1px solid #000;
        }

        .b-bottom {
            border-bottom: 1px solid #000;
        }

    </style>
</head>

<body>
    @php
        function Nformat($money)
        {
            return number_format($money, 2, '.', ',');
        }
    @endphp
    <header class="header-container">
        <table class="header">
            <tbody>
                <tr>
                    <td width="65%" class="header-right">
                        <span style="font-weight: bold; margin-bottom: 3px; font-size: 15px;">{{$empresa->nombre}}</span>
                        <span>{{$empresa->direccion}}</span>
                        <span>Tel: {{$empresa->telefono}}</span>
                    </td>
                    <td class="header-left">
                        <span style="font-weight: bold; margin-bottom: 3px;">TARJETA KARDEX</span>
                        <span>RUC: {{$empresa->ruc}}</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </header><br>
    <section class="box-container">
        <table class="content">
            <tbody>
                <tr>
                    <td>
                        <div style="margin-bottom: 3px;">
                            <span style="font-weight: bold;">Fecha de Emisión:</span>
                            <span>{{ date('d/m/Y H:i A') }}</span>
                        </div>
                        <div style="margin-bottom: 3px;">
                            <span style="font-weight: bold;">Producto:</span>
                            <span>{{ $kardex[0]->productos->producto }}</span>
                        </div>
                        <div style="margin-bottom: 3px;">
                            <span style="font-weight: bold;">Cantidad Total:</span>
                            <span>{{ $kardex[$kardex->count() - 1]->stock_total }}</span>
                        </div>
                        <div>
                            <span style="font-weight: bold;">Valor Total:</span>
                            <span>{{ Nformat($kardex[$kardex->count() - 1]->valor_total) }}</span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </section><br>
    <section class="box-container" style="padding: 8px">
        <table class="detail table-bordered" style="border-collapse: collapse; font-size: 12px; text-align: center;">
            <thead style="border-bottom: 1px solid #000">
                <tr>
                    <th colspan="4" class="b-bottom"></th>
                    <th colspan="2" class="b-right b-bottom" style="color: #28c76f; padding: 5px 0">ENTRADAS</th>
                    <th colspan="2" class="b-right b-bottom" style="color: #ea5455">SALIDAS</th>
                    <th colspan="2" class="b-right b-bottom" style="color: #7367f0">SALDO</th>
                </tr>
                <tr>
                    <th>Fecha</th>
                    <th>N° Documento</th>
                    <th>Operación</th>
                    <th>Valor Unitario</th>
                    <th class="b-right">Cantidad</th>
                    <th>Valor</th>
                    <th class="b-right">Cantidad</th>
                    <th>Valor</th>
                    <th class="b-right">Cantidad</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kardex as $k)
                    <tr>
                        <td width="10%">{{ date('d/m/Y', strtotime($k->fecha)) }}</td>
                        <td width="15%">{{ $k->nrodocumento }}</td>
                        <td width="8%" class="text-center">
                            {{ $k->operacion }}
                        </td>
                        <td width="10%">{{ Nformat($k->valor_unitario) }}</td>
                        <td class="b-right">{{ $k->operacion == 'Compra' ? $k->cantidad : 0 }}</td>
                        <td>{{ $k->operacion == 'Compra' ? Nformat($k->valor) : 0 }}</td>
                        <td class="b-right">{{ $k->operacion == 'Venta' ? $k->cantidad : 0 }}</td>
                        <td>{{ $k->operacion == 'Venta' ? Nformat($k->valor) : 0 }}</td>
                        <td class="b-right">{{ $k->stock_total }}</td>
                        <td>{{ Nformat($k->valor_total) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</body>

</html>
