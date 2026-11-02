@extends('layouts.app')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h3 class="fw-bold text-white mb-1">
            <i class="bi bi-receipt text-warning me-2"></i> Data Antrean & Transaksi Cuci
        </h3>
        <p class="text-secondary mb-0">Kelola riwayat pencucian motor, status pengerjaan, dan pembayaran</p>
    </div>
    <div class="col-md-6 text-md-end mt-3 mt-md-0">
        <a href="{{ route('transaksi.laporan') }}" class="btn btn-outline-light me-2">
            <i class="bi bi-file-earmark-bar-graph me-1"></i> Rekap Laporan
        </a>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary fw-bold">
            <i class="bi bi-plus-square me-1"></i> + Input Transaksi Baru
        </a>
    </div>
</div>

<div class="card card-custom">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px;" class="text-center">#</th>
                        <th>No. Nota</th>
                        <th>Plat Motor & Pelanggan</th>
                        <th>Paket Cuci</th>
                        <th>Tanggal</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                        <th>Catatan</th>
                        <th class="text-end" style="min-width: 220px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $trx)
                        <tr>
                            <td class="text-center text-secondary">
                                {{ ($transaksis->currentPage() - 1) * $transaksis->perPage() + $loop->iteration }}
                            </td>
                            <td>
                                <span class="font-monospace fw-bold text-white">{{ $trx->kode_transaksi }}</span>
                            </td>
                            <td>
                                <div class="plat-badge mb-1">{{ $trx->pelanggan->nomor_plat }}</div>
                                <div class="fw-bold text-white">{{ $trx->pelanggan->nama_pelanggan }}</div>
                                <small class="text-secondary">{{ $trx->pelanggan->jenis_motor }} &bull; {{ $trx->pelanggan->nomor_hp }}</small>
                            </td>
                            <td>
                                <div class="fw-semibold text-info">{{ $trx->paket->nama_paket }}</div>
                                <small class="text-secondary">{{ $trx->paket->kode_paket }}</small>
                            </td>
                            <td>
                                <div class="text-white">{{ \Carbon\Carbon::parse($trx->tanggal)->isoFormat('D MMM Y') }}</div>
                            </td>
                            <td>
                                <span class="fw-bold text-success fs-6">
                                    Rp {{ number_format($trx->total_bayar, 0, ',', '.') }}
                                </span>
                            </td>
                            <td>
                                @if ($trx->status == 'Sedang Dicuci')
                                    <span class="badge bg-warning text-dark px-2 py-1 fw-bold">
                                        <i class="bi bi-hourglass-split me-1"></i> Sedang Dicuci
                                    </span>
                                @elseif ($trx->status == 'Selesai')
                                    <span class="badge bg-success text-white px-2 py-1 fw-bold">
                                        <i class="bi bi-check-circle-fill me-1"></i> Selesai
                                    </span>
                                @else
                                    <span class="badge bg-danger text-white px-2 py-1 fw-bold">
                                        <i class="bi bi-x-circle-fill me-1"></i> Batal
                                    </span>
                                @endif
                            </td>
                            <td class="text-secondary small">
                                {{ $trx->catatan ?: '-' }}
                            </td>
                            <td class="text-end">
                                <!-- Tombol Nota -->
                                <a href="{{ route('transaksi.nota', $trx->id) }}" target="_blank" class="btn btn-sm btn-outline-info me-1" title="Cetak Nota">
                                    🧾 Nota
                                </a>

                                <!-- Tombol WA (Hanya jika Selesai) -->
                                @if ($trx->status == 'Selesai')
                                    @php
                                        $cleanPhone = preg_replace('/[^0-9]/', '', $trx->pelanggan->nomor_hp);
                                        if (str_starts_with($cleanPhone, '0')) {
                                            $cleanPhone = '62' . substr($cleanPhone, 1);
                                        }
                                        $pesanText = "Halo Kak {$trx->pelanggan->nama_pelanggan},\nMotor Anda dengan Plat [{$trx->pelanggan->nomor_plat}] telah SELESAI dicuci di GARASI CUCI MOTOR.\n\nDetail:\n- Paket: {$trx->paket->nama_paket}\n- Total Bayar: Rp " . number_format($trx->total_bayar, 0, ',', '.') . "\n\nTerima kasih telah mempercayakan kendaraan Anda kepada kami!";
                                    @endphp
                                    <a href="https://wa.me/{{ $cleanPhone }}?text={{ rawurlencode($pesanText) }}" target="_blank" class="btn btn-sm btn-outline-success me-1" title="Kirim Notifikasi WhatsApp">
                                        💬 WA
                                    </a>
                                @endif

                                <!-- Tombol Edit -->
                                <a href="{{ route('transaksi.edit', $trx->id) }}" class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('transaksi.destroy', $trx->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi {{ $trx->kode_transaksi }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-secondary">
                                <i class="bi bi-receipt-cutoff fs-1 d-block mb-2"></i>
                                Belum ada data transaksi yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if ($transaksis->hasPages())
        <div class="card-footer bg-transparent border-top border-secondary py-3">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-secondary">
                    Menampilkan {{ $transaksis->firstItem() }} - {{ $transaksis->lastItem() }} dari total {{ $transaksis->total() }} transaksi
                </small>
                <div>
                    {{ $transaksis->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
