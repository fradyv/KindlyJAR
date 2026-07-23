<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'buyer_id',
        'campaign_id',
        'total_product_price',
        'extra_donation',
        'total_paid',
        'bank_name',
        'payment_time',
        'is_anonymous',
        'status',
        'midtrans_order_id',
        'midtrans_transaction_id',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'total_product_price' => 'decimal:2',
            'extra_donation'      => 'decimal:2',
            'total_paid'          => 'decimal:2',
            'is_anonymous'        => 'boolean',
            'payment_time'        => 'datetime',
            'created_at'          => 'datetime',
        ];
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
