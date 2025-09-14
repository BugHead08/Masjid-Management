<?php

namespace Database\Seeders;

use App\Models\Keuangan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('keuangans')->insert([
            [
                'keterangan' => 'Donasi Pembangunan',
                'tanggal' => '2024-12-01',
                'jumlah' => 5000000,
                'jenis' => 'pemasukan',
            ],
            [
                'tanggal' => '2024-12-02',
                'keterangan' => 'Pembelian Perlengkapan Masjid',
                'jumlah' => 1500000,
                'jenis' => 'pengeluaran',
            ],
            [
                'tanggal' => '2024-12-03',
                'keterangan' => 'Infak Jumat',
                'jumlah' => 2500000,
                'jenis' => 'infak_jumat',
            ],
            [
                'tanggal' => '2024-12-04',
                'keterangan' => 'Sumbangan Acara Maulid Nabi',
                'jumlah' => 3000000,
                'jenis' => 'pemasukan',
            ],
            [
                'tanggal' => '2024-12-05',
                'keterangan' => 'Pembelian Karpet Masjid',
                'jumlah' => 2000000,
                'jenis' => 'pengeluaran',
            ],
        ]);
    }
}
