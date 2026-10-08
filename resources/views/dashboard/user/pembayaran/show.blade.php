@extends('layouts.user')

@section('title', 'Pembayaran Rental')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

<style>

    :root{
        --aspal:#18181A;
        --aspal-soft:#242427;
        --kapur:#F7F4EE;
        --merah:#D93A2B;
        --merah-deep:#B22A1E;
        --marka:#F2B705;
        --hijau:#2F9E56;
        --teks-mute:#6b6763;
    }

    /* ===== ALERTS ===== */

    .tempuh-alert{
        border-radius:3px;
        border:1.5px solid;
        border-left-width:5px;
        font-weight:600;
        font-size:0.92rem;
        padding:0.9rem 1.1rem;
        background:var(--kapur);
    }

    .tempuh-alert.success{
        border-color:var(--hijau);
        color:var(--aspal);
    }

    .tempuh-alert.success i{
        color:var(--hijau);
    }

    .tempuh-alert.error{
        border-color:var(--merah);
        color:var(--aspal);
    }

    .tempuh-alert.error i{
        color:var(--merah);
    }

    /* ===== CARD ===== */

    .bayar-card{
        border:none !important;
        border-radius:4px;
        overflow:hidden;
        box-shadow:6px 6px 0 var(--marka);
    }

    .bayar-card .card-header{
        background:var(--aspal) !important;
        border-bottom:none !important;
        padding:1.1rem 1.4rem;
    }

    .bayar-card .card-title{
        font-family:'Big Shoulders Display', sans-serif;
        font-weight:800;
        text-transform:uppercase;
        letter-spacing:0.02em;
        font-size:1.3rem;
        color:var(--kapur) !important;
        margin:0;
        display:flex;
        align-items:center;
    }

    .bayar-card .card-title i{
        color:var(--marka);
    }

    .bayar-card .card-body{
        background:var(--kapur);
        padding:1.6rem 1.4rem;
    }

    .bayar-card .card-footer{
        background:var(--kapur);
        border-top:1px dashed rgba(0,0,0,0.15);
        padding:1.1rem 1.4rem;
    }

    .bayar-card h3.mobil-title{
        font-family:'Big Shoulders Display', sans-serif;
        font-weight:800;
        text-transform:uppercase;
        color:var(--aspal);
        font-size:1.7rem;
    }

    .bayar-card hr{
        border-top:1px dashed rgba(0,0,0,0.18);
    }

    .detail-label{
        font-family:'JetBrains Mono', monospace;
        font-size:11px;
        font-weight:700;
        letter-spacing:0.05em;
        text-transform:uppercase;
        color:var(--teks-mute);
        display:flex;
        align-items:center;
    }

    .detail-label i{
        color:var(--merah);
    }

    .detail-value{
        font-weight:600;
        font-size:0.98rem;
        color:var(--aspal);
        margin-top:2px;
    }

    /* ===== TOTAL ===== */

    .total-box{
        background:var(--aspal);
        border-radius:4px;
        padding:1.6rem 1rem;
        margin:0.5rem 0;
    }

    .total-box .total-label{
        font-family:'JetBrains Mono', monospace;
        font-size:11.5px;
        font-weight:600;
        letter-spacing:0.08em;
        text-transform:uppercase;
        color:var(--marka);
    }

    .total-box .total-value{
        font-family:'Big Shoulders Display', sans-serif;
        font-weight:900;
        font-size:2.6rem;
        color:var(--kapur);
        margin:0.2rem 0 0.9rem;
    }

    /* ===== STATUS CHIPS ===== */

    .chip{
        display:inline-flex;
        align-items:center;
        gap:6px;
        font-family:'JetBrains Mono', monospace;
        font-size:11px;
        font-weight:700;
        letter-spacing:0.05em;
        text-transform:uppercase;
        padding:6px 13px;
        border-radius:3px;
    }

    .chip-pending{
        background:var(--marka);
        color:var(--aspal);
    }

    .chip-success{
        background:var(--hijau);
        color:var(--kapur);
    }

    .chip-failed{
        background:var(--merah);
        color:var(--kapur);
    }

    .chip-lainnya{
        background:#d8d3c8;
        color:var(--aspal);
    }

    /* ===== FOOTER BUTTONS ===== */

    .btn-kembali{
        display:inline-flex;
        align-items:center;
        background:transparent;
        color:var(--aspal) !important;
        border:1.5px solid var(--aspal);
        border-radius:2px;
        font-weight:700;
        font-size:0.9rem;
        padding:0.62rem 1.2rem;
        transition:background .15s ease, color .15s ease;
    }

    .btn-kembali:hover{
        background:var(--aspal);
        color:var(--kapur) !important;
    }

    .btn-qris{
        display:inline-flex;
        align-items:center;
        background:var(--merah);
        color:var(--kapur) !important;
        border:none;
        border-radius:2px;
        font-weight:700;
        font-size:0.9rem;
        padding:0.62rem 1.3rem;
        box-shadow:4px 4px 0 var(--aspal);
        transition:transform .15s ease, box-shadow .15s ease;
    }

    .btn-qris:hover{
        color:var(--kapur) !important;
        transform:translate(-2px,-2px);
        box-shadow:6px 6px 0 var(--aspal);
    }

    .btn-sudah-bayar{
        display:inline-flex;
        align-items:center;
        background:var(--hijau);
        color:var(--kapur) !important;
        border:none;
        border-radius:2px;
        font-weight:700;
        font-size:0.9rem;
        padding:0.62rem 1.3rem;
        opacity:0.9;
        cursor:default;
    }

</style>


<div class="row justify-content-center">

    <div class="col-md-8">

        {{-- Alert --}}

        @if(session('success'))
            <div class="alert tempuh-alert success">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert tempuh-alert error">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif


        {{-- Card Pembayaran --}}

        <div class="card bayar-card">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-credit-card mr-2"></i>

                    Pembayaran Rental

                </h3>

            </div>


            <div class="card-body">

                {{-- Mobil --}}

                <h3 class="mobil-title mb-3">

                    {{ $rental->mobil->merk ?? '-' }}

                    {{ $rental->mobil->model ?? '' }}

                </h3>

                <hr>


                {{-- Detail Rental --}}

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <div class="detail-label">

                            <i class="fas fa-calendar-alt mr-2"></i>

                            Tanggal Mulai

                        </div>

                        <p class="detail-value mb-0">

                            {{ $rental->tanggal_mulai->format('d/m/Y') }}

                        </p>

                    </div>


                    <div class="col-md-6 mb-3">

                        <div class="detail-label">

                            <i class="fas fa-calendar-check mr-2"></i>

                            Tanggal Selesai

                        </div>

                        <p class="detail-value mb-0">

                            {{ $rental->tanggal_selesai->format('d/m/Y') }}

                        </p>

                    </div>


                    <div class="col-md-6 mb-3">

                        <div class="detail-label">

                            <i class="fas fa-clock mr-2"></i>

                            Jumlah Hari

                        </div>

                        <p class="detail-value mb-0">

                            {{ $rental->jumlah_hari }} hari

                        </p>

                    </div>


                    <div class="col-md-6 mb-3">

                        <div class="detail-label">

                            <i class="fas fa-money-bill-wave mr-2"></i>

                            Harga / Hari

                        </div>

                        <p class="detail-value mb-0">

                            Rp {{ number_format($rental->harga_per_hari, 0, ',', '.') }}

                        </p>

                    </div>

                </div>


                <hr>


                {{-- Total Pembayaran --}}

                <div class="text-center py-3">

                    <div class="total-box">

                        <div class="total-label">

                            Total Pembayaran

                        </div>

                        <div class="total-value">

                            Rp {{ number_format($rental->total_harga, 0, ',', '.') }}

                        </div>


                        {{-- Status Pembayaran --}}

                        @if($pembayaran->transaction_status === 'pending')

                            <span class="chip chip-pending">

                                <i class="fas fa-clock"></i>

                                Menunggu Pembayaran

                            </span>

                        @elseif(
                            $pembayaran->transaction_status === 'settlement'
                            ||
                            $pembayaran->transaction_status === 'capture'
                        )

                            <span class="chip chip-success">

                                <i class="fas fa-check-circle"></i>

                                Pembayaran Berhasil

                            </span>

                        @elseif($pembayaran->transaction_status === 'expire')

                            <span class="chip chip-failed">

                                <i class="fas fa-clock"></i>

                                Pembayaran Kadaluarsa

                            </span>

                        @elseif(
                            in_array(
                                $pembayaran->transaction_status,
                                ['cancel', 'deny']
                            )
                        )

                            <span class="chip chip-failed">

                                <i class="fas fa-times-circle"></i>

                                Pembayaran Gagal

                            </span>

                        @else

                            <span class="chip chip-lainnya">

                                {{ ucfirst($pembayaran->transaction_status) }}

                            </span>

                        @endif

                    </div>

                </div>

            </div>


            {{-- Footer --}}

            <div class="card-footer d-flex justify-content-between">

                <a
                    href="{{ route('user.rental.index') }}"
                    class="btn-kembali"
                >

                    <i class="fas fa-arrow-left mr-1"></i>

                    Kembali

                </a>


                {{-- Tombol Bayar --}}

                @if($pembayaran->transaction_status === 'pending')

                    <button
                        type="button"
                        id="pay-button"
                        class="btn-qris ml-auto"
                    >

                        <i class="fas fa-qrcode mr-1"></i>

                        Bayar dengan QRIS

                    </button>


                {{-- Sudah Bayar --}}

                @elseif(
                    $pembayaran->transaction_status === 'settlement'
                    ||
                    $pembayaran->transaction_status === 'capture'
                )

                    <span class="btn-sudah-bayar ml-auto">

                        <i class="fas fa-check-circle mr-1"></i>

                        Sudah Dibayar

                    </span>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- ===================================================== --}}
{{-- MIDTRANS SNAP --}}
{{-- ===================================================== --}}

<script
    src="{{ config('services.midtrans.is_production')
        ? 'https://app.midtrans.com/snap/snap.js'
        : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
    data-client-key="{{ config('services.midtrans.client_key') }}">
</script>


<script>

document.getElementById('pay-button')?.addEventListener('click', function () {

    const button = this;

    button.disabled = true;

    snap.pay('{{ $snapToken }}', {

        /*
        |--------------------------------------------------------------------------
        | PEMBAYARAN BERHASIL
        |--------------------------------------------------------------------------
        */

        onSuccess: function (result) {

            console.log('Pembayaran berhasil:', result);

            /*
             * Kirim hasil pembayaran ke Laravel.
             * Ini yang membuat:
             *
             * pembayaran = settlement
             * rental = berjalan
             * mobil = disewa
             */

            fetch(
                '{{ route('user.pembayaran.success', $rental->id) }}',
                {
                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },

                    body: JSON.stringify({

                        transaction_id:
                            result.transaction_id ?? null,

                        payment_type:
                            result.payment_type ?? 'bank_transfer'

                    })
                }
            )

            .then(function (response) {

                return response.json().then(function (data) {

                    if (!response.ok) {

                        throw new Error(
                            data.message ||
                            'Gagal memperbarui status pembayaran.'
                        );

                    }

                    return data;

                });

            })

            .then(function (data) {

                console.log(
                    'Response Laravel:',
                    data
                );

                if (data.success) {

                    /*
                     * Status berhasil diperbarui.
                     * Kembali ke halaman Rental Saya.
                     */

                    window.location.href =
                        '{{ route('user.rental.index') }}';

                } else {

                    button.disabled = false;

                    alert(
                        data.message ||
                        'Pembayaran berhasil, tetapi status rental belum diperbarui.'
                    );

                }

            })

            .catch(function (error) {

                console.error(
                    'Error update pembayaran:',
                    error
                );

                /*
                 * Jangan langsung menganggap pembayaran gagal.
                 * Pembayaran Midtrans sudah berhasil.
                 */

                alert(
                    'Pembayaran berhasil, tetapi status rental belum diperbarui. Silakan refresh halaman.'
                );

                button.disabled = false;

            });

        },


        /*
        |--------------------------------------------------------------------------
        | PEMBAYARAN PENDING
        |--------------------------------------------------------------------------
        */

        onPending: function (result) {

            console.log(
                'Pembayaran pending:',
                result
            );

            button.disabled = false;

            alert(
                'Pembayaran masih menunggu. Silakan selesaikan pembayaran terlebih dahulu.'
            );

        },


        /*
        |--------------------------------------------------------------------------
        | PEMBAYARAN ERROR
        |--------------------------------------------------------------------------
        */

        onError: function (result) {

            console.log(
                'Pembayaran gagal:',
                result
            );

            button.disabled = false;

            alert(
                'Pembayaran gagal. Silakan coba lagi.'
            );

        },


        /*
        |--------------------------------------------------------------------------
        | USER MENUTUP MIDTRANS
        |--------------------------------------------------------------------------
        */

        onClose: function () {

            console.log(
                'User menutup halaman pembayaran.'
            );

            button.disabled = false;

        }

    });

});

</script>

@endsection