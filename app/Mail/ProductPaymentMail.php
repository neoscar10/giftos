<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductPaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cartData;

    public function __construct($cartData)
    {
        $this->cartData = $cartData;
    }

    public function build()
    {
        return $this->subject('Product Payment Confirmation')
                    ->view('emails.product_payment')
                    ->with(['cartData' => $this->cartData]);
    }
}
