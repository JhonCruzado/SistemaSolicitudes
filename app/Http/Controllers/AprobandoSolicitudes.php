<?php

namespace App\Http\Controllers;

use App\Models\SolicitudCompra;
use Illuminate\Http\Request;
use App\Mail\MensajeDeCorreo2;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AprobandoSolicitudes extends Controller
{
    public function aprobar($orden,$colaborador)
    {
        $solicitudes = SolicitudCompra::where('solicitud_compra.id_solicitud', '=', $orden)->get();

        return view('livewire.evaluacion-solicitud.aprobacion', compact('solicitudes','colaborador'));
    }

    public function rechazo($orden,$colaborador)
    {
        $solicitudes = SolicitudCompra::where('solicitud_compra.id_solicitud', '=', $orden)->get();

         return view('livewire.evaluacion-solicitud.rechazo', compact('solicitudes','colaborador'));
    }

    public function save(Request $request)
    {
       DB::table('solicitud')
            ->where('solicitud_id', 'like', $request->orden)
            ->where('colaborador_id', 'like', $request->colaborador)
            ->update([
                'estado' => $request->estado,
                'observacion' => $request->observacion
        ]);

        $valor = DB::select('call actualizarEstado(?)', array($request->orden));

        if($valor){
            if($valor[0]->ok){
                $emailJefeArea = DB::table('colaborador_area as ca')
                ->join('area as ar', 'ar.id_area', '=', 'ca.area_id')
                ->join('colaborador as c', 'c.id_colaborador', '=', 'ca.colaborador_id')
                ->where('ar.area', 'like', "Logística")
                ->get();
                $emailJefeArea = $emailJefeArea[0]->email;

                $datosSolicitante = DB::table('colaborador as c')
                    ->select(DB::raw('CONCAT(car.cargo, " ", dp.area) AS cargo'),'c.nombres as nombres','c.id_colaborador as id')
                    ->join('cargo as car', 'car.id_cargo', '=', 'c.cargo_id')
                    ->join('colaborador_area as cd', 'cd.colaborador_id', '=', 'c.id_colaborador')
                    ->join('area as dp', 'dp.id_area', '=', 'cd.area_id')
                    ->where('c.id_colaborador', '=', $request->colaborador)
                    ->get();

                $venta = DB::table('solicitud_compra as sc')
                    ->select('sc.id_solicitud as id_solicitud','sc.fecha as fecha','c.nombres as nombre','sc.grado_urgencia as grado_urgencia','sc.monto_total as monto_total','sc.cantidad_total as cantidad_total','sc.estado')
                    ->join('colaborador as c', 'c.id_colaborador', '=', 'sc.colaborador_id')
                    ->orderBy('sc.id_solicitud','DESC')
                    ->where('sc.id_solicitud', '=', $request->orden)
                    ->get();
                $detalle = DB::table('detalle_solicitud_compraa as sc')->where('sc.solicitud_id', '=', $request->orden)->get();
                $newdetalle = json_decode($detalle, true);

                $datosVenta = array("nroOrden"=>$request->orden,"urgencia"=>$venta[0]->grado_urgencia,"estado"=>$venta[0]->estado, "fecha"=>$venta[0]->fecha, "total"=> $venta[0]->monto_total, "cantidad"=> $venta[0]->cantidad_total, "detalle"=>$newdetalle);

                Mail::to($emailJefeArea)->send(new MensajeDeCorreo2($datosSolicitante,$datosVenta));

            }
        }
        echo "
       <script>alert('Su respuesta fue registrada.');</script>";
       echo "
       <script>window.close();</script>";
    }
}
