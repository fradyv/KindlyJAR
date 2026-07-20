<?php

namespace App\Http\Controllers;

use App\Models\FundraiserVerification;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FundraiserVerificationController extends Controller
{
    public function create(): View|RedirectResponse
    {
        $user = auth()->user();

        if (in_array($user->kyc_status, ['pending', 'verified'])) {
            return redirect()->route('inisiasi');
        }

        $verification = $user->fundraiserVerification;

        return view('fundraiser.verify', compact('verification'));
    }

    public function store(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $validated = $request->validate([
            'account_type'         => ['required', 'in:individu,yayasan,komunitas,organisasi_mahasiswa'],
            'phone_number'         => ['required', 'string', 'max:20'],
            'address'              => ['required', 'string'],
            'ktp_number'           => ['required', 'string', 'max:32'],
            'ktp_photo'            => ['required', 'image', 'max:5120'],
            'selfie_ktp_photo'     => ['required', 'image', 'max:5120'],
            'profile_photo'        => ['nullable', 'image', 'max:5120'],
            'bank_name'            => ['required', 'string', 'max:100'],
            'bank_account_number'  => ['required', 'numeric'],
            'bank_account_name'    => ['required', 'string', 'max:255'],
            'passbook_photo'       => ['required', 'image', 'max:5120'],
            'statement_letter'     => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'supporting_docs'      => ['nullable', 'file', 'mimes:pdf,zip,jpg,jpeg,png', 'max:10240'],
        ]);

        $existing = $user->fundraiserVerification;

        $filePaths = [];
        foreach (['ktp_photo', 'selfie_ktp_photo', 'profile_photo', 'passbook_photo', 'statement_letter', 'supporting_docs'] as $field) {
            if ($request->hasFile($field)) {
                $filePaths[$field] = 'storage/'.Storage::disk('public')->put('verifications', $request->file($field));
            }
        }

        FundraiserVerification::updateOrCreate(
            ['user_id' => $user->id],
            [
                'account_type'        => $validated['account_type'],
                'ktp_number'          => $validated['ktp_number'],
                'ktp_photo'           => $filePaths['ktp_photo'] ?? optional($existing)->ktp_photo,
                'selfie_ktp_photo'    => $filePaths['selfie_ktp_photo'] ?? optional($existing)->selfie_ktp_photo,
                'profile_photo'       => $filePaths['profile_photo'] ?? optional($existing)->profile_photo,
                'bank_name'           => $validated['bank_name'],
                'bank_account_number' => $validated['bank_account_number'],
                'bank_account_name'   => $validated['bank_account_name'],
                'passbook_photo'      => $filePaths['passbook_photo'] ?? optional($existing)->passbook_photo,
                'statement_letter'    => $filePaths['statement_letter'] ?? optional($existing)->statement_letter,
                'supporting_docs'     => $filePaths['supporting_docs'] ?? optional($existing)->supporting_docs,
                'status'              => 'pending',
                'created_at'          => now(),
            ]
        );

        $user->update([
            'phone_number' => $validated['phone_number'],
            'address'      => $validated['address'],
            'kyc_status'   => 'pending',
        ]);

        $fundraiserRole = Role::where('name', 'fundraiser')->first();
        if ($fundraiserRole && ! $user->hasRole('fundraiser')) {
            $user->roles()->attach($fundraiserRole);
        }

        return redirect()->route('inisiasi')
            ->with('success', 'Pengajuan verifikasi berhasil dikirim! Tim kami akan meninjau datamu dalam 1-2 hari kerja.');
    }
}
