<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    // Variabile di istanza necessaria per il passaggio dei dati nella mail
    public $customer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_new_customer)
    {
        $this->customer = $_new_customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order-message');
    }
}
