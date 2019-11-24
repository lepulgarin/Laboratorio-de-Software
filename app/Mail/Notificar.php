<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Notificar extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $horarios;
    public $FNomAsignatura;
     public function __construct($horarios, $FNomAsignatura)
    {
        $this->horarios = $horarios;
        $this->FNomAsignatura = $FNomAsignatura;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.notificar');
    }
}
