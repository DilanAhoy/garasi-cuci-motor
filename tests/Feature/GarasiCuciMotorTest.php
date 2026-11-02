<?php

namespace Tests\Feature;

use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GarasiCuciMotorTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Jalankan DatabaseSeeder sebelum setiap test case
        $this->seed(DatabaseSeeder::class);
    }

    /**
     * Test 1: Halaman login dapat diakses dan user dapat login dengan akun seeder (admin@gmail.com / 12345678).
     */
    public function test_halaman_login_dapat_diakses_dan_user_dapat_login(): void
    {
        // 1. Cek halaman login dapat diakses (HTTP 200)
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('GARASI CUCI MOTOR');

        // 2. User dapat login dengan kredensial seeder
        $loginResponse = $this->post('/login', [
            'email' => 'admin@gmail.com',
            'password' => '12345678',
        ]);

        $loginResponse->assertRedirect('/home');
        $this->assertAuthenticated();
    }

    /**
     * Test 2: Dashboard /home menampilkan data statistik dengan status HTTP 200.
     */
    public function test_dashboard_home_menampilkan_data_statistik_dengan_status_200(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->first();
        $response = $this->actingAs($admin)->get('/home');

        $response->assertStatus(200);
        $response->assertSee('Dashboard Operasional Garasi');
        $response->assertSee('Total Pendapatan');
        $response->assertSee('Sedang Dicuci');
        $response->assertSee('Motor Hari Ini');
        $response->assertSee('Total Pelanggan');
    }

    /**
     * Test 3: Modul Paket dapat membuat paket baru dan terdaftar di database.
     */
    public function test_modul_paket_dapat_membuat_paket_baru_dan_terdaftar_di_database(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->first();

        $paketData = [
            'kode_paket' => 'PK99',
            'nama_paket' => 'Cuci Detailing Titanium',
            'harga' => 50000,
            'deskripsi' => 'Perawatan bodi dan proteksi nano coating',
        ];

        $response = $this->actingAs($admin)->post(route('paket.store'), $paketData);

        $response->assertRedirect(route('paket.index'));
        $this->assertDatabaseHas('pakets', [
            'kode_paket' => 'PK99',
            'nama_paket' => 'Cuci Detailing Titanium',
            'harga' => 50000,
        ]);
    }

    /**
     * Test 4: Modul Pelanggan dapat menyimpan data motor dan nomor plat otomatis tersimpan UPPERCASE.
     */
    public function test_modul_pelanggan_dapat_menyimpan_data_dan_plat_otomatis_uppercase(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->first();

        $pelangganData = [
            'nomor_plat' => 'b 1234 xyz', // Input huruf kecil
            'nama_pelanggan' => 'Ahmad Fauzi',
            'jenis_motor' => 'Sport',
            'nomor_hp' => '081399887766',
        ];

        $response = $this->actingAs($admin)->post(route('pelanggan.store'), $pelangganData);

        $response->assertRedirect(route('pelanggan.index'));

        // Pastikan tersimpan dengan format UPPERCASE
        $this->assertDatabaseHas('pelanggans', [
            'nomor_plat' => 'B 1234 XYZ',
            'nama_pelanggan' => 'Ahmad Fauzi',
            'jenis_motor' => 'Sport',
            'nomor_hp' => '081399887766',
        ]);
    }

    /**
     * Test 5: Modul Transaksi otomatis menghitung total_bayar sesuai harga paket yang dipilih.
     */
    public function test_modul_transaksi_otomatis_menghitung_total_bayar_sesuai_harga_paket(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->first();
        $pelanggan = Pelanggan::first();
        $paket = Paket::where('kode_paket', 'PK03')->first(); // Tarif Rp 20.000

        $trxData = [
            'kode_transaksi' => 'TRX-TEST-001',
            'pelanggan_id' => $pelanggan->id,
            'paket_id' => $paket->id,
            'tanggal' => date('Y-m-d'),
            'status' => 'Sedang Dicuci',
            'catatan' => 'Semir ban tebal',
        ];

        $response = $this->actingAs($admin)->post(route('transaksi.store'), $trxData);

        $response->assertRedirect(route('transaksi.index'));

        // Pastikan total_bayar terisi otomatis 20000 sesuai harga paket PK03
        $this->assertDatabaseHas('transaksis', [
            'kode_transaksi' => 'TRX-TEST-001',
            'pelanggan_id' => $pelanggan->id,
            'paket_id' => $paket->id,
            'total_bayar' => 20000,
            'status' => 'Sedang Dicuci',
        ]);
    }

    /**
     * Test 6: Halaman cetak nota dan laporan keuangan dapat diakses dengan status HTTP 200.
     */
    public function test_halaman_cetak_nota_dan_laporan_keuangan_dapat_diakses_dengan_status_200(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->first();
        $transaksi = Transaksi::first();

        // 1. Cek Nota Struk Thermal
        $notaResponse = $this->actingAs($admin)->get(route('transaksi.nota', $transaksi->id));
        $notaResponse->assertStatus(200);
        $notaResponse->assertSee($transaksi->kode_transaksi);
        $notaResponse->assertSee('GARASI CUCI MOTOR');

        // 2. Cek Laporan Keuangan / Rekapitulasi Transaksi
        $laporanResponse = $this->actingAs($admin)->get(route('transaksi.laporan'));
        $laporanResponse->assertStatus(200);
        $laporanResponse->assertSee('LAPORAN PENDAPATAN', false);

        // 3. Cek Laporan Paket Layanan
        $paketLaporanResponse = $this->actingAs($admin)->get(route('paket.laporan'));
        $paketLaporanResponse->assertStatus(200);
        $paketLaporanResponse->assertSee('LAPORAN DAFTAR PAKET LAYANAN CUCI MOTOR');

        // 4. Cek Laporan Pelanggan
        $pelangganLaporanResponse = $this->actingAs($admin)->get(route('pelanggan.laporan'));
        $pelangganLaporanResponse->assertStatus(200);
        $pelangganLaporanResponse->assertSee('LAPORAN DATA PELANGGAN', false);
    }
}
