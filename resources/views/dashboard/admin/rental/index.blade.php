@extends('layouts.main')

@section('title', 'Data Rental')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-file-invoice mr-2"></i>
            Data Rental
        </h3>
    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>Mobil</th>
                        <th>Tanggal Rental</th>
                        <th>Total</th>
                        <th>Pembayaran</th>
                        <th>Status Rental</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($rentals as $rental)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $rental->pelanggan->nama ?? '-' }}

                                <br>

                                <small class="text-muted">
                                    {{ $rental->pelanggan->email ?? '-' }}
                                </small>
                            </td>

                            <td>
                                <strong>
                                    {{ $rental->mobil->merk ?? '-' }}
                                    {{ $rental->mobil->model ?? '' }}
                                </strong>

                                <br>

                                <small class="text-muted">
                                    {{ $rental->mobil->no_plat ?? '-' }}
                                </small>
                            </td>

                            <td>
                                {{ $rental->tanggal_mulai->format('d/m/Y') }}
                                -
                                {{ $rental->tanggal_selesai->format('d/m/Y') }}

                                <br>

                                <small class="text-muted">
                                    {{ $rental->jumlah_hari }} hari

                                    @if($rental->jam_mulai)
                                        &middot;
                                        <i class="far fa-clock"></i>
                                        {{ \Carbon\Carbon::parse($rental->jam_mulai)->format('H:i') }}
                                    @endif
                                </small>
                            </td>

                            <td>
                                <strong>
                                    Rp {{ number_format($rental->total_harga, 0, ',', '.') }}
                                </strong>
                            </td>

                            {{-- PEMBAYARAN --}}
                            <td>

                                @if($rental->pembayaran)

                                    @if($rental->pembayaran->transaction_status === 'settlement')

                                        <span class="badge badge-success">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Lunas
                                        </span>

                                        <br>

                                        <small class="text-muted">
                                            {{ strtoupper($rental->pembayaran->payment_type ?? '-') }}
                                        </small>

                                    @elseif($rental->pembayaran->transaction_status === 'pending')

                                        <span class="badge badge-warning">
                                            Menunggu Pembayaran
                                        </span>

                                    @elseif(
                                        in_array(
                                            $rental->pembayaran->transaction_status,
                                            ['expire', 'cancel', 'deny']
                                        )
                                    )

                                        <span class="badge badge-danger">
                                            Gagal / Kadaluarsa
                                        </span>

                                    @else

                                        <span class="badge badge-secondary">
                                            {{ ucfirst($rental->pembayaran->transaction_status) }}
                                        </span>

                                    @endif

                                @else

                                    <span class="badge badge-secondary">
                                        Belum Ada Pembayaran
                                    </span>

                                @endif

                            </td>

                            {{-- STATUS RENTAL --}}
                            <td>

                                @if($rental->status === 'menunggu')

                                    <span class="badge badge-warning">
                                        Menunggu
                                    </span>

                                @elseif($rental->status === 'disetujui')

                                    <span class="badge badge-primary">
                                        Disetujui
                                    </span>

                                @elseif($rental->status === 'berjalan')

                                    <span class="badge badge-info">
                                        <i class="fas fa-car mr-1"></i>
                                        Berjalan
                                    </span>

                                @elseif($rental->status === 'selesai')

                                    <span class="badge badge-success">
                                        Selesai
                                    </span>

                                @elseif($rental->status === 'dibatalkan')

                                    <span class="badge badge-danger">
                                        Dibatalkan
                                    </span>

                                @else

                                    <span class="badge badge-secondary">
                                        {{ ucfirst($rental->status) }}
                                    </span>

                                @endif

                            </td>

                            {{-- AKSI --}}
                            <td>

                                <a href="{{ route('admin.rental.show', $rental->id) }}"
                                   class="btn btn-sm btn-info">

                                    <i class="fas fa-eye"></i>
                                    Detail

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="text-center py-4">

                                <i class="fas fa-file-invoice fa-3x text-muted mb-3"></i>

                                <p class="mb-0">
                                    Belum ada data rental.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection