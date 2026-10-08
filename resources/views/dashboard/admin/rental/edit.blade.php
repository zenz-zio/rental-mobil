@extends('layouts.main')

@section('title', 'Edit Rental')

@section('content')

<div class="card card-warning">

    <div class="card-header">

        <h3 class="card-title">
            <i class="fas fa-edit mr-2"></i>
            Edit Rental
        </h3>

    </div>


    <form action="{{ route('admin.rental.update', $rental) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">

                <label>Mobil</label>

                <select name="mobil_id"
                        class="form-control"
                        required>

                    @foreach($mobils as $mobil)

                        <option value="{{ $mobil->id }}"
                            {{ $rental->mobil_id == $mobil->id ? 'selected' : '' }}>

                            {{ $mobil->merk }}
                            {{ $mobil->model }}
                            - {{ $mobil->no_plat }}

                        </option>

                    @endforeach

                </select>

            </div>


            <div class="form-group">

                <label>Pelanggan</label>

                <select name="pelanggan_id"
                        class="form-control"
                        required>

                    @foreach($pelanggans as $pelanggan)

                        <option value="{{ $pelanggan->id }}"
                            {{ $rental->pelanggan_id == $pelanggan->id ? 'selected' : '' }}>

                            {{ $pelanggan->nama }}

                        </option>

                    @endforeach

                </select>

            </div>


            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Tanggal Mulai</label>

                        <input type="date"
                               name="tanggal_mulai"
                               class="form-control"
                               value="{{ old('tanggal_mulai', $rental->tanggal_mulai->format('Y-m-d')) }}"
                               required>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="form-group">

                        <label>Tanggal Selesai</label>

                        <input type="date"
                               name="tanggal_selesai"
                               class="form-control"
                               value="{{ old('tanggal_selesai', $rental->tanggal_selesai->format('Y-m-d')) }}"
                               required>

                    </div>

                </div>

            </div>


            {{-- JAM AMBIL / KEMBALI --}}

            <div class="form-group">

                <label>Jam Ambil / Kembali</label>

                <input type="time"
                       name="jam_mulai"
                       class="form-control @error('jam_mulai') is-invalid @enderror"
                       value="{{ old('jam_mulai', substr($rental->jam_mulai ?? '09:00', 0, 5)) }}"
                       required>

                <small class="text-muted">
                    Jam kembali otomatis sama dengan jam ambil, di tanggal selesai.
                </small>

            </div>


            {{-- STATUS --}}

            <div class="form-group">

                <label>Status Rental</label>

                <select name="status"
                        class="form-control"
                        required>

                    <option value="menunggu"
                        {{ $rental->status == 'menunggu' ? 'selected' : '' }}>
                        Menunggu
                    </option>

                    <option value="disetujui"
                        {{ $rental->status == 'disetujui' ? 'selected' : '' }}>
                        Disetujui
                    </option>

                    <option value="berjalan"
                        {{ $rental->status == 'berjalan' ? 'selected' : '' }}>
                        Berjalan
                    </option>

                    <option value="selesai"
                        {{ $rental->status == 'selesai' ? 'selected' : '' }}>
                        Selesai
                    </option>

                    <option value="dibatalkan"
                        {{ $rental->status == 'dibatalkan' ? 'selected' : '' }}>
                        Dibatalkan
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label>Catatan</label>

                <textarea name="catatan"
                          class="form-control"
                          rows="3">{{ old('catatan', $rental->catatan) }}</textarea>

            </div>

        </div>


        <div class="card-footer">

            <button type="submit"
                    class="btn btn-warning">

                <i class="fas fa-save mr-1"></i>
                Update

            </button>

            <a href="{{ route('admin.rental.index') }}"
               class="btn btn-secondary">

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection