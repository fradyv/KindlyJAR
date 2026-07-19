<?php

use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('landing-page.index');
})->name('home');

// Authentication
Route::get('/login', function () {
    return view('authentication.signin');
})->name('login');

Route::get('/register', function () {
    return view('authentication.signup');
})->name('register');

// Dashboard User
Route::get('/dashboard', function () {
    return view('dashboard-user.dashboard-beranda');
})->name('dashboard');

Route::get('/kindlyshop', function () {
    return view('dashboard-user.kindlyshop');
})->name('kindlyshop');

Route::get('/gabung-hero', function () {
    return view('dashboard-user.gabung-hero');
})->name('gabung-hero');

Route::get('/detail-program', function () {
    return view('dashboard-user.detail-program');
})->name('detail-program');

// Fundraiser
Route::get('/program-donasi', function () {
    return view('fundraiser.program-donasi');
})->name('program-donasi');

Route::get('/inisiasi', function () {
    return view('fundraiser.inisiasi');
})->name('inisiasi');

Route::get('/verify', function () {
    return view('fundraiser.verify');
})->name('verify');

// User Info
Route::get('/riwayat', function () {
    return view('user info.riwayat');
})->name('riwayat');

Route::get('/profil', function () {
    return view('user info.profil-saya');
})->name('profil');

Route::get('/pengaturan-akun', function () {
    return view('user info.pengaturan-akun');
})->name('pengaturan-akun');

// Dashboard Hero
Route::get('/toko-saya', function () {
    return view('dashboard-hero.toko-saya');
})->name('toko-saya');

Route::get('/tambah-produk', function () {
    return view('dashboard-hero.tambah-produk');
})->name('tambah-produk');

Route::get('/produk-terjual', function () {
    return view('dashboard-hero.produk-terjual');
})->name('produk-terjual');
