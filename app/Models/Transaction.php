<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'outlet_id',
        'user_id',
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

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function transaction_item()
    {
        return $this->hasMany(TransactionItem::class, 'transaction_id');
    }

    public function detail_transaction()
    {
        return $this->hasOne(DetailTransaction::class, 'transaction_id');
    }
}
