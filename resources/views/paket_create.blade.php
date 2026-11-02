@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h3 class="fw-bold text-white mb-1">
                    <i class="bi bi-plus-circle text-primary me-2"></i> Tambah Paket Cuci Baru
                </h3>
                <p class="text-secondary mb-0">Lengkapi formulir untuk menambahkan paket layanan baru</p>
            </div>
            <a href="{{ route('paket.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card card-custom p-4">
            <form action="{{ route('paket.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="kode_paket" class="form-label">Kode Paket <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('kode_paket') is-invalid @enderror" id="kode_paket" name="kode_paket" value="{{ old('kode_paket') }}" placeholder="Contoh: PK05" maxlength="10" required autofocus>
                        @error('kode_paket')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="harga" class="form-label">Harga / Tarif (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}" placeholder="Contoh: 20000" min="0" required>
                        @error('harga')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="nama_paket" class="form-label">Nama Paket Layanan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_paket') is-invalid @enderror" id="nama_paket" name="nama_paket" value="{{ old('nama_paket') }}" placeholder="Contoh: Cuci Detail + Wax Polish" maxlength="50" required>
                    @error('nama_paket')
                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="form-label">Deskripsi Layanan <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3" placeholder="Rincian bagian yang dicuci..." maxlength="100" required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                    @enderror
                    <small class="text-secondary">Maksimal 100 karakter.</small>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('paket.index') }}" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary fw-bold px-4">
                        <i class="bi bi-save me-1"></i> Simpan Paket
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

