@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h3 class="fw-bold text-white mb-1">
                    <i class="bi bi-pencil-square text-warning me-2"></i> Edit Transaksi Cuci
                </h3>
                <p class="text-secondary mb-0">Perbarui rincian transaksi: {{ $transaksi->kode_transaksi }}</p>
            </div>
            <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card card-custom p-4">
            <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="kode_transaksi" class="form-label">No. Nota / Kode Transaksi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control font-monospace @error('kode_transaksi') is-invalid @enderror" id="kode_transaksi" name="kode_transaksi" value="{{ old('kode_transaksi', $transaksi->kode_transaksi) }}" required>
                        @error('kode_transaksi')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="tanggal" class="form-label">Tanggal Transaksi <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $transaksi->tanggal) }}" required>
                        @error('tanggal')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="pelanggan_id" class="form-label">Pilih Pelanggan & Motor <span class="text-danger">*</span></label>
                    <select class="form-select @error('pelanggan_id') is-invalid @enderror" id="pelanggan_id" name="pelanggan_id" required>
                        @foreach ($list_pelanggan as $pelanggan)
                            <option value="{{ $pelanggan->id }}" {{ old('pelanggan_id', $transaksi->pelanggan_id) == $pelanggan->id ? 'selected' : '' }}>
                                [{{ $pelanggan->nomor_plat }}] - {{ $pelanggan->nama_pelanggan }} ({{ $pelanggan->jenis_motor }})
                            </option>
                        @endforeach
                    </select>
                    @error('pelanggan_id')
                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-7 mb-3 mb-md-0">
                        <label for="paket_id" class="form-label">Pilih Paket Cuci <span class="text-danger">*</span></label>
                        <select class="form-select @error('paket_id') is-invalid @enderror" id="paket_id" name="paket_id" required onchange="updateTarifPreview()">
                            @foreach ($list_paket as $paket)
                                <option value="{{ $paket->id }}" data-harga="{{ $paket->harga }}" {{ old('paket_id', $transaksi->paket_id) == $paket->id ? 'selected' : '' }}>
                                    {{ $paket->kode_paket }} - {{ $paket->nama_paket }} (Rp {{ number_format($paket->harga, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                        @error('paket_id')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-5">
                        <label for="status" class="form-label">Status Pengerjaan <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            @foreach ($list_status as $st)
                                <option value="{{ $st }}" {{ old('status', $transaksi->status) == $st ? 'selected' : '' }}>
                                    {{ $st }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Info Tarif Box -->
                <div class="p-3 rounded-3 mb-3" style="background-color: #0f172a; border: 1px dashed #334155;">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-secondary small">Tarif Paket Terpilih:</span>
                        <span class="fw-bold text-success fs-5" id="tarifPreview">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</span>
                    </div>
                    <small class="text-secondary d-block mt-1">Total bayar diperbarui otomatis sesuai harga paket di database.</small>
                </div>

                <div class="mb-4">
                    <label for="catatan" class="form-label">Catatan Tambahan (Opsional)</label>
                    <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" rows="2" maxlength="100">{{ old('catatan', $transaksi->catatan) }}</textarea>
                    @error('catatan')
                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-warning fw-bold px-4 text-dark">
                        <i class="bi bi-check-lg me-1"></i> Perbarui Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function updateTarifPreview() {
        const select = document.getElementById('paket_id');
        const selectedOption = select.options[select.selectedIndex];
        const harga = selectedOption.getAttribute('data-harga') || 0;
        document.getElementById('tarifPreview').innerText = 'Rp ' + Number(harga).toLocaleString('id-ID');
    }
</script>
@endsection
