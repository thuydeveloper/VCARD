<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentApproveMail extends Mailable
{
    use Queueable, SerializesModels;

    public $input;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        $subject = __('messages.mail.appointment_approve');

        return $this->subject($subject)
            ->markdown('emails.appointment_approve')
            ->with($this->input);
    }
}
