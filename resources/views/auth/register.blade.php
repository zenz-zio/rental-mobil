<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Tempuh ID</title>
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-light">

<div class="container min-vh-100 d-flex align-items-center justify-content-center py-4">
    <div class="w-100" style="max-width: 900px;">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-1"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-1"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm overflow-hidden">
            <div class="row g-0">

                {{-- PANEL BRAND --}}
                <div class="col-md-5 bg-dark text-white p-4 p-lg-5 d-flex flex-column justify-content-between">
                    <div>
                        <div class="fs-4 fw-bold mb-1">
                            <i class="fas fa-car text-warning me-2"></i>Tempuh ID
                        </div>
                        <small class="text-warning">Rental mobil mudah & cepat</small>
                    </div>

                    <ul class="list-unstyled my-4 mb-md-0">
                        <li class="d-flex mb-3">
                            <i class="fas fa-user-plus text-warning fa-fw mt-1 me-2"></i>
                            <div>
                                <div class="fw-semibold">Daftar gratis</div>
                                <small class="text-white-50">Cukup nama, email, dan password.</small>
                            </div>
                        </li>
                        <li class="d-flex mb-3">
                            <i class="fas fa-calendar-check text-warning fa-fw mt-1 me-2"></i>
                            <div>
                                <div class="fw-semibold">Langsung booking</div>
                                <small class="text-white-50">Pilih mobil dan tanggal sewa dalam hitungan menit.</small>
                            </div>
                        </li>
                        <li class="d-flex">
                            <i class="fas fa-bell text-warning fa-fw mt-1 me-2"></i>
                            <div>
                                <div class="fw-semibold">Pantau pengajuan</div>
                                <small class="text-white-50">Dapat notifikasi setelah admin menyetujui.</small>
                            </div>
                        </li>
                    </ul>

                    <small class="text-white-50 d-none d-md-block">&copy; {{ date('Y') }} Tempuh ID</small>
                </div>

                {{-- FORM --}}
                <div class="col-md-7 bg-white">
                    <form method="POST" action="{{ route('store.register') }}" class="h-100 d-flex flex-column">
                        @csrf

                        <div class="card-header bg-white border-bottom p-4 pb-3">
                            <h5 class="card-title mb-1">
                                <i class="fas fa-user-check me-2"></i>Daftar
                            </h5>
                            <small class="text-muted">Buat akun untuk mulai booking mobil.</small>
                        </div>

                        <div class="card-body p-4 flex-grow-1">

                            {{-- Nama Lengkap --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama lengkap</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="Masukkan nama lengkap"
                                           value="{{ old('name') }}"
                                           autofocus>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text bg-light"><i class="far fa-envelope"></i></span>
                                    <input type="email"
                                           name="email"
                                           id="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="nama@email.com"
                                           value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text">Kami tidak akan membagikan email anda.</div>
                            </div>

                            {{-- Password --}}
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text bg-light"><i class="fas fa-key"></i></span>
                                        <input type="password"
                                               name="password"
                                               id="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               placeholder="Minimal 6 karakter">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Konfirmasi password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-check-circle"></i></span>
                                        <input type="password"
                                               name="password_confirmation"
                                               id="password_confirmation"
                                               class="form-control"
                                               placeholder="Ulangi password">
                                    </div>
                                </div>
                            </div>

                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" id="showPassword">
                                <label class="form-check-label small text-muted" for="showPassword">Tampilkan password</label>
                            </div>

                        </div>

                        <div class="card-footer bg-white p-4 pt-3">
                            <button type="submit" class="btn btn-warning fw-semibold w-100 mb-3">
                                <i class="fas fa-user-check me-1"></i> Daftar
                            </button>

                            <div class="text-center small text-muted">
                                Sudah punya akun?
                                <a href="{{ route('login') }}" class="fw-semibold">
                                    <i class="fas fa-sign-in-alt me-1"></i>Masuk
                                </a>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

<script src="//cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fields = [
        document.getElementById('password'),
        document.getElementById('password_confirmation')
    ];

    document.getElementById('showPassword').addEventListener('change', function (e) {
        fields.forEach(function (f) {
            f.type = e.target.checked ? 'text' : 'password';
        });
    });
});
</script>
</body>

</html>