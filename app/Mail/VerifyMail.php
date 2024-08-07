<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /** * @var array */
    public $data;

    /** * Create a new message instance. * @param  string  $view * @param  string  $subject * @param  array  $data * * @return void */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /** * Build the message. * * @return $this */
    public function build()
    {
        return $this->subject(__('messages.mail.verify_email'))
            ->markdown('emails.verify_email');
    }
}
