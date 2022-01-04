<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Movimientos</title>
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
                        <span style="font-weight: bold; margin-bottom: 3px;">REPORTE DE MOVIMIENTOS</span>
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
                            <span style="font-weight: bold;">Cantidad Movimientos:</span>
                            <span>{{ $reporte->count() }}</span>
                        </div>
                        <div>
                            <span style="font-weight: bold;">Monto Actual en Caja:</span>
                            <span>{{ Nformat($lastregister->saldo) }}</span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </section><br>
    <section class="box-container" style="padding: 8px">
        <table class="detail table-bordered" style="border-collapse: collapse; font-size: 12px; text-align: center;">
            <thead style="border-bottom: 1px solid #000">
                {{-- <tr>
                    <th colspan="4" class="b-bottom"></th>
                    <th colspan="2" class="b-right b-bottom" style="color: #28c76f; padding: 5px 0">ENTRADAS</th>
                    <th colspan="2" class="b-right b-bottom" style="color: #ea5455">SALIDAS</th>
                    <th colspan="2" class="b-right b-bottom" style="color: #7367f0">SALDO</th>
                </tr> --}}
                <tr>
                    <th>Hora</th>
                    <th>Operación</th>
                    <th>Tipo Movimiento</th>
                    <th>Monto</th>
                    <th>Saldo</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reporte as $r)
                    <tr>
                        <td width="10%">{{\Carbon\Carbon::parse($r->fecha)->toTimeString()}}</td>
                        <td width="10%" class="text-center">
                            {{ $r->descripcion }}
                        </td>
                        @if($r->tipoMovimiento == 1)
                            <td width="10%">Ingreso</td>
                        @else
                            <td width="10%">Egreso</td>
                        @endif
                        @if($r->monto < 0)
                            <td width="10%">{{ Nformat($r->monto*-1) }}</td>
                        @else
                            <td width="10%">{{ Nformat($r->monto) }}</td>
                        @endif
                        <td width="10%">{{ Nformat($r->saldo) }}</td>
                        @if($r->estadoMovimiento == 1)
                            <td width="10%">Procesado</td>
                        @else
                            <td width="10%">Cancelado</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</body>

</html>
