<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'fundraiser_id',
        'title',
        'description',
        'category',
        'target_amount',
        'collected_amount',
        'withdrawn_amount',
        'status',
        'end_date',
    ];

    protected function casts(): array
    {
        return [
            'target_amount'    => 'decimal:2',
            'collected_amount' => 'decimal:2',
            'withdrawn_amount' => 'decimal:2',
            'end_date'         => 'datetime',
            'created_at'       => 'datetime',
        ];
    }

    public function fundraiser()
    {
        return $this->belongsTo(User::class, 'fundraiser_id');
    }

    public function products()
    {
        return $this->hasMany(DigitalProduct::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Saldo yang masih bisa dicairkan
    public function getAvailableBalanceAttribute(): float
    {
        return (float) $this->collected_amount - (float) $this->withdrawn_amount;
    }
}
