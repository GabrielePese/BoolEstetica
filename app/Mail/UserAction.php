<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserAction extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $email;
    public $phone;
    public $messageOk;
   


    public function __construct($user, $email, $phone, $messageOk)
    {
        $this -> user = $user;
        $this -> email = $email;
        $this -> phone = $phone;
        $this -> messageOk = $messageOk;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this 
        ->from('Contact form pagina Contatti')
        ->view('email');
    }
}


// PER FARE PROVE CON GMAIL

// class UserAction extends Mailable
// {
//     use Queueable, SerializesModels;

//     public $details;
   


//     public function __construct($details)
//     {
//         $this -> details = $details;
      
//     }

//     /**
//      * Build the message.
//      *
//      * @return $this
//      */
//     public function build()
//     {
        
//         return $this->subject('mail di prova da Indi')->view('email');
//     }
// }
