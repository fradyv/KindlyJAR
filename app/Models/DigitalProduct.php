<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DigitalProduct extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'shop_id',
        'campaign_id',
        'title',
        'description',
        'price',
        'stock',
        'product_preview',
        'category',
        'file_url',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'product_id');
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class, 'product_id');
    }
}
