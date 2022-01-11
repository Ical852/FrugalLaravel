<?php

namespace App\Mail;

use App\Models\Cart;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $vendor;
    public $cart;
    public function __construct($vendor, $id)
    {
        $this->vendor = $vendor;
        $this->cart = Cart::firstWhere('id', $id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail/confirm')->subject('Terkonfirmasi - Pesanan Anda Telah Dikonfirmasi Oleh Penjual');
    }
}
