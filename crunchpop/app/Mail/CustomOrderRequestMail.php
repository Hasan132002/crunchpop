<?php

namespace App\Mail;

use App\Models\CustomOrderRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomOrderRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public CustomOrderRequest $request) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New custom order request from ' . $this->request->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.custom-order',
            with: ['req' => $this->request],
        );
    }
}
