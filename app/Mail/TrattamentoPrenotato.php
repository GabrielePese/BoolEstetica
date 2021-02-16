<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrattamentoPrenotato extends Mailable
{
    use Queueable, SerializesModels;

    public $utente;
    public $datagiorno;
    public $dataorario;
    public $orarioMail;
    public $servizio;
    


    public function __construct($utente, $datagiorno, $dataorario,$orarioMail,$servizio){
        $this -> utente = $utente;
        $this -> datagiorno = $datagiorno;
        $this -> dataorario = $dataorario;
        $this -> orarioMail = $orarioMail;
        $this -> servizio = $servizio;
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this 
        ->from(strval($this -> utente))
        ->subject('trattamneto Prenotato!!')
        ->view('trattamentoPrenotato');
    }
}
