<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Factura de Venta</title>
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
                        <span style="font-weight: bold; margin-bottom: 3px;">FACTURA DE VENTA</span>
                        <span style="font-weight: bold; margin-bottom: 3px; color:#ca3939">{{$ventas[0]->id_venta}}</span>
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
                        <div style="margin-bottom: 2px;">
                            <span style="font-weight: bold;">Fecha de Venta:</span>
                            <span>{{ date('d/m/Y H:i A',strtotime($ventas[0]->fecha)) }}</span>
                        </div>
                        <div style="margin-bottom: 2px;">
                            <span style="font-weight: bold;">Cliente:</span>
                            <span>{{$ventas[0]->clientes->nombre}}</span>
                        </div>
                        <div style="margin-bottom: 2px;">
                            <span style="font-weight: bold;">DNI:</span>
                            <span>{{$ventas[0]->clientes->nrodocumento}}</span>
                        </div>
                        <div style="margin-bottom: 2px;">
                            <span style="font-weight: bold;">Tipo de Moneda:</span>
                            <span>Soles</span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </section><br>
    <section class="box-container" style="padding: 8px">
        <table class="detail" style="border-collapse: collapse; font-size: 12px">
            <thead style="border-bottom: 1px solid #000">
                <tr>
                    <th style="text-align: center;">Cantidad</th>
                    <th style="text-align: center; border-left: 1px solid #000;">Medida</th>
                    <th style="text-align: center; border-left: 1px solid #000; border-right: 1px solid #000;">
                        Descripción</th>
                    <th style="text-align: center;">Valor</th>
                    <th style="text-align: center;">Descuento</th>
                    <th style="text-align: center;">Importe</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $v)
                    <tr>
                        <td width="12%" style="text-align: center">{{$v->cantidad}}</td>
                        <td width="12%" style="text-align: center; border-left: 1px solid #000;">{{$v->medida}}</td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000;">{{$v->producto}}</td>
                        <td width="12%" style="text-align: center">{{Nformat($v->precio) }}</td>
                        <td width="12%" style="text-align: center">{{Nformat($v->descuento)}}</td>
                        <td width="12%" style="text-align: center">{{Nformat($v->precio - ($v->precio * $v->descuento)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section><br>
    <section class="box-container">
        <table class="values">
            <tbody>
                <tr style="margin: 0">
                    <td style="text-align: right; font-weight: bold" width="85%">Subtotal:</td>
                    <td style="text-align: center">{{Nformat($ventas[0]->subtotal)}}</td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: bold" width="85%">IGV(18%):</td>
                    <td style="text-align: center">{{Nformat($ventas[0]->igv)}}</td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: bold" width="85%">Descuento:</td>
                    <td style="text-align: center">{{Nformat($ventas[0]->descuento)}}</td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: bold" width="85%">Total:</td>
                    <td style="text-align: center">{{Nformat($ventas[0]->total)}}</td>
                </tr>
            </tbody>
        </table>
    </section>
</body>

</html>
