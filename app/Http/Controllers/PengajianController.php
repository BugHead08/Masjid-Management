<?php

namespace App\Http\Controllers;

use App\Models\pengajian;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengajianController extends Controller
{
    function index(Request $request)
    {
        $user = auth()->user();

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $dataPengajianWeek = pengajian::whereBetween('tanggal', [$startOfWeek, $endOfWeek])
        ->orderBy('created_at', 'desc')
        ->paginate(1);

        $hariIni = Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY');
        

        $month = $request->input('month');
        $year = $request->input('year');
        $jenis = $request->input('jenis');
        
        $dataPengajian = pengajian::query()
        ->when($month, function ($query) use ($month) {
            return $query->whereMonth('tanggal', $month);
        })
        ->when($year, function ($query) use ($year) {
            return $query->whereYear('tanggal', $year);
        })
        ->when($jenis, function ($query) use ($jenis) {
            return $query->where('jenis', $jenis);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(5);


        if ($user && $user->role === 'admin') {
            return view('admin.pengajian', [
                'dataPengajian' => $dataPengajian,
            ]);
        } else {
            return view('guest.kegiatan',[
                'dataPengajian'=> $dataPengajian,
                'dataPengajianWeek' => $dataPengajianWeek,
                'hariini' => $hariIni,
        ]);
        }
    }

    function store(Request $request)
    {
        $validated = $request->validate([
            'tema' => 'required|min:10|max:100|regex:/^[a-zA-Z\s.,]+$/',
            'penceramah' => 'required|min:10|max:50|regex:/^[a-zA-Z\s.,]+$/',
            'waktu' => 'required',
            'tanggal' => 'required|date',
            'jenis' => 'required|in:Muslim & muslimah,Muslimah,Kuliah subuh',
        ]);

        pengajian::create($validated);
        return redirect()->route('pengajian')->with('success', 'Berhasil simpan data');
    }

    function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tema' => 'required|min:10|max:100|regex:/^[a-zA-Z\s.,]+$/',
            'penceramah' => 'required|min:10|max:50|regex:/^[a-zA-Z\s.,]+$/',
            'waktu' => 'required',
            'tanggal' => 'required|date',
            'jenis' => 'required|in:Muslim & muslimah,Muslimah,Kuliah subuh',
        ]);

        pengajian::where('id', $id)->update($validated);
        return redirect()->route('pengajian')->with('success', 'Berhasil mengubah data');
    }

    function destroy(Request $request, $id)
    {
        pengajian::where('id', $id)->delete();
        return redirect()->route('pengajian')->with('success', 'Berhasil dihapus');
    }
}
