<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Nota #{{ $transaksi->kode_transaksi }} - GARASI CUCI MOTOR</title>
    <!-- Bootstrap CSS for action buttons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f1f5f9;
            font-family: 'Courier New', Courier, monospace;
            padding: 20px 0;
            color: #000;
        }

        .receipt-container {
            width: 340px;
            margin: auto;
            background: #ffffff;
            padding: 20px 18px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            font-size: 13px;
            line-height: 1.4;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 12px;
        }

        .receipt-title {
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 0.5px;
            margin: 0;
        }

        .dashed-line {
            border-top: 1px dashed #333333;
            margin: 10px 0;
        }

        .dashed-line-double {
            border-top: 2px dashed #000000;
            margin: 12px 0;
        }

        .receipt-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }

        .receipt-row.bold {
            font-weight: 700;
        }

        .total-box {
            font-size: 15px;
            font-weight: 800;
            padding: 6px 0;
        }

        .receipt-footer {
            text-align: center;
            font-size: 11px;
            margin-top: 15px;
            line-height: 1.5;
        }

        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
            }

            .receipt-container {
                width: 100% !important;
                box-shadow: none !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <!-- Tombol Aksi (Tidak tercetak) -->
    <div class="text-center mb-3 no-print">
        <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-outline-secondary me-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <button onclick="window.print()" class="btn btn-sm btn-primary fw-bold px-3">
            <i class="bi bi-printer me-1"></i> Cetak Struk
        </button>
    </div>

    <!-- Kotak Struk Thermal -->
    <div class="receipt-container">
        <!-- Header -->
        <div class="receipt-header">
            <p class="receipt-title">🏍️ GARASI CUCI MOTOR</p>
            <div style="font-size: 11px; font-weight: 600;">STEAM & CARE PRO</div>
            <div style="font-size: 10px;">Jl. Raya Otomotif No. 88, Jambi</div>
            <div style="font-size: 10px;">WA: 0812-3456-7890</div>
        </div>

        <div class="dashed-line"></div>

        <!-- Info Nota -->
        <div class="receipt-row">
            <span>No. Nota:</span>
            <span class="font-monospace bold">{{ $transaksi->kode_transaksi }}</span>
        </div>
        <div class="receipt-row">
            <span>Tanggal:</span>
            <span>{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d/m/Y') }}</span>
        </div>
        <div class="receipt-row">
            <span>Waktu:</span>
            <span>{{ $transaksi->created_at->format('H:i') }} WIB</span>
        </div>
        <div class="receipt-row">
            <span>Kasir:</span>
            <span>{{ auth()->user()->name ?? 'Admin' }}</span>
        </div>

        <div class="dashed-line"></div>

        <!-- Info Kendaraan & Pelanggan -->
        <div class="receipt-row">
            <span>Pelanggan:</span>
            <span class="bold">{{ $transaksi->pelanggan->nama_pelanggan }}</span>
        </div>
        <div class="receipt-row">
            <span>No. Plat:</span>
            <span class="bold" style="font-size: 14px;">[{{ $transaksi->pelanggan->nomor_plat }}]</span>
        </div>
        <div class="receipt-row">
            <span>Motor:</span>
            <span>{{ $transaksi->pelanggan->jenis_motor }}</span>
        </div>

        <div class="dashed-line"></div>

        <!-- Rincian Layanan -->
        <div class="receipt-row bold">
            <span>LAYANAN / PAKET</span>
            <span>HARGA</span>
        </div>
        <div class="receipt-row" style="margin-top: 4px;">
            <div>
                <div>{{ $transaksi->paket->nama_paket }}</div>
                <div style="font-size: 10px; color: #555;">({{ $transaksi->paket->kode_paket }})</div>
            </div>
            <span>Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</span>
        </div>

        @if ($transaksi->catatan)
            <div style="font-size: 10px; font-style: italic; margin-top: 4px;">
                Ket: {{ $transaksi->catatan }}
            </div>
        @endif

        <div class="dashed-line-double"></div>

        <!-- Total Bayar -->
        <div class="receipt-row total-box">
            <span>TOTAL BAYAR:</span>
            <span>Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</span>
        </div>
        <div class="receipt-row" style="font-size: 11px;">
            <span>STATUS:</span>
            <span class="bold text-uppercase">{{ $transaksi->status == 'Selesai' ? 'LUNAS / SELESAI' : $transaksi->status }}</span>
        </div>

        <div class="dashed-line"></div>

        <!-- Footer Ucapan -->
        <div class="receipt-footer">
            <div>*** TERIMA KASIH ***</div>
            <div>Atas Kunjungan & Kepercayaan Anda</div>
            <div>Motor Bersih, Hati Tenang!</div>
            <div style="font-size: 9px; margin-top: 8px;">Simpan struk ini sebagai bukti pengerjaan</div>
        </div>
    </div>
</body>
</html>

