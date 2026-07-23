<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pembayaran · KindlyJAR</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('global/style.css') }}"/>
  <link rel="stylesheet" href="{{ asset('global/dashboard.css') }}"/>
  @if (config('midtrans.is_production'))
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
  @else
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
  @endif
</head>
<body class="dashboard-body" style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px;">

  <div class="dash-main-card" style="max-width:520px;width:100%;text-align:center;padding:36px 28px;">
    @include('partials.flash-messages')

    <div style="font-size:2.5rem;margin-bottom:12px;">💳</div>
    <h1 style="font-family:'Nunito',sans-serif;font-weight:800;font-size:1.35rem;color:#1A1A2E;margin:0 0 8px;">
      Selesaikan Pembayaran
    </h1>
    <p style="font-family:'Open Sans',sans-serif;color:#6b7a8d;font-size:.92rem;margin:0 0 6px;">
      @if ($transaction->campaign)
        {{ $transaction->campaign->title }}
      @else
        Pembelian KindlyShop
      @endif
    </p>
    <p style="font-family:'Nunito',sans-serif;font-weight:800;font-size:1.5rem;color:#21A3FF;margin:0 0 24px;">
      Rp {{ number_format((float) $transaction->total_paid, 0, ',', '.') }}
    </p>

    <p style="font-family:'Open Sans',sans-serif;color:#6b7a8d;font-size:.85rem;margin:0 0 20px;">
      Order ID: <strong>{{ $transaction->midtrans_order_id }}</strong>
    </p>

    <button type="button" id="btnPayMidtrans" class="btn-form-next" style="width:100%;padding:14px;font-size:1rem;border:none;cursor:pointer;">
      Bayar dengan Midtrans
    </button>

    <a href="{{ $transaction->total_product_price > 0 ? route('keranjang') : ($transaction->campaign ? route('detail-program', $transaction->campaign) : route('program-donasi')) }}"
       style="display:inline-block;margin-top:16px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.85rem;color:#6b7a8d;text-decoration:none;">
      ← Kembali
    </a>
  </div>

  <script>
    const finishBaseUrl = @json(route('payment.finish', $transaction));

    function redirectToFinish(result) {
      const params = new URLSearchParams();
      if (result?.transaction_status) params.set('transaction_status', result.transaction_status);
      if (result?.transaction_id) params.set('transaction_id', result.transaction_id);
      if (result?.order_id) params.set('order_id', result.order_id);
      window.location.href = finishBaseUrl + (params.toString() ? '?' + params.toString() : '');
    }

    function openSnap() {
      snap.pay(@json($snapToken), {
        onSuccess: function (result) {
          alert('Pembayaran berhasil!');
          console.log('onSuccess:', result);
          redirectToFinish(result);
        },
        onPending: function (result) {
          alert('Menunggu pembayaranmu. Selesaikan instruksi di metode yang dipilih.');
          console.log('onPending:', result);
          redirectToFinish(result);
        },
        onError: function (result) {
          alert('Pembayaran gagal. Silakan coba lagi.');
          console.log('onError:', result);
          redirectToFinish(result);
        },
        onClose: function () {
          alert('Kamu menutup popup tanpa menyelesaikan pembayaran.');
        }
      });
    }

    document.getElementById('btnPayMidtrans').addEventListener('click', openSnap);

    window.addEventListener('DOMContentLoaded', function () {
      openSnap();
    });
  </script>
</body>
</html>
