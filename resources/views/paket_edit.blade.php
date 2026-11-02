@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h3 class="fw-bold text-white mb-1">
                    <i class="bi bi-pencil-square text-warning me-2"></i> Edit Paket Cuci
                </h3>
                <p class="text-secondary mb-0">Perbarui data paket layanan: {{ $paket->nama_paket }}</p>
            </div>
            <a href="{{ route('paket.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card card-custom p-4">
            <form action="{{ route('paket.update', $paket->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="kode_paket" class="form-label">Kode Paket <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('kode_paket') is-invalid @enderror" id="kode_paket" name="kode_paket" value="{{ old('kode_paket', $paket->kode_paket) }}" maxlength="10" required>
                        @error('kode_paket')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="harga" class="form-label">Harga / Tarif (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $paket->harga) }}" min="0" required>
                        @error('harga')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="nama_paket" class="form-label">Nama Paket Layanan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_paket') is-invalid @enderror" id="nama_paket" name="nama_paket" value="{{ old('nama_paket', $paket->nama_paket) }}" maxlength="50" required>
                    @error('nama_paket')
                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="form-label">Deskripsi Layanan <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3" maxlength="100" required>{{ old('deskripsi', $paket->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                    @enderror
                    <small class="text-secondary">Maksimal 100 karakter.</small>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('paket.index') }}" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-warning fw-bold px-4 text-dark">
                        <i class="bi bi-check-lg me-1"></i> Perbarui Paket
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
