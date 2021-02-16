<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrattamentoAnnullato extends Mailable
{
    use Queueable, SerializesModels;

    public $dati;

    public function __construct($dati)
    {
        $this -> dati = $dati;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this 
        ->from(strval($this-> email) )
        ->view('trattamentoAnnullato');
    
    }
}
