<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MensajeDeCorreo2 extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datosSolicitante,$datosVenta)
    {
        $this->datosSolicitante = $datosSolicitante;
        $this->datosVenta = $datosVenta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('livewire.evaluacion-solicitud.mensaje2')
            ->subject("Orden de Compra")
            ->with([
                "datosSolicitante" => $this->datosSolicitante,
                "datosVenta" => $this->datosVenta
            ]);
    }
}
