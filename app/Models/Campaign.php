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

    public function isFull(): bool
    {
        return (float) $this->target_amount > 0
            && (float) $this->collected_amount >= (float) $this->target_amount;
    }

    public function acceptsContributions(): bool
    {
        return $this->status === 'active' && ! $this->isFull();
    }

    public function progressPercentage(): int
    {
        if ((float) $this->target_amount <= 0) {
            return 0;
        }

        return (int) min(100, round(((float) $this->collected_amount / (float) $this->target_amount) * 100));
    }

    public function markAsCompletedIfFull(): void
    {
        if ($this->status === 'active' && $this->isFull()) {
            $this->update(['status' => 'completed']);
        }
    }

    public function scopeAcceptingContributions($query)
    {
        return $query->where('status', 'active')
            ->whereColumn('collected_amount', '<', 'target_amount');
    }
}
