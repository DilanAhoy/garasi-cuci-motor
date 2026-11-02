<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Pelanggan - GARASI CUCI MOTOR</title>
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
            max-width: 900px;
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
            font-size: 0.9rem;
            border-bottom: 1px solid #e2e8f0;
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
        <!-- Action Bar (Hidden on Print) -->
        <div class="d-flex justify-content-between align-items-center mb-4 no-print mx-auto" style="max-width: 900px;">
            <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Aplikasi
            </a>
            <button onclick="window.print()" class="btn btn-primary fw-bold px-4 shadow">
                🖨️ Cetak Laporan (Print / PDF)
            </button>
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
                <h4 class="fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">LAPORAN DATA PELANGGAN & MOTOR</h4>
                <p class="text-secondary small mb-0">Dicetak pada: {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y - HH:mm') }} WIB</p>
            </div>

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table table-bordered table-report">
                    <thead>
                        <tr class="text-center">
                            <th style="width: 50px;">No</th>
                            <th style="width: 150px;">Nomor Plat</th>
                            <th>Nama Pelanggan</th>
                            <th>Kategori / Jenis Motor</th>
                            <th style="width: 160px;">Nomor Telepon / WA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelanggans as $p)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center font-monospace fw-bold">{{ $p->nomor_plat }}</td>
                                <td class="fw-bold">{{ $p->nama_pelanggan }}</td>
                                <td>{{ $p->jenis_motor }}</td>
                                <td>{{ $p->nomor_hp }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-3 text-muted">Tidak ada data pelanggan terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tanda Tangan -->
            <div class="row mt-5 pt-4">
                <div class="col-7"></div>
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

