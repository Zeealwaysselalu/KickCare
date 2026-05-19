<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    protected $fillable = [
        'transaction_id',
        'status',
        'progress_status',
        'cancel_reason',
        'payment_method'
    ];

    public function transactions()
    {
        return $this->belongsTo(Transaction::class);
    }
}
