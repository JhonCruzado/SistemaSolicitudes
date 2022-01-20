<!doctype html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  <title>STesoreria</title>
</head>

<body>
  <table cellpadding="0" cellspacing="0" border="1"
    style="border-collapse:collapse;padding:0;max-width:600px;width:100%;border:0;background-color: #E8EDEF;margin:0 auto;word-break:break-word;font-family: 'Google Sans','Roboto',Arial,sans-serif;">
    <tbody>
      <tr style="text-align: center;color: #fff;">
        <td>
          <h1 style="color:#1a202c;font-family:'Roboto',sans-serif; font-size: 24px;">Comercial El Valle</h1>
        </td>
      </tr>
      <tr>
        <td>
          <table style="font-size: 14px; border-spacing: inherit;">
            <tbody>
              <tr>
                <td style="color: #0d6efd;text-align: center;font-size: 18px; padding: 1rem">
                  <h5 style="margin: 0;">** Procesamiento y Adquisición de Orden de Compra **</h5>
                </td>
              </tr>
              <tr>
                <td style="text-align: justify;padding: 0 1rem 1rem 1rem;">
                  Estimado la siguiente orden de compra tiene las aprobaciones necesarias para que procedan con su procesamiento y adquisición de los productos detallados.
                </td>
              </tr>
              <tr>
                <td style="padding: .3rem 1rem;"><b>Nro. Orden Compra: </b>{{$datosVenta['nroOrden']}}</td>
              </tr>
              <tr>
                <td style="padding: .3rem 1rem;"><b>Estado Orden Compra: </b>{{$datosVenta['estado']}}</td>
              </tr>
              <tr>
                <td style="padding: .3rem 1rem;"><b>Solicitante: </b> {{$datosSolicitante[0]->nombres .' - '. $datosSolicitante[0]->cargo}}</td>
              </tr>
              <tr>
                <td style="padding: .3rem 1rem;"><b>Nivel de Urgencia: </b>{{$datosVenta['urgencia']}}</td>
              </tr>
              <tr>
                <td style="padding: .3rem 1rem;"><b>Fecha solicitud: </b>{{ date('d/m/Y H:i A',strtotime($datosVenta['fecha'])) }}</td>
              </tr>
              <tr>
                <td style="padding: .3rem 1rem;"><b>Total (S/): </b>{{$datosVenta['total']}}</td>
              </tr>
              <tr>
                <table style="width: 100%; padding: .5rem; font-size: 14px;">
                  <thead style="background: #0d6efd; color: #fff; text-align: left;">
                    <th style="padding: .28rem .25rem; font-weight: 500;">Producto</th>
                    <th style="padding: .28rem .25rem; font-weight: 500;">Precio (S/)</th>
                    <th style="padding: .28rem .25rem; font-weight: 500;">Cantidad</th>
                    <th style="padding: .28rem .25rem; font-weight: 500;">Subtotal (S/)</th>
                  </thead>
                  <tbody style="background: #fff;">
                    @foreach ($datosVenta['detalle'] as $dv)
                        <tr>
                        <td style="padding: 0 .25rem;">{{$dv['producto']}}</td>
                        <td style="padding: 0 .25rem;">{{$dv['precio']}}</td>
                        <td style="padding: 0 .25rem;">{{$dv['cantidad']}}</td>
                        <td style="padding: 0 .25rem;">{{$dv['precio']*$dv['cantidad']}}</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </tr>
            </tbody><br>
            <tfoot>
              <tr bgcolor="#000" height="80px">
                <td style="text-align:center">
                  <p style="color:#fff;font-size:12px">Copyright © 2022. Todos los derechos reservados</p>
                </td>
              </tr>
            </tfoot>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
</body>

</html>
