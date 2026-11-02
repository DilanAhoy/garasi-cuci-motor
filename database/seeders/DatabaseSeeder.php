<?php

namespace Database\Seeders;

use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'name' => 'Admin Garasi',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        // 2. Data Paket Cuci
        $paket1 = Paket::create([
            'kode_paket' => 'PK01',
            'nama_paket' => 'Cuci Reguler',
            'harga' => 12000,
            'deskripsi' => 'Cuci bodi bersih standar',
        ]);

        $paket2 = Paket::create([
            'kode_paket' => 'PK02',
            'nama_paket' => 'Cuci Salju / Snow Wash',
            'harga' => 15000,
            'deskripsi' => 'Cuci dengan busa salju premium',
        ]);

        $paket3 = Paket::create([
            'kode_paket' => 'PK03',
            'nama_paket' => 'Cuci Komplit + Semir Ban',
            'harga' => 20000,
            'deskripsi' => 'Cuci salju bodi lengkap ditambah semir ban mengkilap',
        ]);

        $paket4 = Paket::create([
            'kode_paket' => 'PK04',
            'nama_paket' => 'Cuci Mesin & Bodi',
            'harga' => 25000,
            'deskripsi' => 'Pembersihan mendalam untuk bodi dan blok mesin',
        ]);

        // 3. Data Pelanggan Awal
        $pelanggan1 = Pelanggan::create([
            'nomor_plat' => 'BH 3456 AB',
            'nama_pelanggan' => 'Rudi Setiawan',
            'jenis_motor' => 'Matic Besar NMAX/PCX',
            'nomor_hp' => '081274983829',
        ]);

        $pelanggan2 = Pelanggan::create([
            'nomor_plat' => 'BH 7890 CD',
            'nama_pelanggan' => 'Santi Rahayu',
            'jenis_motor' => 'Matic',
            'nomor_hp' => '085212345678',
        ]);

        // 4. Data Transaksi Awal
        Transaksi::create([
            'kode_transaksi' => 'TRX-20261102-001',
            'pelanggan_id' => $pelanggan1->id,
            'paket_id' => $paket2->id,
            'tanggal' => '2026-11-02',
            'total_bayar' => $paket2->harga,
            'status' => 'Selesai',
            'catatan' => 'Cuci bersih dan rapi',
        ]);
    }
}
