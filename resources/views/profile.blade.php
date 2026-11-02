@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="mb-4">
            <h3 class="fw-bold text-white mb-1">
                <i class="bi bi-person-gear text-info me-2"></i> Pengaturan Profil Pengguna
            </h3>
            <p class="text-secondary mb-0">Kelola informasi akun kasir, kredensial email, dan kata sandi Anda</p>
        </div>

        <div class="card card-custom p-4 mb-4">
            <!-- Header User Card -->
            <div class="d-flex align-items-center mb-4 pb-3 border-bottom border-secondary">
                <div class="user-avatar fs-4 me-3" style="width: 56px; height: 56px;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h5 class="fw-bold text-white mb-0">{{ $user->name }}</h5>
                    <p class="text-secondary small mb-1">{{ $user->email }}</p>
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                        <i class="bi bi-shield-check me-1"></i> Akun Kasir Aktif
                    </span>
                </div>
            </div>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Alamat Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="p-3 rounded-3 mb-4" style="background-color: #0f172a; border: 1px solid #334155;">
                    <h6 class="fw-bold text-warning mb-2">
                        <i class="bi bi-key me-1"></i> Ganti Kata Sandi (Opsional)
                    </h6>
                    <small class="text-secondary d-block mb-3">Kosongkan kolom sandi jika Anda tidak ingin mengubah kata sandi saat ini.</small>

                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi Baru</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Minimal 8 karakter">
                        @error('password')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-0">
                        <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi baru">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('home') }}" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary fw-bold px-4">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan Profil
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
