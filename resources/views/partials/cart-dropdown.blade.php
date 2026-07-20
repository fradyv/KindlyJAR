<div class="notif-dropdown" id="cartDropdown">
  <div class="notif-header">
    <span class="notif-title">Keranjang</span>
    <span class="notif-badge">{{ $navCartCount ?? 0 }} item</span>
  </div>
  @forelse (($navCartItems ?? collect()) as $cartItem)
    <div style="display:flex;gap:10px;padding:10px 14px;border-bottom:1px solid #f1f4f8;align-items:center;">
      <img src="{{ $cartItem->product->product_preview ? asset($cartItem->product->product_preview) : asset('assets/kata15.jpg') }}"
           alt="{{ $cartItem->product->title }}"
           onerror="this.src='{{ asset('assets/kata15.jpg') }}'"
           style="width:38px;height:38px;border-radius:8px;object-fit:cover;flex-shrink:0;" />
      <div style="flex:1;min-width:0;">
        <p style="margin:0;font-size:.8rem;font-weight:700;color:#3D3D4E;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $cartItem->product->title }}</p>
        <p style="margin:2px 0 0;font-size:.75rem;color:#6b7a8d;">{{ $cartItem->quantity }} &times; Rp {{ number_format($cartItem->product->price, 0, ',', '.') }}</p>
      </div>
    </div>
  @empty
    <div class="notif-empty">
      <svg width="36" height="36" fill="none" stroke="#b0b7c3" stroke-width="1.5" viewBox="0 0 24 24">
        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
        <line x1="3" y1="6" x2="21" y2="6"/>
        <path d="M16 10a4 4 0 01-8 0"/>
      </svg>
      <p>Keranjang masih kosong</p>
    </div>
  @endforelse
  @if (($navCartItems ?? collect())->isNotEmpty())
    <div style="padding:10px 14px;">
      <a href="{{ route('keranjang') }}" style="display:block;text-align:center;text-decoration:none;padding:10px;border-radius:10px;background:#21A3FF;color:#fff;font-family:'Nunito',sans-serif;font-weight:700;font-size:.85rem;">Lihat Keranjang</a>
    </div>
  @endif
</div>
