@extends('layouts.app')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h3 class="fw-bold text-white mb-1">
            <i class="bi bi-droplet-half text-info me-2"></i> Daftar Paket Cuci
        </h3>
        <p class="text-secondary mb-0">Manajemen harga dan jenis layanan cuci motor</p>
    </div>
    <div class="col-md-6 text-md-end mt-3 mt-md-0">
        <a href="{{ route('paket.laporan') }}" target="_blank" class="btn btn-outline-light me-2">
            <i class="bi bi-printer me-1"></i> Cetak Laporan
        </a>
        <a href="{{ route('paket.create') }}" class="btn btn-primary fw-bold">
            <i class="bi bi-plus-circle me-1"></i> + Tambah Paket Baru
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
                        <th style="width: 130px;">Kode Paket</th>
                        <th>Nama Paket</th>
                        <th>Harga / Tarif</th>
                        <th>Deskripsi Layanan</th>
                        <th style="width: 160px;" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pakets as $paket)
                        <tr>
                            <td class="text-center text-secondary">
                                {{ ($pakets->currentPage() - 1) * $pakets->perPage() + $loop->iteration }}
                            </td>
                            <td>
                                <span class="badge bg-primary text-white font-monospace px-2 py-1 fw-bold">
                                    {{ $paket->kode_paket }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold text-white">{{ $paket->nama_paket }}</div>
                            </td>
                            <td>
                                <span class="fw-bold text-success fs-6">
                                    Rp {{ number_format($paket->harga, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="text-secondary">
                                {{ $paket->deskripsi }}
                            </td>
                            <td class="text-end">
                                <a href="{{ route('paket.edit', $paket->id) }}" class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('paket.destroy', $paket->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket cuci ini?')">
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
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Belum ada data paket cuci yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if ($pakets->hasPages())
        <div class="card-footer bg-transparent border-top border-secondary py-3">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-secondary">
                    Menampilkan {{ $pakets->firstItem() }} - {{ $pakets->lastItem() }} dari total {{ $pakets->total() }} paket
                </small>
                <div>
                    {{ $pakets->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
