<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Penyaluran Donasi · KindlyJAR</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('global/style.css') }}"/>
  <link rel="stylesheet" href="{{ asset('global/dashboard.css') }}"/>
</head>
<body class="dashboard-body">

  @include('partials.admin-sidebar')

  <div class="dash-right">
    @include('partials.admin-topbar', ['pageTitle' => 'Penyaluran Donasi'])

    <main class="dash-scroll">
      <div class="dash-main-card">
        <section class="dash-section">
          <h2 class="dash-card-title">Pantau Penyaluran Donasi</h2>
          <p class="dash-card-sub">Lihat perbandingan target, dana terkumpul, dan dana yang sudah disalurkan ke setiap program.</p>

          <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;">
              <thead>
                <tr style="text-align:left;border-bottom:1px solid #eef1f6;">
                  <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Program</th>
                  <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Fundraiser</th>
                  <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Target</th>
                  <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Terkumpul</th>
                  <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Tersalurkan</th>
                  <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Sisa Saldo</th>
                  <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Donasi Sukses</th>
                  <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($campaigns as $c)
                  @php
                    $statusColor = match($c->status) {
                      'active' => ['bg' => '#e6f9ee', 'text' => '#1a7d43'],
                      'completed' => ['bg' => '#eef4ff', 'text' => '#21A3FF'],
                      default => ['bg' => '#eef1f6', 'text' => '#6b7a8d'],
                    };
                    $progress = $c->target_amount > 0 ? min(100, round(($c->collected_amount / $c->target_amount) * 100)) : 0;
                  @endphp
                  <tr style="border-bottom:1px solid #f5f7fa;">
                    <td style="padding:10px 8px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.85rem;">
                      {{ $c->title }}
                      <div style="width:100px;height:5px;background:#eef1f6;border-radius:999px;margin-top:4px;">
                        <div style="width:{{ $progress }}%;height:5px;background:#21A3FF;border-radius:999px;"></div>
                      </div>
                    </td>
                    <td style="padding:10px 8px;font-family:'Open Sans',sans-serif;font-size:.85rem;">{{ $c->fundraiser->display_name ?? '—' }}</td>
                    <td style="padding:10px 8px;font-family:'Open Sans',sans-serif;font-size:.85rem;">Rp {{ number_format($c->target_amount, 0, ',', '.') }}</td>
                    <td style="padding:10px 8px;font-family:'Open Sans',sans-serif;font-size:.85rem;">Rp {{ number_format($c->collected_amount, 0, ',', '.') }}</td>
                    <td style="padding:10px 8px;font-family:'Open Sans',sans-serif;font-size:.85rem;">Rp {{ number_format($c->withdrawn_amount, 0, ',', '.') }}</td>
                    <td style="padding:10px 8px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.85rem;">Rp {{ number_format($c->available_balance, 0, ',', '.') }}</td>
                    <td style="padding:10px 8px;font-family:'Open Sans',sans-serif;font-size:.85rem;">{{ $c->transactions_count }}</td>
                    <td style="padding:10px 8px;">
                      <span style="display:inline-block;padding:4px 10px;border-radius:999px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.75rem;background:{{ $statusColor['bg'] }};color:{{ $statusColor['text'] }};">{{ ucfirst($c->status) }}</span>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="8" style="padding:16px 8px;text-align:center;color:#94a3b8;">Belum ada program donasi.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </section>
      </div>
    </main>
  </div>
</body>
</html>
