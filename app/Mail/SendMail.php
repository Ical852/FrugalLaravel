<?php

namespace App\Mail;

use App\Models\Cart;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
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
        return $this->view('mail/send')->subject('Pesanan Telah Dikirim - Pesanan Anda Sedang Dalam Perjalanan Menuju Alamat Anda');
    }
}
