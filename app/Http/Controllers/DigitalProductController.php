<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\DigitalProduct;
use App\Models\TransactionItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DigitalProductController extends Controller
{
    private const ASSET_MIMES = 'pdf,zip,png,jpg,jpeg,ppt,pptx,doc,docx';

    private const DRAFT_FILE_FIELDS = ['photo', 'asset'];

    public function create(): View
    {
        $user = $this->authUser();
        $shop = $user->shop;
        $campaigns = Campaign::acceptingContributions()->orderBy('title')->get();
        $draft = $this->getDraft();

        return view('dashboard-hero.tambah-produk', compact('shop', 'campaigns', 'draft'));
    }

    public function saveDraft(Request $request): JsonResponse
    {
        $user = $this->authUser();

        if (! $user->shop) {
            return response()->json(['message' => 'Kamu belum punya toko.'], 403);
        }

        $validated = $request->validate([
            'title'       => ['nullable', 'string', 'max:255'],
            'price'       => ['nullable', 'numeric', 'min:0'],
            'category'    => ['nullable', 'string', 'max:100'],
            'stock'       => ['nullable', 'integer', 'min:0'],
            'campaign_id' => ['nullable', 'exists:campaigns,id'],
            'description' => ['nullable', 'string'],
        ]);

        $this->putDraft($validated);

        return response()->json(['ok' => true]);
    }

    public function uploadDraftFile(Request $request): JsonResponse
    {
        $user = $this->authUser();

        if (! $user->shop) {
            return response()->json(['message' => 'Kamu belum punya toko.'], 403);
        }

        $validated = $request->validate([
            'field' => ['required', Rule::in(self::DRAFT_FILE_FIELDS)],
            'file'  => ['required', 'file'],
        ]);

        $field = $validated['field'];
        $fileRules = $field === 'photo'
            ? ['file', 'image', 'max:5120']
            : ['file', 'mimes:'.self::ASSET_MIMES, 'max:51200'];

        $fileValidator = Validator::make(
            ['file' => $request->file('file')],
            ['file' => $fileRules],
            [
                'file.image' => 'Foto produk harus berformat JPG atau PNG.',
                'file.mimes' => 'Format aset: PDF, ZIP, PNG, JPG, PPT, PPTX, DOC, atau DOCX.',
                'file.max'   => $field === 'photo'
                    ? 'Foto produk maksimal 5MB.'
                    : 'Aset digital maksimal 50MB.',
            ]
        );

        if ($fileValidator->fails()) {
            return response()->json(['message' => $fileValidator->errors()->first('file')], 422);
        }

        $uploadedFile = $request->file('file');
        $draft = $this->getDraft();
        $this->deleteStoredFile($draft[$field.'_path'] ?? null);

        $storedPath = Storage::disk('public')->put($this->draftFolder(), $uploadedFile);
        $path = 'storage/'.$storedPath;

        $draftUpdates = [
            $field.'_path'          => $path,
            $field.'_original_name' => $uploadedFile->getClientOriginalName(),
        ];

        if ($field === 'asset') {
            $draftUpdates['asset_size_bytes'] = $uploadedFile->getSize();
        }

        $this->putDraft($draftUpdates);

        return response()->json([
            'ok'       => true,
            'field'    => $field,
            'filename' => $uploadedFile->getClientOriginalName(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $this->authUser();
        $shop = $user->shop;

        if (! $shop) {
            return redirect()->route('gabung-hero');
        }

        $draft = $this->getDraft();
        $hasDraftAsset = filled($draft['asset_path'] ?? null);

        $validated = $request->validate([
            'campaign_id' => ['required', 'exists:campaigns,id'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'stock'       => ['nullable', 'integer', 'min:0'],
            'category'    => ['required', 'string', 'max:100'],
            'photo'       => ['nullable', 'image', 'max:5120'],
            'asset'       => [
                Rule::requiredIf(! $request->hasFile('asset') && ! $hasDraftAsset),
                'nullable',
                'file',
                'mimes:'.self::ASSET_MIMES,
                'max:51200',
            ],
        ], [
            'asset.required' => 'File aset digital wajib diunggah.',
            'asset.mimes'    => 'Format aset: PDF, ZIP, PNG, JPG, PPT, PPTX, DOC, atau DOCX.',
            'asset.max'      => 'Ukuran aset digital maksimal 50MB.',
        ]);

        $campaign = Campaign::findOrFail($validated['campaign_id']);

        if (! $campaign->acceptsContributions()) {
            return redirect()->route('tambah-produk')
                ->withErrors(['campaign_id' => 'Program donasi yang dipilih sudah terpenuhi dan tidak menerima produk baru.'])
                ->withInput();
        }

        $previewPath = null;
        if ($request->hasFile('photo')) {
            $previewPath = 'storage/'.Storage::disk('public')->put('products', $request->file('photo'));
            $this->deleteStoredFile($draft['photo_path'] ?? null);
        } elseif (filled($draft['photo_path'] ?? null)) {
            $previewPath = $this->promoteDraftPath($draft['photo_path'], 'products');
        }

        if ($request->hasFile('asset')) {
            [$fileUrl, $fileSizeBytes] = $this->storeAssetFile($request->file('asset'));
            $this->deleteStoredFile($draft['asset_path'] ?? null);
        } elseif ($hasDraftAsset) {
            $fileUrl = $this->promoteDraftPath($draft['asset_path'], 'digital-products');
            $fileSizeBytes = (int) ($draft['asset_size_bytes'] ?? 0);
        } else {
            return redirect()->route('tambah-produk')
                ->withErrors(['asset' => 'File aset digital wajib diunggah.'])
                ->withInput();
        }

        DigitalProduct::create([
            'shop_id'         => $shop->id,
            'campaign_id'     => $validated['campaign_id'],
            'title'           => $validated['title'],
            'description'     => $validated['description'],
            'price'           => $validated['price'],
            'stock'           => $validated['stock'] ?? 0,
            'category'        => $validated['category'],
            'product_preview' => $previewPath,
            'file_url'        => $fileUrl,
            'file_size_bytes' => $fileSizeBytes,
        ]);

        session()->forget($this->draftSessionKey());

        return redirect()->route('toko-saya')
            ->with('success', 'Produk "'.$validated['title'].'" berhasil ditambahkan ke toko kamu!');
    }

    public function sold(): View
    {
        $user = $this->authUser();
        $shop = $user->shop;
        $productIds = $shop ? $shop->products()->pluck('id') : collect();

        $items = TransactionItem::query()
            ->whereIn('product_id', $productIds)
            ->with(['transaction.buyer', 'product'])
            ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
            ->orderByDesc('transactions.created_at')
            ->orderByDesc('transaction_items.id')
            ->select('transaction_items.*')
            ->paginate(10)
            ->withQueryString();

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
        $user = $this->authUser();
        $shop = $user->shop;

        abort_if(! $shop || $product->shop_id !== $shop->id, 403);

        $campaigns = Campaign::query()
            ->where(function ($query) use ($product) {
                $query->acceptingContributions()
                    ->orWhere('id', $product->campaign_id);
            })
            ->orderBy('title')
            ->get();

        return view('dashboard-hero.edit-produk', compact('shop', 'product', 'campaigns'));
    }

    public function update(Request $request, DigitalProduct $product): RedirectResponse
    {
        $user = $this->authUser();
        $shop = $user->shop;

        abort_if(! $shop || $product->shop_id !== $shop->id, 403);

        $validated = $request->validate([
            'campaign_id' => ['required', 'exists:campaigns,id'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'stock'       => ['nullable', 'integer', 'min:0'],
            'category'    => ['required', 'string', 'max:100'],
            'photo'       => ['nullable', 'image', 'max:5120'],
            'asset'       => ['nullable', 'file', 'mimes:'.self::ASSET_MIMES, 'max:51200'],
        ], [
            'asset.mimes' => 'Format aset: PDF, ZIP, PNG, JPG, PPT, PPTX, DOC, atau DOCX.',
            'asset.max'   => 'Ukuran aset digital maksimal 50MB.',
        ]);

        $campaign = Campaign::findOrFail($validated['campaign_id']);

        if (! $campaign->acceptsContributions() && (int) $campaign->id !== (int) $product->campaign_id) {
            return redirect()->route('edit-produk', $product)
                ->withErrors(['campaign_id' => 'Program donasi yang dipilih sudah terpenuhi dan tidak menerima produk baru.'])
                ->withInput();
        }

        $previewPath = $product->product_preview;
        if ($request->hasFile('photo')) {
            $previewPath = 'storage/'.Storage::disk('public')->put('products', $request->file('photo'));
        }

        $fileUrl = $product->file_url;
        $fileSizeBytes = $product->file_size_bytes;

        if ($request->hasFile('asset')) {
            $this->deleteStoredAsset($product->file_url);
            [$fileUrl, $fileSizeBytes] = $this->storeAssetFile($request->file('asset'));
        }

        $product->update([
            'campaign_id'     => $validated['campaign_id'],
            'title'           => $validated['title'],
            'description'     => $validated['description'],
            'price'           => $validated['price'],
            'stock'           => $validated['stock'] ?? 0,
            'category'        => $validated['category'],
            'product_preview' => $previewPath,
            'file_url'        => $fileUrl,
            'file_size_bytes' => $fileSizeBytes,
        ]);

        return redirect()->route('toko-saya')
            ->with('success', 'Produk "'.$product->title.'" berhasil diperbarui.');
    }

    public function destroy(DigitalProduct $product): RedirectResponse
    {
        $user = $this->authUser();
        $shop = $user->shop;

        abort_if(! $shop || $product->shop_id !== $shop->id, 403);

        if ($product->transactionItems()->exists()) {
            return redirect()->route('toko-saya')
                ->with('error', 'Produk "'.$product->title.'" tidak bisa dihapus karena sudah pernah terjual. Ubah stok jadi 0 kalau mau berhenti menjual produk ini.');
        }

        $title = $product->title;
        $this->deleteStoredAsset($product->file_url);
        $product->delete();

        return redirect()->route('toko-saya')
            ->with('success', 'Produk "'.$title.'" berhasil dihapus dari toko kamu.');
    }

    /** @return array<string, mixed> */
    private function getDraft(): array
    {
        return session($this->draftSessionKey(), []);
    }

    /** @param  array<string, mixed>  $data */
    private function putDraft(array $data): void
    {
        session([$this->draftSessionKey() => array_merge($this->getDraft(), $data)]);
    }

    private function draftSessionKey(): string
    {
        return 'product_create_draft_'.$this->authUser()->id;
    }

    private function draftFolder(): string
    {
        return 'product-drafts/'.$this->authUser()->id;
    }

    private function promoteDraftPath(string $draftPath, string $targetDir): string
    {
        $relative = substr($draftPath, strlen('storage/'));
        $filename = basename($relative);
        $destination = $targetDir.'/'.$filename;

        if (Storage::disk('public')->exists($relative)) {
            Storage::disk('public')->move($relative, $destination);
        }

        return 'storage/'.$destination;
    }

    /** @return array{0: string, 1: int} */
    private function storeAssetFile(UploadedFile $file): array
    {
        $storedPath = Storage::disk('public')->put('digital-products', $file);

        return ['storage/'.$storedPath, $file->getSize()];
    }

    private function deleteStoredAsset(?string $fileUrl): void
    {
        $this->deleteStoredFile($fileUrl);
    }

    private function deleteStoredFile(?string $fileUrl): void
    {
        if (! $fileUrl || ! str_starts_with($fileUrl, 'storage/')) {
            return;
        }

        Storage::disk('public')->delete(substr($fileUrl, strlen('storage/')));
    }
}
