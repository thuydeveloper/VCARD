<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public static $rules = [
        'subject' => 'required',
        'description' => 'required|string',
        'custom_email.*' => 'required|email',
    ];

    public function build()
    {
        return $this->subject($this->data['subject'])
            ->markdown('emails.send_email');
    }
}
