<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MensajeDeCorreo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datosSolicitante,$datosVenta,$datosColaborados)
    {
        $this->datosSolicitante = $datosSolicitante;
        $this->datosVenta = $datosVenta;
        $this->datosColaborados = $datosColaborados;
        /* $this->datosRecive = $datosRecive; */
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('livewire.evaluacion-solicitud.mensaje')
            ->subject("Solicitud de Aprobacion")
            ->with([
                "datosSolicitante" => $this->datosSolicitante,
                "datosVenta" => $this->datosVenta,
                "datosColaborados" => $this->datosColaborados
                /* "datosRecive" => $this->datosRecive */
            ]);
    }
}
