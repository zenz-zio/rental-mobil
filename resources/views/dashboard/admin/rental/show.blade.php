@extends('layouts.main')

@section('title', 'Detail Rental')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            <i class="fas fa-file-invoice mr-2"></i>
            Detail Rental
        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="200">Pelanggan</th>
                <td>{{ $rental->pelanggan->nama ?? '-' }}</td>
            </tr>

            <tr>
                <th>NIK</th>
                <td>{{ $rental->pelanggan->nik ?? '-' }}</td>
            </tr>

            <tr>
                <th>No HP</th>
                <td>{{ $rental->pelanggan->no_hp ?? '-' }}</td>
            </tr>

            <tr>
                <th>Mobil</th>
                <td>
                    {{ $rental->mobil->merk ?? '-' }}
                    {{ $rental->mobil->model ?? '' }}
                </td>
            </tr>

            <tr>
                <th>No Plat</th>
                <td>{{ $rental->mobil->no_plat ?? '-' }}</td>
            </tr>

            <tr>
                <th>Tanggal Mulai</th>
                <td>
                    {{ $rental->tanggal_mulai->format('d/m/Y') }}

                    @if($rental->jam_mulai)
                        <span class="text-muted">
                            &middot; <i class="far fa-clock"></i>
                            {{ \Carbon\Carbon::parse($rental->jam_mulai)->format('H:i') }}
                        </span>
                    @endif
                </td>
            </tr>

            <tr>
                <th>Tanggal Selesai</th>
                <td>
                    {{ $rental->tanggal_selesai->format('d/m/Y') }}

                    @if($rental->jam_selesai)
                        <span class="text-muted">
                            &middot; <i class="far fa-clock"></i>
                            {{ \Carbon\Carbon::parse($rental->jam_selesai)->format('H:i') }}
                        </span>
                    @endif
                </td>
            </tr>

            <tr>
                <th>Jumlah Hari</th>
                <td>{{ $rental->jumlah_hari }} hari</td>
            </tr>

            <tr>
                <th>Harga Per Hari</th>
                <td>
                    Rp {{ number_format($rental->harga_per_hari, 0, ',', '.') }}
                </td>
            </tr>

            <tr>
                <th>Total Harga</th>
                <td>
                    <strong>
                        Rp {{ number_format($rental->total_harga, 0, ',', '.') }}
                    </strong>
                </td>
            </tr>

            <tr>
                <th>Status</th>
                <td>
                    {{ ucfirst($rental->status) }}
                </td>
            </tr>

            <tr>
                <th>Catatan</th>
                <td>{{ $rental->catatan ?? '-' }}</td>
            </tr>

        </table>

    </div>

    <div class="card-footer">

        <a href="{{ route('admin.rental.edit', $rental) }}"
           class="btn btn-warning">

            <i class="fas fa-edit mr-1"></i>
            Edit

        </a>

        <a href="{{ route('admin.rental.index') }}"
           class="btn btn-secondary">

            Kembali

        </a>

    </div>

</div>

@endsection