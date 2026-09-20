<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReinitialisationMotDePasse extends Mailable
{
    use Queueable, SerializesModels;

    public string $lien;

    public function __construct(string $lien)
    {
        $this->lien = $lien;
    }

    public function build()
    {
        return $this
            ->subject('Réinitialisation de votre mot de passe - L\'instant Thé')
            ->view('emails.reinitialisation');
    }
}

