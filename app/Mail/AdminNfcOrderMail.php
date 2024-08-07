<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminNfcOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nfcOrder;
    public $vcardName;
    public $cardType;
    /**
     * Create a new message instance.
     */
    public function __construct($nfcOrder,$vcardName,$cardType)
    {
        $this->nfcOrder = $nfcOrder;
        $this->vcardName = $vcardName;
        $this->cardType = $cardType;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('messages.nfc.nfc_order_recived'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.admin_nfc_order',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
