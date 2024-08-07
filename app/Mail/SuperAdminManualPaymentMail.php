<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuperAdminManualPaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $input;

    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($input, $email)
    {
        $this->input = $input;
        $this->email = $email;
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        $subject = __('messages.mail.new_manual_payment_request');

        $mail = $this->subject($subject)
            ->markdown('emails.manual_payment_request_mail')
            ->with($this->input);

        if ($this->input['attachment']) {
            $mail->attach($this->input['attachment']);
        }

        return $mail;
    }
}
