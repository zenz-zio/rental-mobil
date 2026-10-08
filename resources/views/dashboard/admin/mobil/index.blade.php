@extends('layouts.main')

@section('title', 'Data Mobil')

@section('content')

<div class="row">
    <div class="col-12">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-car mr-2"></i>
                    Daftar Mobil
                </h3>

                <div class="card-tools">
                    <a href="{{ route('admin.mobil.create') }}"
                       class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i>
                        Tambah Mobil
                    </a>
                </div>
            </div>

            <div class="card-body">

                <table id="example1"
                       class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Foto</th>
                            <th>Merk</th>
                            <th>Model</th>
                            <th>No. Plat</th>
                            <th>Tahun</th>
                            <th>Harga / Hari</th>
                            <th>Status</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($mobils as $mobil)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    @if($mobil->foto)
                                        <img src="{{ asset('uploads/mobil/' . $mobil->foto) }}"
                                             width="80"
                                             height="50"
                                             style="object-fit: cover;"
                                             class="img-thumbnail">
                                    @else
                                        <span class="text-muted">
                                            Tidak ada foto
                                        </span>
                                    @endif
                                </td>

                                <td>{{ $mobil->merk }}</td>

                                <td>{{ $mobil->model }}</td>

                                <td>
                                    <span class="badge badge-dark">
                                        {{ $mobil->no_plat }}
                                    </span>
                                </td>

                                <td>{{ $mobil->tahun }}</td>

                                <td>
                                    Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}
                                </td>

                                <td>
                                    @if($mobil->status == 'tersedia')
                                        <span class="badge badge-success">
                                            Tersedia
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            Disewa
                                        </span>
                                    @endif
                                </td>

                                <td>

                                    <a href="{{ route('admin.mobil.edit', $mobil->id) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.mobil.destroy', $mobil->id) }}"
                                          method="POST"
                                          style="display:inline;"
                                          onsubmit="return confirm('Yakin ingin menghapus mobil ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9" class="text-center">
                                    <div class="py-4">
                                        <i class="fas fa-car fa-3x text-muted mb-3"></i>

                                        <p class="text-muted">
                                            Belum ada data mobil.
                                        </p>

                                        <a href="{{ route('admin.mobil.create') }}"
                                           class="btn btn-primary">
                                            <i class="fas fa-plus"></i>
                                            Tambah Mobil
                                        </a>
                                    </div>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</div>

@endsection