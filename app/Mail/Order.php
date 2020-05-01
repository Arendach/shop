<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Order extends Mailable
{
    use Queueable, SerializesModels;

    private $order = [];

    public function __construct(\App\Models\Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->from('arendach.taras@gmail.com')
            ->view('emails.order')
            ->with('order', $this->order);
    }
}
