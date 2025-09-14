<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    function index(Request $request)
    {
        $user = auth()->user(); // Ambil data user yang login, jika ada

        $dataTotalPengeluaran= Keuangan::where('jenis', 'pengeluaran')->sum('jumlah');
        $dataTotalInfak= Keuangan::where('jenis', 'infak_jumat')->sum('jumlah');
        $dataTotalPemasukan= Keuangan::where('jenis', 'pemasukan')->sum('jumlah') + $dataTotalInfak;
        $dataTotal = $dataTotalPemasukan - $dataTotalPengeluaran;

        // Filter data berdasarkan bulan dan tahun
        $month = $request->input('month');
        $year = $request->input('year');
        $jenis = $request->input('jenis');

        $dataKeuangan = Keuangan::query()
            ->when($month, function ($query) use ($month) {
                return $query->whereMonth('created_at', $month);
            })
            ->when($year, function ($query) use ($year) {
                return $query->whereYear('created_at', $year);
            })
            ->when($jenis, function ($query) use ($jenis) {
                return $query->where('jenis', $jenis);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Tampilkan data yang berbeda untuk guest dan admin
        if ($user && $user->role === 'admin') {
            return view('admin.keuangan', compact('dataKeuangan'));
        } else {
            return view('guest.keuangan', [
                'dataKeuangan'=>$dataKeuangan,
                'dataTotalPengeluaran' => $dataTotalPengeluaran,
                'dataTotalPemasukan' => $dataTotalPemasukan,
                'dataTotal' => $dataTotal,
        ]);
        }
    }

    function store(Request $request)
    {
        $validated = $request->validate([
            'keterangan' => 'required',
            'jumlah' => 'required',
            'jenis' => 'required|in:pemasukan,pengeluaran,infak_jumat',
            'tanggal' => 'required|date',
        ]);

        Keuangan::create($validated);
        return redirect()->route('keuangan')->with('success', 'Berhasil simpan data');
    }

    function update(Request $request, $id)
    {
        $validated = $request->validate([
            'keterangan' => 'required',
            'jumlah' => 'required',
            'jenis' => 'required|in:pemasukan,pengeluaran,infak_jumat',
            'tanggal' => 'required|date',
        ]);

        Keuangan::where('id', $id)->update($validated);
        return redirect()->route('keuangan')->with('success', 'Berhasil mengubah data');
    }

    function destroy(Request $request, $id)
    {
        Keuangan::where('id', $id)->delete();
        return redirect()->route('keuangan')->with('success', 'Berhasil menghapus data');
    }
}
