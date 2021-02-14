<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecoverPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $linkToRecoverPassword;
    public $linkToCancelRecoverPassword;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($linkToRecoverPassword, $linkToCancelRecoverPassword)
    {
        $this->linkToRecoverPassword = $linkToRecoverPassword;
        $this->linkToCancelRecoverPassword = $linkToCancelRecoverPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mailing.recover_password')->subject('COMFECO - Recuperar contraseña');
    }
}
