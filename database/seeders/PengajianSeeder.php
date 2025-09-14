<?php

namespace Database\Seeders;

use App\Models\pengajian;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengajianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengajians')->insert([
            [
                'tema' => 'Pentingnya Sholat Berjamaah',
                'penceramah' => 'Ustadz Abdullah Hasan',
                'waktu' => '10:00:00',
                'tanggal' => '2024-12-01',
                'jenis' => 'Muslim & muslimah',
            ],
            [
                'tema' => 'Keutamaan Sedekah',
                'penceramah' => 'Ustadzah Nurul Hidayah',
                'waktu' => '08:00:00',
                'tanggal' => '2024-12-03',
                'jenis' => 'Muslimah',
            ], 
            [
                'tema' => 'Pentingnya Sholat Berjamaah',
                'penceramah' => 'Ustadz Abdullah Hasan',
                'waktu' => '10:00:00',
                'tanggal' => '2024-12-01',
                'jenis' => 'Muslim & muslimah',
            ],
            [
                'tema' => 'Keutamaan Sedekah',
                'penceramah' => 'Ustadzah Nurul Hidayah',
                'waktu' => '08:00:00',
                'tanggal' => '2024-12-03',
                'jenis' => 'Muslimah',
            ],
            [
                'tema' => 'Meningkatkan Iman di Era Digital',
                'penceramah' => 'Ustadz Rahman Taufiq',
                'waktu' => '09:00:00',
                'tanggal' => '2024-12-05',
                'jenis' => 'Kuliah subuh',
            ],
            [
                'tema' => 'Adab Seorang Muslim',
                'penceramah' => 'Ustadzah Nur Hidayah',
                'waktu' => '07:30:00',
                'tanggal' => '2024-12-07',
                'jenis' => 'Muslimah',
            ],
            [
                'tema' => 'Peran Pemuda dalam Dakwah',
                'penceramah' => 'Ustadz Hilmi Firdaus',
                'waktu' => '08:45:00',
                'tanggal' => '2024-12-10',
                'jenis' => 'Muslim & muslimah',
            ],
        ]);
    }
}
