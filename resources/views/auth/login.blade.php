@extends('layouts.app')

@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-5 col-lg-4">
        <!-- Logo & Header Brand -->
        <div class="text-center mb-4">
            <div class="mb-3">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo Garasi Cuci Motor" width="80" height="80" class="rounded-circle border border-warning border-3 shadow-lg" style="object-fit: cover;">
            </div>
            <h3 class="fw-bold text-white mb-1">GARASI CUCI MOTOR</h3>
            <span class="badge bg-warning text-dark fw-bold px-3 py-1" style="letter-spacing: 1px;">STEAM & CARE PRO</span>
            <p class="text-secondary small mt-2 mb-0">Sistem Kasir &amp; Manajemen Antrean Cuci Motor</p>
        </div>

        <div class="card card-custom p-4 shadow-lg border-secondary">
            <h5 class="fw-bold text-white mb-3 text-center">Masuk ke Dashboard</h5>

            <!-- Demo Info Banner -->
            <div class="alert alert-info border-0 p-2 mb-3 rounded-3 small" style="background-color: rgba(59, 130, 246, 0.15); color: #93c5fd;">
                <i class="bi bi-info-circle me-1"></i> <strong>Akun Demo Terisi Otomatis:</strong><br>
                Email: <code>admin@gmail.com</code> | Password: <code>12345678</code>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Input -->
                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email Kasir</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark text-secondary border-secondary"><i class="bi bi-envelope"></i></span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', 'admin@gmail.com') }}" required autocomplete="email" autofocus>
                    </div>
                    @error('email')
                        <span class="text-danger small mt-1 d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark text-secondary border-secondary"><i class="bi bi-lock"></i></span>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password', '12345678') }}" required autocomplete="current-password">
                    </div>
                    @error('password')
                        <span class="text-danger small mt-1 d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>
                        <label class="form-check-label text-secondary small" for="remember">
                            Ingat Saya di Perangkat Ini
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary fw-bold py-2 shadow">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sekarang
                    </button>
                </div>
            </form>
        </div>

        <div class="text-center mt-4">
            <small class="text-secondary">&copy; {{ date('Y') }} Garasi Cuci Motor - Final Project Pemrograman Web II</small>
        </div>
    </div>
</div>
@endsection
