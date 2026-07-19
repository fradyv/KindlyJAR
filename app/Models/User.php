<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'hash_password',
        'display_name',
        'legal_name',
        'phone_number',
        'address',
        'avatar_url',
        'bio',
        'is_anonymous_donation',
        'is_active',
        'kyc_status',
    ];

    protected $hidden = [
        'hash_password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'hash_password'        => 'hashed',
            'is_anonymous_donation' => 'boolean',
            'is_active'            => 'boolean',
        ];
    }

    // Kolom password Laravel auth menggunakan hash_password
    public function getAuthPassword(): string
    {
        return $this->hash_password;
    }

    // ── Relasi ──

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function settings()
    {
        return $this->hasOne(UserSettings::class);
    }

    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function fundraiserVerification()
    {
        return $this->hasOne(FundraiserVerification::class);
    }

    public function shop()
    {
        return $this->hasOne(Shop::class);
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class, 'fundraiser_id');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'buyer_id');
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    // ── Helper Role ──

    public function hasRole(string $role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isFundraiser(): bool
    {
        return $this->hasRole('fundraiser');
    }
}
