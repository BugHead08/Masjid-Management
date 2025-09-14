<?php

namespace Database\Seeders;

use App\Models\JadwalImam;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JawalImamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jadwal_imams')->insert([
            [
                'imam' => 'Ahmad Fadli',
                'muazin' => 'Ridwan Syafii',
                'tanggal' => '2024-12-01',
                
            ],
            [
                'imam' => 'Abdullah Ibrahim',
                'muazin' => 'Haris Munandar',
                'tanggal' => '2024-12-02',
            ],
            [
                'imam' => 'Muhammad Nur',
                'muazin' => 'Ali Syarif',
                'tanggal' => '2024-12-03',
            ],
            [
                'imam' => 'Hasan Basri',
                'muazin' => 'Fahmi Arif',
                'tanggal' => '2024-12-04',
            ],
            [
                'imam' => 'Hilman Fauzi',
                'muazin' => 'Zaid Sulaiman',
                'tanggal' => '2024-12-05',
            ],
            [
                'imam'=> 'Yusuf Ahmad',
                'muazin'=> 'Fahri Ibrahim',
                "tanggal"=> '2024-12-05',
            ],
            [
                "imam"=> "Ibrahim Ridwan",
                "muazin"=> "Ali Hasan",
                "tanggal"=> "2024-12-04",
            ]
        ]);
    }
}
