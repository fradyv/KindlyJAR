<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'transaction_id',
        'product_id',
        'price_at_purchase',
        'quantity',
    ];

    protected function casts(): array
    {
        return [
            'price_at_purchase' => 'decimal:2',
        ];
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(DigitalProduct::class, 'product_id');
    }
}
