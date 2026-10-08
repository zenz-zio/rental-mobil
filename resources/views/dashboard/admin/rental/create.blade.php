@extends('layouts.main')

@section('title', 'Tambah Rental')

@section('content')

<div class="card card-primary">

    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-plus mr-2"></i>
            Tambah Rental
        </h3>
    </div>

    <form action="{{ route('admin.rental.store') }}" method="POST">

        @csrf

        <div class="card-body">

            <div class="form-group">
                <label>Mobil</label>

                <select name="mobil_id"
                        class="form-control @error('mobil_id') is-invalid @enderror"
                        required>

                    <option value="">-- Pilih Mobil --</option>

                    @foreach($mobils as $mobil)

                        <option value="{{ $mobil->id }}"
                            {{ old('mobil_id') == $mobil->id ? 'selected' : '' }}>

                            {{ $mobil->merk }}
                            {{ $mobil->model }}
                            - {{ $mobil->no_plat }}
                            - Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}/hari

                        </option>

                    @endforeach

                </select>

                @error('mobil_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>


            <div class="form-group">

                <label>Pelanggan</label>

                <select name="pelanggan_id"
                        class="form-control @error('pelanggan_id') is-invalid @enderror"
                        required>

                    <option value="">-- Pilih Pelanggan --</option>

                    @foreach($pelanggans as $pelanggan)

                        <option value="{{ $pelanggan->id }}"
                            {{ old('pelanggan_id') == $pelanggan->id ? 'selected' : '' }}>

                            {{ $pelanggan->nama }}
                            - {{ $pelanggan->no_hp }}

                        </option>

                    @endforeach

                </select>

                @error('pelanggan_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror

            </div>


            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Tanggal Mulai</label>

                        <input type="date"
                               name="tanggal_mulai"
                               class="form-control"
                               value="{{ old('tanggal_mulai') }}"
                               required>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="form-group">

                        <label>Tanggal Selesai</label>

                        <input type="date"
                               name="tanggal_selesai"
                               class="form-control"
                               value="{{ old('tanggal_selesai') }}"
                               required>

                    </div>

                </div>

            </div>


            <div class="form-group">

                <label>Catatan</label>

                <textarea name="catatan"
                          class="form-control"
                          rows="3"
                          placeholder="Catatan tambahan">{{ old('catatan') }}</textarea>

            </div>

        </div>


        <div class="card-footer">

            <button type="submit"
                    class="btn btn-primary">

                <i class="fas fa-save mr-1"></i>
                Simpan

            </button>

            <a href="{{ route('admin.rental.index') }}"
               class="btn btn-secondary">

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection