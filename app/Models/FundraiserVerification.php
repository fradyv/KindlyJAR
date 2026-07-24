<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundraiserVerification extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'account_type',
        'ktp_number',
        'ktp_photo',
        'selfie_ktp_photo',
        'profile_photo',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'passbook_photo',
        'statement_letter',
        'supporting_docs',
        'status',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
