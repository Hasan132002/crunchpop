<?php

namespace App\Mail;

use App\Models\EarlyListSignup;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EarlyListSignupMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public EarlyListSignup $signup) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Field & Pantry early-list signup: ' . $this->signup->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.early-list',
            with: ['signup' => $this->signup],
        );
    }
}
