<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\JadwalImam;
use App\Models\Keuangan;
use App\Models\pengajian;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private function calculateFinancialData()
    {
        $totalPengeluaran = Keuangan::where('jenis', 'pengeluaran')->sum('jumlah');
        $totalPemasukan = Keuangan::where('jenis', 'pemasukan')->sum('jumlah');
        $totalInfak = Keuangan::where('jenis', 'infak_jumat')->sum('jumlah');

        return [
            'totalPengeluaran' => $totalPengeluaran,
            'totalInfak' => $totalInfak,
            'totalPemasukan' => $totalPemasukan + $totalInfak,
            'totalSaldo' => ($totalPemasukan + $totalInfak ) - $totalPengeluaran,
        ];
    }

    private function getWeeklyRange()
    {
        return [
            'startOfWeek' => Carbon::now()->startOfWeek(),
            'endOfWeek' => Carbon::now()->endOfWeek(),
        ];
    }

    private function getWeeklyPengajian()
    {
        $weekRange = $this->getWeeklyRange();

        return Pengajian::whereBetween('tanggal', [$weekRange['startOfWeek'], $weekRange['endOfWeek']])
            ->orderBy('created_at', 'desc')
            ->paginate(1);
    }

    private function getFormattedDate()
    {
        return Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY');
    }

    private function getImamData()
    {
        return JadwalImam::all();
    }


    public function index()
    {
        $dataKeuangan = Keuangan::query()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $financialData = $this->calculateFinancialData();
        $imamData = $this->getImamData();

        return view('admin.dashboard', [
            'dataTotalPengeluaran' => $financialData['totalPengeluaran'],
            'dataTotalPemasukan' => $financialData['totalPemasukan'],
            'dataKeuangan' =>$dataKeuangan,
            'dataTotal' => $financialData['totalSaldo'],
            'dataImam' => $imamData,
            
        ]);
        
    }

    public function home()
    {
        
        $financialData = $this->calculateFinancialData();
        $weeklyPengajian = $this->getWeeklyPengajian();
        $formattedDate = $this->getFormattedDate();

        return view('guest.home', [
            'dataPengajianWeek' => $weeklyPengajian,
            'hariini' => $formattedDate,
            'dataTotalPengeluaran' => $financialData['totalPengeluaran'],
            'dataTotalPemasukan' => $financialData['totalPemasukan'],
            'dataTotal' => $financialData['totalSaldo'],
        ]);
    }
}
