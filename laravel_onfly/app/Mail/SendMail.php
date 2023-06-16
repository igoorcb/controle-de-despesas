<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $sendMail;

    public function __construct($sendMail)
    {
        $this->sendMail = $sendMail;
    }

    public function content(): Content
    {
        return new Content(
            view: 'email',
        );
    }
}