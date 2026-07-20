<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pencairan Dana · KindlyJAR</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('global/style.css') }}"/>
  <link rel="stylesheet" href="{{ asset('global/dashboard.css') }}"/>
</head>
<body class="dashboard-body">

  @include('partials.admin-sidebar')

  <div class="dash-right">
    @include('partials.admin-topbar', ['pageTitle' => 'Pencairan Dana'])

    @if (session('success'))
      <div class="verification-banner" style="background:#ecfdf5;border-color:#a7f3d0;">
        <div class="banner-content"><span class="banner-icon">✅</span><p>{{ session('success') }}</p></div>
      </div>
    @endif
    @if (session('error'))
      <div class="verification-banner" style="background:#fef2f2;border-color:#fecaca;">
        <div class="banner-content"><span class="banner-icon">⚠️</span><p>{{ session('error') }}</p></div>
      </div>
    @endif

    <main class="dash-scroll">
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
                          <div style="display:flex;gap:6px;">
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
    </main>
  </div>
</body>
</html>
