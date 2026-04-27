<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
    'outlet_id',
    'user_id',
    'customer_name',
    'shoes_name',
    'service',
    'shoes_color',
    'total_price',
    'transaction_code'
    ];


    protected $casts = [
        'transaction_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
