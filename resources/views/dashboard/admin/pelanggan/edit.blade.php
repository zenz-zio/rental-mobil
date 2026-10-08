@extends('layouts.main')

@section('title', 'Edit Pelanggan')

@section('content')

<div class="row">
    <div class="col-md-8">

        <div class="card card-warning">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-edit mr-2"></i>
                    Edit Data Pelanggan
                </h3>
            </div>

            <form action="{{ route('admin.pelanggan.update', $pelanggan->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- Nama --}}
                    <div class="form-group">
                        <label for="nama">Nama Pelanggan</label>

                        <input type="text"
                               name="nama"
                               id="nama"
                               class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama', $pelanggan->nama) }}"
                               placeholder="Contoh: Ahmad Fauzan">

                        @error('nama')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- NIK --}}
                    <div class="form-group">
                        <label for="nik">NIK</label>

                        <input type="text"
                               name="nik"
                               id="nik"
                               class="form-control @error('nik') is-invalid @enderror"
                               value="{{ old('nik', $pelanggan->nik) }}"
                               placeholder="Contoh: 1371xxxxxxxxxxxx"
                               maxlength="16"
                               inputmode="numeric"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16)">

                        <small class="text-muted">
                            NIK harus terdiri dari 16 angka.
                        </small>

                        @error('nik')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- No HP --}}
                    <div class="form-group">
                        <label for="no_hp">Nomor HP</label>

                        <input type="text"
                               name="no_hp"
                               id="no_hp"
                               class="form-control @error('no_hp') is-invalid @enderror"
                               value="{{ old('no_hp', $pelanggan->no_hp) }}"
                               placeholder="Contoh: 081234567890"
                               maxlength="13"
                               inputmode="numeric"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13)">

                        <small class="text-muted">
                            Nomor HP maksimal 13 angka.
                        </small>

                        @error('no_hp')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- Email --}}
                    <div class="form-group">
                        <label for="email">Email</label>

                        <input type="email"
                               name="email"
                               id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $pelanggan->email) }}"
                               placeholder="Contoh: pelanggan@gmail.com">

                        @error('email')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- Alamat --}}
                    <div class="form-group">
                        <label for="alamat">Alamat</label>

                        <textarea name="alamat"
                                  id="alamat"
                                  rows="4"
                                  class="form-control @error('alamat') is-invalid @enderror"
                                  placeholder="Masukkan alamat lengkap">{{ old('alamat', $pelanggan->alamat) }}</textarea>

                        @error('alamat')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                </div>


                <div class="card-footer">

                    <button type="submit"
                            class="btn btn-warning">
                        <i class="fas fa-save mr-1"></i>
                        Update
                    </button>

                    <a href="{{ route('admin.pelanggan.index') }}"
                       class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>
</div>

@endsection