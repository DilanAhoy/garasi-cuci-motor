<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PelangganController extends Controller
{
    /**
     * List of available motorcycle types.
     */
    protected array $jenisMotorOptions = [
        'Matic',
        'Bebek',
        'Sport',
        'Matic Besar (NMAX/PCX)',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggans = Pelanggan::orderBy('id', 'desc')->paginate(3);
        return view('pelanggan.index', compact('pelanggans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis_motor_options = $this->jenisMotorOptions;
        return view('pelanggan.create', compact('jenis_motor_options'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_plat' => 'required|string|max:15|unique:pelanggans,nomor_plat',
            'nama_pelanggan' => 'required|string|max:50',
            'jenis_motor' => ['required', Rule::in($this->jenisMotorOptions)],
            'nomor_hp' => 'required|string|max:20',
        ]);

        $validated['nomor_plat'] = strtoupper($validated['nomor_plat']);

        Pelanggan::create($validated);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        $jenis_motor_options = $this->jenisMotorOptions;
        return view('pelanggan.edit', compact('pelanggan', 'jenis_motor_options'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validated = $request->validate([
            'nomor_plat' => ['required', 'string', 'max:15', Rule::unique('pelanggans', 'nomor_plat')->ignore($pelanggan->id)],
            'nama_pelanggan' => 'required|string|max:50',
            'jenis_motor' => ['required', Rule::in($this->jenisMotorOptions)],
            'nomor_hp' => 'required|string|max:20',
        ]);

        $validated['nomor_plat'] = strtoupper($validated['nomor_plat']);

        $pelanggan->update($validated);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus.');
    }

    /**
     * Display all data for printable report.
     */
    public function laporan()
    {
        $pelanggans = Pelanggan::orderBy('id', 'desc')->get();
        return view('pelanggan.laporan', compact('pelanggans'));
    }
}
