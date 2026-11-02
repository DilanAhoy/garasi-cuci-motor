<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TransaksiController extends Controller
{
    /**
     * List of status options.
     */
    protected array $statusOptions = [
        'Sedang Dicuci',
        'Selesai',
        'Batal',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksi::with(['pelanggan', 'paket'])
            ->orderBy('id', 'desc')
            ->paginate(3);

        return view('transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_pelanggan = Pelanggan::orderBy('nama_pelanggan', 'asc')->get();
        $list_paket = Paket::orderBy('nama_paket', 'asc')->get();
        $list_status = $this->statusOptions;
        $kode_otomatis = 'TRX-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        return view('transaksi.create', compact('list_pelanggan', 'list_paket', 'list_status', 'kode_otomatis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_transaksi' => 'nullable|string|max:20|unique:transaksis,kode_transaksi',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'paket_id' => 'required|exists:pakets,id',
            'tanggal' => 'required|date',
            'status' => ['required', Rule::in($this->statusOptions)],
            'catatan' => 'nullable|string|max:100',
        ]);

        if (empty($validated['kode_transaksi'])) {
            $validated['kode_transaksi'] = 'TRX-' . date('Ymd') . '-' . strtoupper(Str::random(4));
        }

        // Ambil harga paket otomatis dari database
        $paket = Paket::findOrFail($validated['paket_id']);
        $validated['total_bayar'] = $paket->harga;

        Transaksi::create($validated);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        $list_pelanggan = Pelanggan::orderBy('nama_pelanggan', 'asc')->get();
        $list_paket = Paket::orderBy('nama_paket', 'asc')->get();
        $list_status = $this->statusOptions;

        return view('transaksi.edit', compact('transaksi', 'list_pelanggan', 'list_paket', 'list_status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $validated = $request->validate([
            'kode_transaksi' => ['required', 'string', 'max:20', Rule::unique('transaksis', 'kode_transaksi')->ignore($transaksi->id)],
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'paket_id' => 'required|exists:pakets,id',
            'tanggal' => 'required|date',
            'status' => ['required', Rule::in($this->statusOptions)],
            'catatan' => 'nullable|string|max:100',
        ]);

        // Ambil harga paket otomatis dari database
        $paket = Paket::findOrFail($validated['paket_id']);
        $validated['total_bayar'] = $paket->harga;

        $transaksi->update($validated);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    /**
     * Display printable report with date range filter.
     */
    public function laporan(Request $request)
    {
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;

        $query = Transaksi::with(['pelanggan', 'paket'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc');

        if ($tgl_awal && $tgl_akhir) {
            $query->whereBetween('tanggal', [$tgl_awal, $tgl_akhir]);
        }

        $transaksis = $query->get();

        // Hitung total pendapatan hanya dari transaksi yang selesai
        $total_pendapatan = $transaksis->where('status', 'Selesai')->sum('total_bayar');

        return view('transaksi.laporan', compact('transaksis', 'total_pendapatan', 'tgl_awal', 'tgl_akhir'));
    }

    /**
     * Struk nota thermal transaksi.
     */
    public function nota($id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'paket'])->findOrFail($id);

        return view('transaksi.nota', compact('transaksi'));
    }
}
