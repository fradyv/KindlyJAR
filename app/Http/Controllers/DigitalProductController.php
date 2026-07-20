<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\DigitalProduct;
use App\Models\TransactionItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DigitalProductController extends Controller
{
    public function create(): View
    {
        $shop = auth()->user()->shop;
        $campaigns = Campaign::where('status', 'active')->orderBy('title')->get();

        return view('dashboard-hero.tambah-produk', compact('shop', 'campaigns'));
    }

    public function store(Request $request): RedirectResponse
    {
        $shop = auth()->user()->shop;

        if (! $shop) {
            return redirect()->route('gabung-hero');
        }

        $validated = $request->validate([
            'campaign_id' => ['required', 'exists:campaigns,id'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'stock'       => ['nullable', 'integer', 'min:0'],
            'category'    => ['required', 'string', 'max:100'],
            'photo'       => ['nullable', 'image', 'max:5120'],
        ]);

        $previewPath = null;
        if ($request->hasFile('photo')) {
            $previewPath = Storage::disk('public')->put('products', $request->file('photo'));
        }

        DigitalProduct::create([
            'shop_id'         => $shop->id,
            'campaign_id'     => $validated['campaign_id'],
            'title'           => $validated['title'],
            'description'     => $validated['description'],
            'price'           => $validated['price'],
            'stock'           => $validated['stock'] ?? 0,
            'category'        => $validated['category'],
            'product_preview' => $previewPath ? 'storage/'.$previewPath : null,
        ]);

        return redirect()->route('toko-saya')
            ->with('success', 'Produk "'.$validated['title'].'" berhasil ditambahkan ke toko kamu!');
    }

    public function sold(): View
    {
        $shop = auth()->user()->shop;
        $productIds = $shop ? $shop->products()->pluck('id') : collect();

        $items = TransactionItem::whereIn('product_id', $productIds)
            ->with(['transaction.buyer', 'product'])
            ->latest('id')
            ->get();

        return view('dashboard-hero.produk-terjual', compact('shop', 'items'));
    }

    public function show(DigitalProduct $product): View
    {
        $product->load(['shop.user', 'campaign']);

        $produkLainnya = DigitalProduct::where('shop_id', $product->shop_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('dashboard-user.detail-produk', compact('product', 'produkLainnya'));
    }

    public function edit(DigitalProduct $product): View
    {
        $shop = auth()->user()->shop;

        abort_if(! $shop || $product->shop_id !== $shop->id, 403);

        $campaigns = Campaign::where('status', 'active')->orderBy('title')->get();

        return view('dashboard-hero.edit-produk', compact('shop', 'product', 'campaigns'));
    }

    public function update(Request $request, DigitalProduct $product): RedirectResponse
    {
        $shop = auth()->user()->shop;

        abort_if(! $shop || $product->shop_id !== $shop->id, 403);

        $validated = $request->validate([
            'campaign_id' => ['required', 'exists:campaigns,id'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'stock'       => ['nullable', 'integer', 'min:0'],
            'category'    => ['required', 'string', 'max:100'],
            'photo'       => ['nullable', 'image', 'max:5120'],
        ]);

        $previewPath = $product->product_preview;
        if ($request->hasFile('photo')) {
            $previewPath = 'storage/'.Storage::disk('public')->put('products', $request->file('photo'));
        }

        $product->update([
            'campaign_id'     => $validated['campaign_id'],
            'title'           => $validated['title'],
            'description'     => $validated['description'],
            'price'           => $validated['price'],
            'stock'           => $validated['stock'] ?? 0,
            'category'        => $validated['category'],
            'product_preview' => $previewPath,
        ]);

        return redirect()->route('toko-saya')
            ->with('success', 'Produk "'.$product->title.'" berhasil diperbarui.');
    }

    public function destroy(DigitalProduct $product): RedirectResponse
    {
        $shop = auth()->user()->shop;

        abort_if(! $shop || $product->shop_id !== $shop->id, 403);

        if ($product->transactionItems()->exists()) {
            return redirect()->route('toko-saya')
                ->with('error', 'Produk "'.$product->title.'" tidak bisa dihapus karena sudah pernah terjual. Ubah stok jadi 0 kalau mau berhenti menjual produk ini.');
        }

        $title = $product->title;
        $product->delete();

        return redirect()->route('toko-saya')
            ->with('success', 'Produk "'.$title.'" berhasil dihapus dari toko kamu.');
    }
}
