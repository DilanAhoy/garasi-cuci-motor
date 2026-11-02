@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h3 class="fw-bold text-white mb-1">
                    <i class="bi bi-person-plus text-primary me-2"></i> Tambah Pelanggan & Motor
                </h3>
                <p class="text-secondary mb-0">Daftarkan pelanggan baru dan kendaraannya ke dalam sistem</p>
            </div>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card card-custom p-4">
            <form action="{{ route('pelanggan.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="nomor_plat" class="form-label">Nomor Plat Motor <span class="text-danger">*</span></label>
                        <input type="text" class="form-control text-uppercase font-monospace @error('nomor_plat') is-invalid @enderror" id="nomor_plat" name="nomor_plat" value="{{ old('nomor_plat') }}" placeholder="Contoh: BH 1234 AB" maxlength="15" required autofocus>
                        @error('nomor_plat')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                        <small class="text-secondary">Otomatis diubah menjadi HURUF BESAR.</small>
                    </div>

                    <div class="col-md-6">
                        <label for="jenis_motor" class="form-label">Kategori / Jenis Motor <span class="text-danger">*</span></label>
                        <select class="form-select @error('jenis_motor') is-invalid @enderror" id="jenis_motor" name="jenis_motor" required>
                            <option value="">-- Pilih Jenis Motor --</option>
                            @php
                                $opsiMotor = ['Matic', 'Bebek', 'Sport', 'Matic Besar (NMAX/PCX)'];
                            @endphp
                            @foreach ($opsiMotor as $opsi)
                                <option value="{{ $opsi }}" {{ old('jenis_motor') == $opsi ? 'selected' : '' }}>{{ $opsi }}</option>
                            @endforeach
                        </select>
                        @error('jenis_motor')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="nama_pelanggan" class="form-label">Nama Pemilik / Pelanggan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" placeholder="Contoh: Budi Santoso" maxlength="50" required>
                    @error('nama_pelanggan')
                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="nomor_hp" class="form-label">Nomor WhatsApp / HP Aktif <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark text-secondary border-secondary"><i class="bi bi-telephone"></i></span>
                        <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror" id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp') }}" placeholder="Contoh: 081234567890" maxlength="20" required>
                    </div>
                    @error('nomor_hp')
                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                    @enderror
                    <small class="text-secondary">Digunakan untuk kirim notifikasi saat cuci motor selesai.</small>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary fw-bold px-4">
                        <i class="bi bi-save me-1"></i> Simpan Pelanggan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
