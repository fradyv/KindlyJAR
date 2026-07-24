@extends('layouts.admin')

@section('title', 'Pencairan Dana')
@section('pageTitle', 'Pencairan Dana')

@section('content')
      <div class="dash-main-card">
        <section class="dash-section">
          <h2 class="dash-card-title">Permintaan Pencairan Dana</h2>
          <p class="dash-card-sub">Setujui atau tolak permintaan pencairan dana dari fundraiser.</p>

          <div style="display:flex;gap:8px;margin-bottom:20px;flex-wrap:wrap;">
            @foreach (['pending' => 'Menunggu', 'approved' => 'Disetujui', 'rejected' => 'Ditolak', 'all' => 'Semua'] as $key => $label)
              <a href="{{ route('admin.withdrawals', ['status' => $key]) }}"
                 class="{{ $status === $key ? 'btn-form-next' : 'btn-danger-outline' }}"
                 style="padding:6px 16px;font-size:.8rem;display:inline-block;text-decoration:none;{{ $status !== $key ? 'color:#6b7a8d;border-color:#dfe6ee;' : '' }}">
                {{ $label }}
              </a>
            @endforeach
          </div>

          @if ($withdrawals->isEmpty())
            <p class="shop-empty-state">Tidak ada permintaan pencairan pada kategori ini.</p>
          @else
            <div style="overflow-x:auto;">
              <table style="width:100%;border-collapse:collapse;">
                <thead>
                  <tr style="text-align:left;border-bottom:1px solid #eef1f6;">
                    <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Fundraiser</th>
                    <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Jumlah</th>
                    <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Tujuan</th>
                    <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Diajukan</th>
                    <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Status</th>
                    <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($withdrawals as $w)
                    @php
                      $statusColor = match($w->status) {
                        'approved' => ['bg' => '#e6f9ee', 'text' => '#1a7d43'],
                        'rejected' => ['bg' => '#fdecea', 'text' => '#b3261e'],
                        default => ['bg' => '#fff7e6', 'text' => '#b7791f'],
                      };
                      $statusLabel = match($w->status) {
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        default => 'Menunggu',
                      };
                    @endphp
                    <tr style="border-bottom:1px solid #f5f7fa;">
                      <td style="padding:10px 8px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.85rem;">{{ $w->wallet->user->display_name ?? '—' }}</td>
                      <td style="padding:10px 8px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.85rem;">Rp {{ number_format($w->amount, 0, ',', '.') }}</td>
                      <td style="padding:10px 8px;font-family:'Open Sans',sans-serif;font-size:.85rem;max-width:200px;">{{ $w->bank_or_ewallet_info }}</td>
                      <td style="padding:10px 8px;font-family:'Open Sans',sans-serif;font-size:.85rem;">{{ $w->created_at->translatedFormat('d M Y') }}</td>
                      <td style="padding:10px 8px;">
                        <span style="display:inline-block;padding:4px 10px;border-radius:999px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.75rem;background:{{ $statusColor['bg'] }};color:{{ $statusColor['text'] }};">{{ $statusLabel }}</span>
                      </td>
                      <td style="padding:10px 8px;">
                        @if ($w->status === 'pending')
                          <div style="display:flex;gap:6px;flex-wrap:wrap;">
                            <form method="POST" action="{{ route('admin.withdrawals.approve', $w) }}">
                              @csrf
                              <button type="submit" class="btn-success-solid" style="padding:5px 12px;font-size:.75rem;">Setujui</button>
                            </form>
                            <form method="POST" action="{{ route('admin.withdrawals.reject', $w) }}">
                              @csrf
                              <button type="submit" class="btn-danger-outline" style="padding:5px 12px;font-size:.75rem;">Tolak</button>
                            </form>
                          </div>
                        @else
                          &mdash;
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        </section>
      </div>
@endsection
