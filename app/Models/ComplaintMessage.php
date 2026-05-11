<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintMessage extends Model
{
    protected $fillable = [
        'user_id',
        'subject',
        'transaction_code',
        'massage',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
