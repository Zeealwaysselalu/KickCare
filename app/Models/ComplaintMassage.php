<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintMassage extends Model
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
