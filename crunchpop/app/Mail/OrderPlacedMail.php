<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order, public bool $forCustomer = false) {}

    public function envelope(): Envelope
    {
        $subject = $this->forCustomer
            ? "Your CrunchPop order {$this->order->order_number} is in!"
            : "New CrunchPop order {$this->order->order_number}";

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order-placed',
            with: ['order' => $this->order, 'forCustomer' => $this->forCustomer],
        );
    }
}
