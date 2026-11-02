<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $total_pendapatan = Transaksi::where('status', 'Selesai')->sum('total_bayar');
        $antrean_aktif = Transaksi::where('status', 'Sedang Dicuci')->count();
        $motor_hari_ini = Transaksi::whereDate('tanggal', Carbon::today())->count();
        $total_pelanggan = Pelanggan::count();

        $antrean_terbaru = Transaksi::with(['pelanggan', 'paket'])
            ->where('status', 'Sedang Dicuci')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        return view('home', compact(
            'total_pendapatan',
            'antrean_aktif',
            'motor_hari_ini',
            'total_pelanggan',
            'antrean_terbaru'
        ));
    }
}
