@extends('layouts.app')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h3 class="fw-bold text-white mb-1">
            <i class="bi bi-people text-info me-2"></i> Data Pelanggan & Motor
        </h3>
        <p class="text-secondary mb-0">Kelola informasi pelanggan dan kendaraan yang terdaftar</p>
    </div>
    <div class="col-md-6 text-md-end mt-3 mt-md-0">
        <a href="{{ route('pelanggan.laporan') }}" class="btn btn-outline-light me-2">
            <i class="bi bi-printer me-1"></i> Cetak Laporan
        </a>
        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary fw-bold">
            <i class="bi bi-person-plus me-1"></i> + Tambah Pelanggan Baru
        </a>
    </div>
</div>

<div class="card card-custom">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;" class="text-center">#</th>
                        <th style="width: 170px;">Nomor Plat</th>
                        <th>Nama Pelanggan</th>
                        <th>Jenis Motor</th>
                        <th>Nomor WhatsApp / HP</th>
                        <th style="width: 160px;" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pelanggans as $pelanggan)
                        <tr>
                            <td class="text-center text-secondary">
                                {{ ($pelanggans->currentPage() - 1) * $pelanggans->perPage() + $loop->iteration }}
                            </td>
                            <td>
                                <div class="plat-badge">
                                    {{ $pelanggan->nomor_plat }}
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-white">{{ $pelanggan->nama_pelanggan }}</div>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-info border border-secondary px-2 py-1">
                                    <i class="bi bi-motorcycle me-1"></i> {{ $pelanggan->jenis_motor }}
                                </span>
                            </td>
                            <td>
                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $pelanggan->nomor_hp)) }}" target="_blank" class="text-success text-decoration-none fw-semibold">
                                    <i class="bi bi-whatsapp me-1"></i> {{ $pelanggan->nomor_hp }}
                                </a>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data pelanggan {{ $pelanggan->nama_pelanggan }} ({{ $pelanggan->nomor_plat }})?')">
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
                            <td colspan="6" class="text-center py-5 text-secondary">
                                <i class="bi bi-people fs-1 d-block mb-2"></i>
                                Belum ada data pelanggan yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if ($pelanggans->hasPages())
        <div class="card-footer bg-transparent border-top border-secondary py-3">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-secondary">
                    Menampilkan {{ $pelanggans->firstItem() }} - {{ $pelanggans->lastItem() }} dari total {{ $pelanggans->total() }} pelanggan
                </small>
                <div>
                    {{ $pelanggans->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

