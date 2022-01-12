<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Comercial El Valle</title>
    <link rel="apple-touch-icon" href="{{ asset('rs/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo5.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
</head>

<body>
    <form action="{{ route('save') }}" method="POST" >
        @csrf
        <input class="form-control" type="hidden" name="orden"  value="{{ $solicitudes[0]->id_solicitud}}">
        <input class="form-control" type="hidden" name="colaborador"  value="{{$colaborador}}">
        <input class="form-control" type="hidden" name="estado"  value="0">

        <table cellpadding="0" cellspacing="0" border="1"
            style="border-collapse:collapse;padding:0;max-width:700px;width:100%;border:0;background-color: #E8EDEF;margin:0 auto;margin-top:5%;word-break:break-word;font-family: 'Google Sans','Roboto',Arial,sans-serif;">
            <tbody>
            <tr>
                <td>
                <table style="font-size: 14px; border-spacing: inherit;">
                    <tbody>
                    <tr>
                        <td style="color: #ff0040;text-align: center;font-size: 20px; padding: 2rem">
                        <h3 style="margin: 0;"><b>Aprobar la Solicitud de Orden de Compra</b></h3>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;padding: 0 1rem 1rem 1rem;font-size:16px">
                            Usted está por rechazar la orden de compra <b>N° {{ $solicitudes[0]->id_solicitud}}</b>, con monto de <b>S/. {{ $solicitudes[0]->monto_total}}</b>, si tiene alguna observación ingrésela a continuación:
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: .3rem 1rem;text-align: center;">
                            <div class="form-group mb-1 input">
                                <label class="form-label">Observación(opcional)</label>
                                <div class="input-group">
                                    <input type="text" name="observacion" class="form-control" >
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; padding: 1rem 0; border: none; font-size: 14px;">
                            <button type="submit" style="text-decoration: none; background: #ff0040; padding: .7rem 1.2rem; color: #fff; border-radius: 20px;margin-right:10px" class="btn btn-primary">Rechazar
                            solicitud</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</body>

</html>
