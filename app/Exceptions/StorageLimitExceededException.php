<?php
// app/Exceptions/StorageLimitExceededException.php

namespace App\Exceptions;

use Exception;

class StorageLimitExceededException extends Exception
{
    /**
     * The exception message.
     *
     * @var string
     */
    protected $message = 'Storage limit exceeded.';

    /**
     * The HTTP status code for the exception.
     *
     * @var int
     */
    protected $code = 422; // You can customize the status code as needed

    /**
     * Create a new exception instance.
     *
     * @param  string|null  $message
     * @param  int  $code
     * @param  \Throwable|null  $previous
     * @return void
     */
    public function __construct($message = null, $code = null, Throwable $previous = null)
    {
        if (!is_null($message)) {
            $this->message = $message;
        }

        if (!is_null($code)) {
            $this->code = $code;
        }

        parent::__construct($this->message, $this->code, $previous);
    }
}
