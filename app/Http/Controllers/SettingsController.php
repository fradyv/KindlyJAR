<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\UserSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $verification = $user->fundraiserVerification;
        $settings = $user->settings ?? new UserSettings([
            'enable_2fa'               => false,
            'notification_preferences' => [],
            'privacy_permissions'      => [],
        ]);
        $paymentMethods = $user->paymentMethods()->orderByDesc('is_default')->get();

        return view('user-info.pengaturan-akun', compact('verification', 'settings', 'paymentMethods'));
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();

        if (! Hash::check($validated['current_password'], $user->hash_password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $user->update(['hash_password' => Hash::make($validated['password'])]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    public function updateTwoFactor(Request $request): RedirectResponse
    {
        $settings = auth()->user()->settings()->firstOrCreate([]);
        $settings->update(['enable_2fa' => $request->boolean('enable_2fa')]);

        return back()->with('success', 'Pengaturan 2FA berhasil diperbarui.');
    }

    public function updateNotifications(Request $request): RedirectResponse
    {
        $keys = ['program_email', 'program_push', 'transaksi_email', 'transaksi_push', 'promo_email', 'promo_push'];

        $preferences = [];
        foreach ($keys as $key) {
            $preferences[$key] = $request->boolean("notif.$key");
        }

        $settings = auth()->user()->settings()->firstOrCreate([]);
        $settings->update(['notification_preferences' => $preferences]);

        return back()->with('success', 'Preferensi notifikasi berhasil disimpan.');
    }

    public function updatePrivacy(Request $request): RedirectResponse
    {
        $keys = ['profil_publik', 'rekomendasi', 'bagikan_mitra'];

        $permissions = [];
        foreach ($keys as $key) {
            $permissions[$key] = $request->boolean("privacy.$key");
        }

        $settings = auth()->user()->settings()->firstOrCreate([]);
        $settings->update(['privacy_permissions' => $permissions]);

        return back()->with('success', 'Preferensi privasi berhasil disimpan.');
    }

    public function storePaymentMethod(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'provider'        => ['required', 'string', 'max:100'],
            'account_number'  => ['required', 'string', 'max:50'],
            'account_name'    => ['required', 'string', 'max:255'],
        ]);

        $user = auth()->user();
        $makeDefault = ! $user->paymentMethods()->exists();

        $method = $user->paymentMethods()->create([
            ...$validated,
            'is_default' => $makeDefault,
        ]);

        return back()->with('success', 'Metode pembayaran "'.$method->provider.'" berhasil ditambahkan.');
    }

    public function setDefaultPaymentMethod(PaymentMethod $paymentMethod): RedirectResponse
    {
        abort_if($paymentMethod->user_id !== auth()->id(), 403);

        auth()->user()->paymentMethods()->update(['is_default' => false]);
        $paymentMethod->update(['is_default' => true]);

        return back()->with('success', 'Metode pembayaran utama berhasil diperbarui.');
    }

    public function destroyPaymentMethod(PaymentMethod $paymentMethod): RedirectResponse
    {
        abort_if($paymentMethod->user_id !== auth()->id(), 403);

        $wasDefault = $paymentMethod->is_default;
        $paymentMethod->delete();

        if ($wasDefault) {
            $next = auth()->user()->paymentMethods()->first();
            $next?->update(['is_default' => true]);
        }

        return back()->with('success', 'Metode pembayaran berhasil dihapus.');
    }

    public function deactivate(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $user->update(['is_active' => false]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Akunmu telah dinonaktifkan. Login kembali kapan saja untuk mengaktifkannya lagi.');
    }
}
