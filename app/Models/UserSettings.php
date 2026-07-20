<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'enable_2fa',
        'notification_preferences',
        'privacy_permissions',
    ];

    protected function casts(): array
    {
        return [
            'enable_2fa'                => 'boolean',
            'notification_preferences'  => 'array',
            'privacy_permissions'       => 'array',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
