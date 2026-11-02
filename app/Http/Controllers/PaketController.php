<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pakets = Paket::orderBy('id', 'desc')->paginate(3);
        return view('paket.index', compact('pakets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('paket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_paket' => 'required|string|max:10|unique:pakets,kode_paket',
            'nama_paket' => 'required|string|max:50',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'required|string|max:100',
        ]);

        Paket::create($validated);

        return redirect()->route('paket.index')->with('success', 'Paket berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paket $paket)
    {
        return view('paket.edit', compact('paket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paket $paket)
    {
        $validated = $request->validate([
            'kode_paket' => 'required|string|max:10|unique:pakets,kode_paket,' . $paket->id,
            'nama_paket' => 'required|string|max:50',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'required|string|max:100',
        ]);

        $paket->update($validated);

        return redirect()->route('paket.index')->with('success', 'Paket berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paket $paket)
    {
        $paket->delete();

        return redirect()->route('paket.index')->with('success', 'Paket berhasil dihapus.');
    }

    /**
     * Display all data for printable report.
     */
    public function laporan()
    {
        $pakets = Paket::orderBy('id', 'desc')->get();
        return view('paket.laporan', compact('pakets'));
    }
}
