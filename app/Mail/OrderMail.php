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
    public $order_infos;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_new_order)
    {
        $this->order_infos = $_new_order;
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
