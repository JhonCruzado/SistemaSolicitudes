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
    public function __construct($colaborador, $fecha)
    {
        $this->colaborador = $colaborador;
        $this->fecha = $fecha;
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
                "colaborador" => $this->colaborador,
                "fecha" => $this->fecha,
            ]);
    }
}
