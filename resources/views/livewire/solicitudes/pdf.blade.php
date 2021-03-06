<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="author" content="team coders">
    <title>Solicitud de Compra</title>
    <link rel="apple-touch-icon" href="{{ asset('rs/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo5.png') }}">
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

<body >
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
                        <span style="font-weight: bold; margin-bottom: 3px; font-size: 15px;">Comercial El Valle</span>
                        <span>Guadalupe</span>
                        <span>Tel: 22558800</span>
                    </td>
                    <td class="header-left">
                        <span style="font-weight: bold; margin-bottom: 3px;">ORDEN DE COMPRA</span>
                        @if($solicitudes[0]->estado == 'Aprobado')
                               <span style="font-weight: bold; margin-bottom: 3px; color:#2BC871">{{$solicitudes[0]->id_solicitud}}</span>
                            @elseif($solicitudes[0]->estado == 'Rechazado')
                                <span style="font-weight: bold; margin-bottom: 3px; color:#ca3939">{{$solicitudes[0]->id_solicitud}}</span>
                            @else
                                <span style="font-weight: bold; margin-bottom: 3px; color:#FFA045">{{$solicitudes[0]->id_solicitud}}</span>
                            @endif
                        <span>RUC: 1087654321</span>
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
                        <div style="margin-bottom: 4px;">
                            <span style="font-weight: bold;">Fecha de registro:</span>
                            <span>{{ date('d/m/Y H:i A',strtotime($solicitudes[0]->fecha)) }}</span>
                        </div>
                        <div style="margin-bottom: 4px;">
                            <span style="font-weight: bold;">Estado de Solicitud:</span>
                            @if($solicitudes[0]->estado == 'Aprobado')
                               <span style="font-weight: bold; margin-bottom: 3px; color:#2BC871">{{$solicitudes[0]->estado}}</span>
                            @elseif($solicitudes[0]->estado == 'Rechazado')
                                <span style="font-weight: bold; margin-bottom: 3px; color:#ca3939">{{$solicitudes[0]->estado}}</span>
                            @else
                                <span style="font-weight: bold; margin-bottom: 3px; color:#FFA045">{{$solicitudes[0]->estado}}</span>
                            @endif
                        </div>
                        <div style="margin-bottom: 4px;">
                            <span style="font-weight: bold;">Solicitante:</span>
                            <span>{{$solicitudes[0]->colaboradores->nombres}}</span>
                        </div>
                        <div style="margin-bottom: 4px;">
                            <span style="font-weight: bold;">Cargo:</span>
                            <span>{{$datos[0]->cargo}}</span>
                        </div>
                        <div style="margin-bottom: 4px;">
                            <span style="font-weight: bold;">Nivel de Urgencia:</span>
                            <span>{{$solicitudes[0]->grado_urgencia}}</span>
                        </div>
                        <div style="margin-bottom: 4px;">
                            <span style="font-weight: bold;">DNI:</span>
                            <span>{{$solicitudes[0]->colaboradores->dni}}</span>
                        </div>
                        <div style="margin-bottom: 4px;">
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
                    {{-- <th style="text-align: center; border-left: 1px solid #000;">Medida</th> --}}
                    <th style="text-align: center; border-left: 1px solid #000; border-right: 1px solid #000;">
                        Producto</th>
                    <th style="text-align: center;">Precio</th>
                    {{-- <th style="text-align: center;">Descuento(%)</th> --}}
                    <th style="text-align: center;">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($solicitudes as $v)
                    <tr>
                        <td width="12%" style="text-align: center">{{$v->cantidad}}</td>
                        {{-- <td width="12%" style="text-align: center; border-left: 1px solid #000;">{{$v->medida}}</td> --}}
                        <td style="text-align: center;border-left: 1px solid #000; border-right: 1px solid #000;">{{$v->producto}}</td>
                        <td width="12%" style="text-align: center">{{Nformat($v->precio) }}</td>
                        {{-- <td width="12%" style="text-align: center">{{Nformat($v->descuento)}}</td> --}}
                        <td width="12%" style="text-align: center">{{Nformat($v->precio * $v->cantidad) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section><br>
    <section class="box-container">
        <table class="values">
            <tbody>
                {{-- <tr>
                    <td style="text-align: right; font-weight: bold" width="85%">Total Bruto:</td>
                    <td style="text-align: center"> {{Nformat(($ventas[0]->subtotal + $ventas[0]->igv) + $ventas[0]->descuento)}} </td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: bold" width="85%">Descuento:</td>
                    <td style="text-align: center"> {{Nformat($ventas[0]->descuento)}}</td>
                </tr>
                <tr style="margin: 0">
                    <td style="text-align: right; font-weight: bold" width="85%">Subtotal:</td>
                    <td style="text-align: center">{{Nformat($ventas[0]->subtotal)}} </td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: bold" width="85%">IGV(18%):</td>
                    <td style="text-align: center">{{Nformat($ventas[0]->igv)}}</td>
                </tr> --}}
                <tr>
                    <td style="text-align: right; font-weight: bold" width="85%">Total:</td>
                    <td style="text-align: center">{{Nformat($solicitudes[0]->monto_total)}}</td>
                </tr>
            </tbody>
        </table>
    </section>
</body>

</html>
