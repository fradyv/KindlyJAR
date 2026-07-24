<?php

namespace App\Http\Controllers;

use App\Models\FundraiserVerification;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class FundraiserVerificationController extends Controller
{
    private const FILE_FIELDS = [
        'ktp_photo',
        'selfie_ktp_photo',
        'profile_photo',
        'passbook_photo',
        'statement_letter',
        'supporting_docs',
    ];

    private const PHOTO_FIELDS = [
        'ktp_photo',
        'selfie_ktp_photo',
        'profile_photo',
        'passbook_photo',
    ];

    public function create(): View|RedirectResponse
    {
        $user = $this->authUser();

        if (in_array($user->kyc_status, ['pending', 'verified'])) {
            return redirect()->route('inisiasi');
        }

        $verification = $user->fundraiserVerification;

        if ($verification && ! in_array($verification->status, ['draft', 'rejected'])) {
            return redirect()->route('inisiasi');
        }

        return view('fundraiser.verify', compact('verification'));
    }

    public function saveDraft(Request $request): JsonResponse
    {
        $user = $this->authUser();

        if (in_array($user->kyc_status, ['pending', 'verified'])) {
            return response()->json(['message' => 'Pengajuan sudah dikirim.'], 403);
        }

        $validated = $request->validate([
            'account_type'        => ['nullable', 'in:individu,yayasan,komunitas,organisasi_mahasiswa'],
            'address'             => ['nullable', 'string'],
            'phone_number'        => ['nullable', 'string', 'regex:/^[0-9]{9,15}$/'],
            'ktp_number'          => ['nullable', 'string', 'regex:/^[0-9]{16}$/'],
            'bank_name'           => ['nullable', 'string', 'max:100'],
            'bank_account_number' => ['nullable', 'numeric'],
            'bank_account_name'   => ['nullable', 'string', 'max:255'],
        ]);

        $verificationFields = collect($validated)->only([
            'account_type',
            'ktp_number',
            'bank_name',
            'bank_account_number',
            'bank_account_name',
        ])->filter(fn ($value) => $value !== null && $value !== '')->all();

        FundraiserVerification::updateOrCreate(
            ['user_id' => $user->id],
            [
                ...$verificationFields,
                'status'     => 'draft',
                'created_at' => now(),
            ]
        );

        $userFields = collect($validated)->only(['phone_number', 'address'])
            ->filter(fn ($value) => $value !== null && $value !== '')
            ->all();

        if ($userFields !== []) {
            $user->update($userFields);
        }

        return response()->json(['ok' => true]);
    }

    public function uploadDraftFile(Request $request): JsonResponse
    {
        $user = $this->authUser();

        if (in_array($user->kyc_status, ['pending', 'verified'])) {
            return response()->json(['message' => 'Pengajuan sudah dikirim.'], 403);
        }

        $validated = $request->validate([
            'field' => ['required', Rule::in(self::FILE_FIELDS)],
            'file'  => ['required', 'file'],
        ]);

        $field = $validated['field'];
        $fileRules = in_array($field, self::PHOTO_FIELDS, true)
            ? ['file', 'mimes:jpg,jpeg,png', 'max:5120']
            : ['file', 'mimes:pdf', 'max:'.($field === 'supporting_docs' ? '10240' : '5120')];

        $fileValidator = Validator::make(
            ['file' => $request->file('file')],
            ['file' => $fileRules],
            [
                'file.mimes' => in_array($field, self::PHOTO_FIELDS, true)
                    ? 'Format foto harus PNG, JPG, atau JPEG.'
                    : 'Format dokumen harus PDF.',
            ]
        );

        if ($fileValidator->fails()) {
            return response()->json(['message' => $fileValidator->errors()->first('file')], 422);
        }

        $path = 'storage/'.Storage::disk('public')->put('verifications', $request->file('file'));

        FundraiserVerification::updateOrCreate(
            ['user_id' => $user->id],
            [
                $field       => $path,
                'status'      => 'draft',
                'created_at'  => now(),
            ]
        );

        return response()->json([
            'ok'       => true,
            'field'    => $field,
            'filename' => basename($path),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $this->authUser();
        $existing = $user->fundraiserVerification;

        $rules = [
            'account_type'        => ['required', 'in:individu,yayasan,komunitas,organisasi_mahasiswa'],
            'phone_number'        => ['required', 'string', 'regex:/^[0-9]{9,15}$/'],
            'address'             => ['required', 'string'],
            'ktp_number'          => ['required', 'string', 'regex:/^[0-9]{16}$/'],
            'bank_name'           => ['required', 'string', 'max:100'],
            'bank_account_number' => ['required', 'numeric'],
            'bank_account_name'   => ['required', 'string', 'max:255'],
            'ktp_photo'           => [$this->fileRequiredRule($existing, 'ktp_photo', $request), 'nullable', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
            'selfie_ktp_photo'    => [$this->fileRequiredRule($existing, 'selfie_ktp_photo', $request), 'nullable', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
            'profile_photo'        => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
            'passbook_photo'      => [$this->fileRequiredRule($existing, 'passbook_photo', $request), 'nullable', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
            'statement_letter'    => [$this->fileRequiredRule($existing, 'statement_letter', $request), 'nullable', 'file', 'mimes:pdf', 'max:5120'],
            'supporting_docs'     => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
        ];

        $messages = [
            'phone_number.regex'     => 'Nomor HP hanya boleh berisi angka, 9–15 digit.',
            'ktp_number.regex'       => 'Nomor NIK harus 16 digit angka.',
            'ktp_photo.required'     => 'Foto KTP wajib diunggah.',
            'selfie_ktp_photo.required' => 'Foto selfie dengan KTP wajib diunggah.',
            'passbook_photo.required'   => 'Foto buku tabungan wajib diunggah.',
            'statement_letter.required' => 'Surat pernyataan wajib diunggah.',
            'ktp_photo.mimes'           => 'Foto KTP harus berformat PNG, JPG, atau JPEG.',
            'selfie_ktp_photo.mimes'  => 'Foto selfie harus berformat PNG, JPG, atau JPEG.',
            'profile_photo.mimes'     => 'Foto profil harus berformat PNG, JPG, atau JPEG.',
            'passbook_photo.mimes'    => 'Foto buku tabungan harus berformat PNG, JPG, atau JPEG.',
            'statement_letter.mimes'  => 'Surat pernyataan harus berformat PDF.',
            'supporting_docs.mimes'   => 'Berkas pendukung harus berformat PDF.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('verify')
                ->withErrors($validator)
                ->withInput()
                ->with('verify_error_step', $this->errorStepFor($validator->errors()->keys()));
        }

        $validated = $validator->validated();

        $filePaths = [];
        foreach (self::FILE_FIELDS as $field) {
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

    private function fileRequiredRule(?FundraiserVerification $existing, string $field, Request $request): string
    {
        if ($request->hasFile($field)) {
            return 'nullable';
        }

        return filled(optional($existing)->$field) ? 'nullable' : 'required';
    }

    /** @param  array<int, string>  $errorKeys */
    private function errorStepFor(array $errorKeys): int
    {
        $stepMap = [
            'account_type'        => 1,
            'address'             => 1,
            'phone_number'        => 2,
            'ktp_number'          => 2,
            'ktp_photo'           => 2,
            'selfie_ktp_photo'    => 2,
            'profile_photo'       => 2,
            'bank_name'           => 3,
            'bank_account_number' => 3,
            'bank_account_name'   => 3,
            'passbook_photo'      => 3,
            'statement_letter'    => 4,
            'supporting_docs'     => 4,
        ];

        $step = 1;
        foreach ($errorKeys as $key) {
            $step = max($step, $stepMap[$key] ?? 1);
        }

        return $step;
    }
}
