@extends('layouts.admin')

@section('title', 'Riwayat Transaksi')
@section('pageTitle', 'Riwayat Transaksi')

@section('content')
      <div class="dash-main-card">
        <section class="dash-section">
          <h2 class="dash-card-title">Semua Transaksi</h2>
          <p class="dash-card-sub">Pantau seluruh transaksi donasi dan pembelian produk di KindlyJAR.</p>

          <div style="display:flex;gap:8px;margin-bottom:20px;flex-wrap:wrap;">
            @foreach (['all' => 'Semua', 'success' => 'Sukses', 'pending' => 'Menunggu', 'failed' => 'Gagal'] as $key => $label)
              <a href="{{ route('admin.transactions', ['status' => $key]) }}"
                 class="{{ $status === $key ? 'btn-form-next' : 'btn-danger-outline' }}"
                 style="padding:6px 16px;font-size:.8rem;display:inline-block;text-decoration:none;{{ $status !== $key ? 'color:#6b7a8d;border-color:#dfe6ee;' : '' }}">
                {{ $label }}
              </a>
            @endforeach
          </div>

          <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;">
              <thead>
                <tr style="text-align:left;border-bottom:1px solid #eef1f6;">
                  <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Pembeli/Donatur</th>
                  <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Program</th>
                  <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Total Dibayar</th>
                  <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Tanggal</th>
                  <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($transactions as $t)
                  @php
                    $statusColor = match($t->status) {
                      'success' => ['bg' => '#e6f9ee', 'text' => '#1a7d43'],
                      'failed' => ['bg' => '#fdecea', 'text' => '#b3261e'],
                      default => ['bg' => '#fff7e6', 'text' => '#b7791f'],
                    };
                    $statusLabel = match($t->status) {
                      'success' => 'Sukses',
                      'failed' => 'Gagal',
                      default => 'Menunggu',
                    };
                  @endphp
                  <tr style="border-bottom:1px solid #f5f7fa;">
                    <td style="padding:10px 8px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.85rem;">
                      {{ $t->is_anonymous ? 'Anonim' : ($t->buyer->display_name ?? '—') }}
                    </td>
                    <td style="padding:10px 8px;font-family:'Open Sans',sans-serif;font-size:.85rem;">{{ $t->campaign->title ?? 'Beberapa program' }}</td>
                    <td style="padding:10px 8px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.85rem;">Rp {{ number_format($t->total_paid, 0, ',', '.') }}</td>
                    <td style="padding:10px 8px;font-family:'Open Sans',sans-serif;font-size:.85rem;">{{ optional($t->payment_time ?? $t->created_at)->translatedFormat('d M Y, H:i') ?? '—' }}</td>
                    <td style="padding:10px 8px;">
                      <span style="display:inline-block;padding:4px 10px;border-radius:999px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.75rem;background:{{ $statusColor['bg'] }};color:{{ $statusColor['text'] }};">{{ $statusLabel }}</span>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="5" style="padding:16px 8px;text-align:center;color:#94a3b8;">Belum ada transaksi.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
          @include('partials.pagination', ['paginator' => $transactions])
        </section>
      </div>
@endsection
