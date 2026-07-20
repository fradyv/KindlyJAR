<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\DigitalProductController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\FundraiserVerificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('landing-page.index');
})->name('home');

// Authentication (hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Halaman yang wajib login
Route::middleware('auth')->group(function () {
    // Dashboard User
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/kindlyshop', [ShopController::class, 'index'])->name('kindlyshop');
    Route::get('/produk/{product}', [DigitalProductController::class, 'show'])->name('detail-produk');

    Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang');
    Route::post('/keranjang/tambah/{product}', [CartController::class, 'add'])->name('keranjang.tambah');
    Route::post('/keranjang/{cartItem}/update', [CartController::class, 'updateQuantity'])->name('keranjang.update');
    Route::delete('/keranjang/{cartItem}', [CartController::class, 'remove'])->name('keranjang.hapus');
    Route::post('/keranjang/checkout', [CartController::class, 'checkout'])->name('keranjang.checkout');

    Route::get('/gabung-hero', [ShopController::class, 'showJoinForm'])->name('gabung-hero');
    Route::post('/gabung-hero', [ShopController::class, 'store'])->name('gabung-hero.store');

    Route::get('/detail-program/{campaign}', [CampaignController::class, 'show'])->name('detail-program');
    Route::post('/detail-program/{campaign}/donasi', [DonationController::class, 'store'])->name('donasi.store');

    // Fundraiser
    Route::get('/program-donasi', [CampaignController::class, 'index'])->name('program-donasi');
    Route::post('/program-donasi', [CampaignController::class, 'store'])->name('program-donasi.store');

    Route::get('/inisiasi', function () {
        $user = auth()->user();
        $verification = $user->fundraiserVerification;
        $myCampaigns = $user->kyc_status === 'verified'
            ? $user->campaigns()->withCount('transactions')->latest('created_at')->get()
            : collect();

        return view('fundraiser.inisiasi', compact('verification', 'myCampaigns'));
    })->name('inisiasi');

    Route::get('/verify', [FundraiserVerificationController::class, 'create'])->name('verify');
    Route::post('/verify', [FundraiserVerificationController::class, 'store'])->name('verify.store');

    // User Info
    Route::get('/riwayat', [TransactionController::class, 'index'])->name('riwayat');

    Route::get('/profil', [ProfileController::class, 'show'])->name('profil');
    Route::post('/profil', [ProfileController::class, 'update'])->name('profil.update');

    Route::get('/pengaturan-akun', [SettingsController::class, 'index'])->name('pengaturan-akun');
    Route::post('/pengaturan-akun/password', [SettingsController::class, 'updatePassword'])->name('pengaturan-akun.password');
    Route::post('/pengaturan-akun/2fa', [SettingsController::class, 'updateTwoFactor'])->name('pengaturan-akun.2fa');
    Route::post('/pengaturan-akun/notifikasi', [SettingsController::class, 'updateNotifications'])->name('pengaturan-akun.notifikasi');
    Route::post('/pengaturan-akun/privasi', [SettingsController::class, 'updatePrivacy'])->name('pengaturan-akun.privasi');
    Route::post('/pengaturan-akun/metode-pembayaran', [SettingsController::class, 'storePaymentMethod'])->name('pengaturan-akun.metode-pembayaran.store');
    Route::post('/pengaturan-akun/metode-pembayaran/{paymentMethod}/utama', [SettingsController::class, 'setDefaultPaymentMethod'])->name('pengaturan-akun.metode-pembayaran.utama');
    Route::delete('/pengaturan-akun/metode-pembayaran/{paymentMethod}', [SettingsController::class, 'destroyPaymentMethod'])->name('pengaturan-akun.metode-pembayaran.destroy');
    Route::post('/pengaturan-akun/nonaktifkan', [SettingsController::class, 'deactivate'])->name('pengaturan-akun.nonaktifkan');

    // Dashboard Hero
    Route::get('/toko-saya', [ShopController::class, 'myShop'])->name('toko-saya');

    Route::get('/tambah-produk', [DigitalProductController::class, 'create'])->name('tambah-produk');
    Route::post('/tambah-produk', [DigitalProductController::class, 'store'])->name('tambah-produk.store');
    Route::get('/produk/{product}/edit', [DigitalProductController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{product}', [DigitalProductController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{product}', [DigitalProductController::class, 'destroy'])->name('produk.destroy');

    Route::get('/produk-terjual', [DigitalProductController::class, 'sold'])->name('produk-terjual');

    Route::get('/pencairan-dana', [WithdrawalController::class, 'index'])->name('pencairan-dana');
    Route::post('/pencairan-dana', [WithdrawalController::class, 'store'])->name('pencairan-dana.store');
});

// Admin Panel (hanya role admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/pengguna', [AdminController::class, 'users'])->name('users');
    Route::post('/pengguna/{user}/toggle-aktif', [AdminController::class, 'toggleUserActive'])->name('users.toggle-active');

    Route::get('/verifikasi-kyc', [AdminController::class, 'verifications'])->name('verifications');
    Route::post('/verifikasi-kyc/{verification}/setujui', [AdminController::class, 'approveVerification'])->name('verifications.approve');
    Route::post('/verifikasi-kyc/{verification}/tolak', [AdminController::class, 'rejectVerification'])->name('verifications.reject');

    Route::get('/transaksi', [AdminController::class, 'transactions'])->name('transactions');

    Route::get('/pencairan-dana', [AdminController::class, 'withdrawals'])->name('withdrawals');
    Route::post('/pencairan-dana/{withdrawal}/setujui', [AdminController::class, 'approveWithdrawal'])->name('withdrawals.approve');
    Route::post('/pencairan-dana/{withdrawal}/tolak', [AdminController::class, 'rejectWithdrawal'])->name('withdrawals.reject');

    Route::get('/penyaluran-donasi', [AdminController::class, 'campaigns'])->name('campaigns');
});
