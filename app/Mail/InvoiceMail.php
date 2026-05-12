<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Transaction;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction->loadMissing(['transaction_item', 'user', 'detail_transaction']);
    }

    public function build()
    {
        return $this->subject('Invoice KickCare - #' . $this->transaction->transaction_code)
            ->view('mail.invoice-mail');
    }
}
