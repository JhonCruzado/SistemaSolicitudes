<?php

namespace App\Http\Controllers;

use App\Models\SolicitudCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

         return view('livewire.evaluacion-solicitud.rechazo', compact('solicitudes'));
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

        DB::select('call actualizarEstado(?)', array($request->orden));

        echo "
       <script>alert('Su respuesta fue registrada.');</script>";
       echo "
       <script>window.close();</script>";
    }
}
