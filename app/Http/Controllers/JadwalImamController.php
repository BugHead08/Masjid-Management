<?php

namespace App\Http\Controllers;

use App\Models\JadwalImam;
use Illuminate\Http\Request;

class JadwalImamController extends Controller
{
    function index(Request $request){
        $user = auth()->user();

        $month = $request->input('month');
        $year = $request->input('year');
        $jenis = $request->input('jenis');

        $dataImam = JadwalImam::query()
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
            return view('admin.imam',[
                'dataImam'=>$dataImam,
            ]
        );
        } else {
            return view('guest.imamKhotib', [
                'dataImam'=>$dataImam,
            ]);
        }
        
    }

    function store(Request $request){
        $validate = $request -> validate([
            'imam' => 'required|max:50|string|regex:/^[a-zA-Z\s.,]+$/',
            'muazin' => 'required|max:50|string|regex:/^[a-zA-Z\s.,]+$/',
            'tanggal' => 'required',
            'jenis' => 'required|regex:/^[a-zA-Z\s.,]+$/',
        ]);

        JadwalImam::create($validate);
        return redirect()->route('imam')->with('success', 'Berhasil simpan data imam & khotib');
    }

    function update(Request $request, $id){
        $validate = $request -> validate([
            'imam' => 'required|max:50|string|regex:/^[a-zA-Z\s.,]+$/',
            'muazin' => 'required|max:50|string|regex:/^[a-zA-Z\s.,]+$/',
            'tanggal' => 'required',
            'jenis' => 'required|regex:/^[a-zA-Z\s.,]+$/',
        ]);

        JadwalImam::where('id', $id)->update($validate);
        return redirect()->route('imam')->with('success', 'Berhasil mengubah data imam & khotib');
    }

    function destroy(Request $request, $id){
        JadwalImam::where('id', $id)->delete();return redirect()->route('imam')->with('success', 'Berhasil menghapus data');
    }
}
