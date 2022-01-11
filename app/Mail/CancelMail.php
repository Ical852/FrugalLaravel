<?php

namespace App\Mail;

use App\Models\Cart;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CancelMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $vendor;
    public $alasan;
    public $cart;
    public function __construct($vendor, $id, $alasan)
    {
        $this->vendor = $vendor;
        $this->cart = Cart::firstWhere('id', $id);
        $this->alasan = $alasan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail/cancel')->subject('Cancel Product - Maaf Penjual Telah Cancel Pesanan Anda');
    }
}
