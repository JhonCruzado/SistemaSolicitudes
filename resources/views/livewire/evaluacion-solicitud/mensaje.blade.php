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
                  <h5 style="margin: 0;">** Solicitud de Aprobación - Orden de Compra **</h5>
                </td>
              </tr>
              <tr>
                <td style="text-align: justify;padding: 0 1rem 1rem 1rem;">
                  Estimado {{-- {{ $persona_recive }} --}}, requerimos su respuesta frente a está solicitud. A continuación se detalla la orden de compra:
                </td>
              </tr>
              <tr>
                <td style="padding: .3rem 1rem;"><b>Nro. Orden Compra: </b>{{-- {{$info->orden}} --}}</td>
              </tr>
              <tr>
                <td style="padding: .3rem 1rem;"><b>Solicitante: </b>{{ $colaborador[0]->nombres}} {{-- {{$info->solicitante .' '. $info->cargo}} --}}</td>
              </tr>
              <tr>
                <td style="padding: .3rem 1rem;"><b>Nivel de Urgencia: </b>{{-- {{$info->urgencia}} --}}</td>
              </tr>
              <tr>
                <td style="padding: .3rem 1rem;"><b>Fecha solicitud: </b>{{$fecha}} {{-- {{$info->fecha}} --}}</td>
              </tr>
              <tr>
                <td style="padding: .3rem 1rem;"><b>Total (S/): </b>{{-- {{$info->total}} --}}</td>
              </tr>
              <tr>
                <table style="width: 100%; padding: .5rem; font-size: 14px;">
                  <thead style="background: #0d6efd; color: #fff; text-align: left;">
                    <th style="padding: .28rem .25rem; font-weight: 500;">Cantidad</th>
                    <th style="padding: .28rem .25rem; font-weight: 500;">Precio (S/)</th>
                    <th style="padding: .28rem .25rem; font-weight: 500;">Producto</th>
                    <th style="padding: .28rem .25rem; font-weight: 500;">Subtotal (S/)</th>
                  </thead>
                  <tbody style="background: #fff;">
                    <tr>
                      <td style="padding: 0 .25rem;">5</td>
                      <td style="padding: 0 .25rem;">6.00</td>
                      <td style="padding: 0 .25rem;">Producto #01</td>
                      <td style="padding: 0 .25rem;">30</td>
                    </tr>
                  </tbody>
                </table>
              </tr>
              <tr>
                <td style="padding: 0 1rem; text-align: justify; font-size: 14px;">Para poder aceptar o rechazar está solicitud presione uno de los siguientes
                  botones:</td>
              </tr>
              <tr>
                <td style="display: flex; justify-content: center; gap: 10px; padding: 1rem 0; border: none; font-size: 14px;">
                  <button onclick="window.location.href='http://127.0.0.1:8000/aprobacion' "
                    style="text-decoration: none; background: #0d6efd; padding: .7rem 1.2rem; color: #fff; border-radius: 20px">Aprobar
                    solicitud</button>
                  <button onclick="window.location.href='http://127.0.0.1:8000/rechazo' "
                    style="text-decoration: none; background: #ff0040; padding: .7rem 1.2rem; color: #fff; border-radius: 20px">Rechazar
                    solicitud</button>
                </td>
              </tr>
            </tbody>
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
