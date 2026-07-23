<?php

namespace App\Http\Controllers;

use App\Models\DigitalProduct;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(): View
    {
        $products = DigitalProduct::with(['shop.user', 'campaign'])->get();

        return view('dashboard-user.kindlyshop', compact('products'));
    }

    public function showJoinForm(): View|RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user->shop) {
            return redirect()->route('toko-saya');
        }

        return view('dashboard-user.gabung-hero');
    }

    public function myShop(): View
    {
        /** @var User $user */
        $user = auth()->user();
        $shop = $user->shop;
        $products = $shop ? $shop->products()->with('campaign')->latest('id')->get() : collect();

        return view('dashboard-hero.toko-saya', compact('shop', 'products'));
    }

    public function store(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user->shop) {
            return redirect()->route('toko-saya');
        }

        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category'    => ['nullable', 'string', 'max:100'],
            'phone'       => ['required', 'string', 'max:20'],
        ]);

        Shop::create([
            'user_id'     => $user->id,
            'name'        => $validated['name'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('toko-saya')
            ->with('success', 'Selamat, kamu sekarang resmi jadi Hero! Yuk mulai tambah produk pertamamu.');
    }
}
