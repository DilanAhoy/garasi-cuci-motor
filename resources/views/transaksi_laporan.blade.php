<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendapatan & Transaksi Cuci - GARASI CUCI MOTOR</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
            padding: 24px 0;
        }
        .report-container {
            max-width: 950px;
            background: #ffffff;
            margin: auto;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .kop-title {
            font-weight: 800;
            letter-spacing: -0.5px;
            font-size: 1.5rem;
            margin-bottom: 2px;
        }
        .table-report th {
            background-color: #f1f5f9 !important;
            color: #1e293b !important;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            border-bottom: 2px solid #cbd5e1;
        }
        .table-report td {
            vertical-align: middle;
            font-size: 0.88rem;
            border-bottom: 1px solid #e2e8f0;
        }
        .filter-card {
            max-width: 950px;
            background: #ffffff;
            margin: 0 auto 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.06);
            border: 1px solid #e2e8f0;
        }
        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
            }
            .report-container {
                box-shadow: none !important;
                padding: 20px 0 !important;
                max-width: 100% !important;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Action Bar & Filter Tanggal (Hidden on Print) -->
        <div class="d-flex justify-content-between align-items-center mb-3 no-print mx-auto" style="max-width: 950px;">
            <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Antrean
            </a>
            <button onclick="window.print()" class="btn btn-primary fw-bold px-4 shadow">
                🖨️ Cetak Laporan (Print / PDF)
            </button>
        </div>

        <div class="filter-card no-print">
            <form action="{{ route('transaksi.laporan') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted mb-1">Tanggal Mulai:</label>
                    <input type="date" name="tgl_awal" class="form-control" value="{{ request('tgl_awal', $tgl_awal) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted mb-1">Tanggal Akhir:</label>
                    <input type="date" name="tgl_akhir" class="form-control" value="{{ request('tgl_akhir', $tgl_akhir) }}">
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-dark fw-bold w-100">
                        <i class="bi bi-filter me-1"></i> Tampilkan
                    </button>
                    <a href="{{ route('transaksi.laporan') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="report-container">
            <!-- Kop Laporan -->
            <div class="text-center pb-3 mb-4 border-bottom border-dark border-2">
                <h2 class="kop-title">🏍️ GARASI CUCI MOTOR STEAM PRO</h2>
                <p class="mb-1 text-muted small">Layanan Cuci Motor Salju, Semir Ban, dan Pembersihan Mesin Berkualitas</p>
                <p class="mb-0 text-muted small">Jl. Raya Otomotif No. 88 &bull; Telp / WA: 0812-3456-7890</p>
            </div>

            <!-- Judul Dokumen -->
            <div class="text-center my-4">
                <h4 class="fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">LAPORAN PENDAPATAN & TRANSAKSI CUCI MOTOR</h4>
                <div class="mt-2">
                    @if ($tgl_awal && $tgl_akhir)
                        <span class="badge bg-secondary px-3 py-2 fs-6">
                            Periode: {{ \Carbon\Carbon::parse($tgl_awal)->isoFormat('D MMMM Y') }} s/d {{ \Carbon\Carbon::parse($tgl_akhir)->isoFormat('D MMMM Y') }}
                        </span>
                    @else
                        <span class="badge bg-secondary px-3 py-2 fs-6">
                            Periode: Seluruh Riwayat Transaksi
                        </span>
                    @endif
                </div>
                <p class="text-secondary small mt-2 mb-0">Dicetak pada: {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y - HH:mm') }} WIB</p>
            </div>

            <!-- Tabel Data Rekapitulasi -->
            <div class="table-responsive">
                <table class="table table-bordered table-report">
                    <thead>
                        <tr class="text-center">
                            <th style="width: 45px;">No</th>
                            <th style="width: 130px;">No. Nota</th>
                            <th style="width: 100px;">Tanggal</th>
                            <th>Plat & Pelanggan</th>
                            <th>Paket Cuci</th>
                            <th style="width: 100px;">Status</th>
                            <th style="width: 140px;">Total Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksis as $t)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="font-monospace fw-bold text-center">{{ $t->kode_transaksi }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}</td>
                                <td>
                                    <strong>[{{ $t->pelanggan->nomor_plat }}]</strong> - {{ $t->pelanggan->nama_pelanggan }}
                                </td>
                                <td>{{ $t->paket->nama_paket }}</td>
                                <td class="text-center">
                                    @if ($t->status == 'Selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif ($t->status == 'Sedang Dicuci')
                                        <span class="badge bg-warning text-dark">Sedang Dicuci</span>
                                    @else
                                        <span class="badge bg-danger">Batal</span>
                                    @endif
                                </td>
                                <td class="text-end fw-bold">
                                    Rp {{ number_format($t->total_bayar, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    Tidak ada data transaksi pada rentang periode yang dipilih.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="table-success border-top border-dark border-2">
                            <td colspan="6" class="text-end fw-bold text-uppercase fs-6">
                                Total Pendapatan Bersih (Status Selesai):
                            </td>
                            <td class="text-end fw-bold fs-5 text-success">
                                Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Tanda Tangan -->
            <div class="row mt-5 pt-4">
                <div class="col-7">
                    <p class="small text-muted mb-1">* Catatan:</p>
                    <p class="small text-muted mb-0">Total pendapatan hanya mengakumulasi transaksi dengan status pembayaran <strong>Selesai</strong>.</p>
                </div>
                <div class="col-5 text-center">
                    <p class="mb-1 text-muted small">Jambi, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
                    <p class="fw-bold mb-5">Pemilik Garasi Cuci Motor,</p>
                    <div style="height: 50px;"></div>
                    <p class="fw-bold text-decoration-underline mb-0">Admin Garasi</p>
                    <small class="text-muted">Owner / Management</small>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
