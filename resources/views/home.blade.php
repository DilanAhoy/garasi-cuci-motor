@extends('layouts.app')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-7">
        <h2 class="fw-bold text-white mb-1">
            <i class="bi bi-speedometer2 text-warning me-2"></i> Dashboard Operasional Garasi
        </h2>
        <p class="text-secondary mb-0">
            <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }} &bull; Pantauan Antrean & Keuangan Real-Time
        </p>
    </div>
    <div class="col-md-5 text-md-end mt-3 mt-md-0">
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary fw-bold px-3 py-2 shadow">
            <i class="bi bi-plus-circle me-1"></i> + Input Motor Masuk
        </a>
    </div>
</div>

<!-- 4 Kartu Statistik -->
<div class="row g-3 mb-4">
    <!-- Total Pendapatan (Emerald) -->
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 text-white rounded-4 shadow h-100 p-3" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Total Pendapatan</span>
                    <h3 class="fw-bold my-1 text-white">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
                    <small class="text-white-50"><i class="bi bi-check-circle me-1"></i> Status Selesai</small>
                </div>
                <div class="bg-white bg-opacity-25 rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 58px; height: 58px;">
                    <i class="bi bi-wallet2 fs-3 text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Sedang Dicuci (Amber) -->
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 text-white rounded-4 shadow h-100 p-3" style="background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Sedang Dicuci</span>
                    <h3 class="fw-bold my-1 text-white">{{ $antrean_aktif }} <span class="fs-6 fw-normal">Motor</span></h3>
                    <small class="text-white-50"><i class="bi bi-clock-history me-1"></i> Antrean Aktif</small>
                </div>
                <div class="bg-white bg-opacity-25 rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 58px; height: 58px;">
                    <i class="bi bi-hourglass-split fs-3 text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Motor Hari Ini (Blue) -->
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 text-white rounded-4 shadow h-100 p-3" style="background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Motor Hari Ini</span>
                    <h3 class="fw-bold my-1 text-white">{{ $motor_hari_ini }} <span class="fs-6 fw-normal">Unit</span></h3>
                    <small class="text-white-50"><i class="bi bi-calendar-check me-1"></i> Masuk Hari Ini</small>
                </div>
                <div class="bg-white bg-opacity-25 rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 58px; height: 58px;">
                    <i class="bi bi-motorcycle fs-3 text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pelanggan (Slate) -->
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 text-white rounded-4 shadow h-100 p-3" style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%); border: 1px solid #475569 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Total Pelanggan</span>
                    <h3 class="fw-bold my-1 text-white">{{ $total_pelanggan }} <span class="fs-6 fw-normal">Data</span></h3>
                    <small class="text-secondary"><i class="bi bi-people me-1"></i> Terdaftar</small>
                </div>
                <div class="bg-white bg-opacity-10 rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 58px; height: 58px;">
                    <i class="bi bi-people-fill fs-3 text-info"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Antrean Aktif -->
<div class="card card-custom">
    <div class="card-header bg-transparent border-bottom border-secondary d-flex justify-content-between align-items-center py-3">
        <div>
            <h5 class="fw-bold text-white mb-0">
                <i class="bi bi-droplet-half text-warning me-2"></i> Antrean Motor Sedang Dicuci Saat Ini
            </h5>
            <small class="text-secondary">Daftar motor yang sedang berada di pit pencucian</small>
        </div>
        <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-outline-light">
            Lihat Semua Transaksi <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px;" class="text-center">#</th>
                        <th>No. Plat & Pelanggan</th>
                        <th>Jenis Motor</th>
                        <th>Paket Cuci</th>
                        <th>Tarif</th>
                        <th>Status</th>
                        <th>Catatan</th>
                        <th class="text-end">Aksi Cepat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($antrean_terbaru as $antrean)
                        <tr>
                            <td class="text-center text-secondary">{{ $loop->iteration }}</td>
                            <td>
                                <div class="plat-badge mb-1">{{ $antrean->pelanggan->nomor_plat }}</div>
                                <div class="fw-bold text-white">{{ $antrean->pelanggan->nama_pelanggan }}</div>
                                <small class="text-secondary">{{ $antrean->pelanggan->nomor_hp }}</small>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary">
                                    {{ $antrean->pelanggan->jenis_motor }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-semibold text-info">{{ $antrean->paket->nama_paket }}</div>
                                <small class="text-secondary">{{ $antrean->paket->kode_paket }}</small>
                            </td>
                            <td class="fw-bold text-white">
                                Rp {{ number_format($antrean->total_bayar, 0, ',', '.') }}
                            </td>
                            <td>
                                <span class="badge bg-warning text-dark px-2 py-1 fw-bold">
                                    <i class="bi bi-hourglass-split me-1"></i> {{ $antrean->status }}
                                </span>
                            </td>
                            <td class="text-secondary small">
                                {{ $antrean->catatan ?: '-' }}
                            </td>
                            <td class="text-end">
                                <form action="{{ route('transaksi.update', $antrean->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="kode_transaksi" value="{{ $antrean->kode_transaksi }}">
                                    <input type="hidden" name="pelanggan_id" value="{{ $antrean->pelanggan_id }}">
                                    <input type="hidden" name="paket_id" value="{{ $antrean->paket_id }}">
                                    <input type="hidden" name="tanggal" value="{{ $antrean->tanggal }}">
                                    <input type="hidden" name="status" value="Selesai">
                                    <input type="hidden" name="catatan" value="{{ $antrean->catatan }}">
                                    <button type="submit" class="btn btn-sm btn-success fw-bold px-3 py-1 shadow-sm" onclick="return confirm('Tandai motor {{ $antrean->pelanggan->nomor_plat }} sudah selesai dicuci?')">
                                        <i class="bi bi-check2-circle me-1"></i> Selesai Cuci &rarr;
                                    </button>
                                </form>
                                <a href="{{ route('transaksi.edit', $antrean->id) }}" class="btn btn-sm btn-outline-secondary ms-1" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="py-3">
                                    <i class="bi bi-check2-all text-success" style="font-size: 3rem;"></i>
                                    <h6 class="fw-bold text-white mt-3">Tidak Ada Antrean Motor yang Sedang Dicuci</h6>
                                    <p class="text-secondary small mb-3">Semua motor antrean telah selesai atau belum ada motor baru masuk.</p>
                                    <a href="{{ route('transaksi.create') }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-plus-circle me-1"></i> Input Antrean Baru
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
@endsection
