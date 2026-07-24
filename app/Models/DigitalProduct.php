<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        'file_size_bytes',
    ];

    protected function casts(): array
    {
        return [
            'price'           => 'decimal:2',
            'file_size_bytes' => 'integer',
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

    public function fileAssetUrl(): ?string
    {
        return $this->file_url ? asset($this->file_url) : null;
    }

    public function formattedFileSize(): ?string
    {
        $bytes = $this->file_size_bytes ?? $this->detectFileSizeBytes();

        if ($bytes === null || $bytes <= 0) {
            return null;
        }

        return self::formatBytes($bytes);
    }

    public static function formatBytes(int $bytes): string
    {
        if ($bytes >= 1_048_576) {
            return round($bytes / 1_048_576, 1).' MB';
        }

        if ($bytes >= 1024) {
            return round($bytes / 1024, 1).' KB';
        }

        return $bytes.' B';
    }

    private function detectFileSizeBytes(): ?int
    {
        $path = $this->resolveStorageRelativePath();

        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->size($path);
        }

        $publicPath = $this->resolvePublicPath();

        if ($publicPath && is_file($publicPath)) {
            return filesize($publicPath) ?: null;
        }

        return null;
    }

    private function resolveStorageRelativePath(): ?string
    {
        if (! $this->file_url || ! str_starts_with($this->file_url, 'storage/')) {
            return null;
        }

        return substr($this->file_url, strlen('storage/'));
    }

    private function resolvePublicPath(): ?string
    {
        if (! $this->file_url || str_starts_with($this->file_url, 'storage/')) {
            return null;
        }

        return public_path($this->file_url);
    }
}
