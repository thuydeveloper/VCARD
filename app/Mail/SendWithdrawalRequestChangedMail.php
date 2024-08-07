<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendWithdrawalRequestChangedMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public string $mailSubject;

    public string $mailView;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data, string $subject, string $mailView)
    {
        $this->data = $data;
        $this->mailSubject = $subject;
        $this->mailView = $mailView;
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        return $this->subject($this->mailSubject)
            ->from(config('mail.from.address'))
            ->markdown($this->mailView)
            ->with($this->data);
    }
}
