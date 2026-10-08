@extends('layouts.main')

@section('title', 'Data Pelanggan')

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users mr-2"></i>
                    Data Pelanggan
                </h3>

                <div class="card-tools">
                    <a href="{{ route('admin.pelanggan.create') }}"
                       class="btn btn-primary">
                        <i class="fas fa-plus mr-1"></i>
                        Tambah Pelanggan
                    </a>
                </div>
            </div>

            <div class="card-body">

                {{-- Pesan sukses --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button"
                                class="close"
                                data-dismiss="alert">
                            &times;
                        </button>

                        <i class="fas fa-check-circle mr-1"></i>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Tabel pelanggan --}}
                <div class="table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>No. HP</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($pelanggans as $pelanggan)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $pelanggan->nama }}
                                    </td>

                                    <td>
                                        {{ $pelanggan->nik }}
                                    </td>

                                    <td>
                                        {{ $pelanggan->no_hp }}
                                    </td>

                                    <td>
                                        {{ $pelanggan->email ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $pelanggan->alamat }}
                                    </td>

                                    <td>

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.pelanggan.edit', $pelanggan->id) }}"
                                           class="btn btn-warning btn-sm"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('admin.pelanggan.destroy', $pelanggan->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        </form>

                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7" class="text-center">
                                        <i class="fas fa-users-slash mr-1"></i>
                                        Belum ada data pelanggan.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection