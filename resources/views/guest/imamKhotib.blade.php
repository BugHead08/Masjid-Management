@extends('layouts.guest')
@section('title', 'Imam & Khotib - Masjid')
@section('content')
<div class="container">
<div class="container">
        <div class="text-body text-center">
            <h1 class="display-3">Jadwal Imam, Muazin, dan Khotib Masjid</h1>
            <h1 class="display-4">~-~</h1>
            <h3 class="display-4 fs-3">Beribadah dengan tertib bersama imam, muazin, dan khotib pilihan yang memimpin dengan penuh tanggung jawab dan keikhlasan.</h3>
            <p class="lead">Sebagai pusat ibadah, masjid kami berkomitmen untuk menyediakan imam, muazin, dan khotib yang terpercaya dan berkompeten. Berikut adalah jadwal lengkap mereka untuk membantu Anda merencanakan ibadah dengan lebih baik.</p>
        </div>
    </div>

    <!-- filter -->
    <form action="{{route('imamkhotib')}}" method="GET" class="row mb-4">
        <div class="col-md-4">
            <label for="month" class="form-label">Pilih Bulan:</label>
            <select name="month" id="month" class="form-select">
                <option value="" disabled selected>Pilih Bulan</option>
                @foreach (range(1, 12) as $m)
                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="year" class="form-label">Pilih Tahun:</label>
            <select name="year" id="year" class="form-select">
                <option value="" disabled selected>Pilih Tahun</option>
                @foreach (range(date('Y'), date('Y') - 5) as $y)
                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                    {{ $y }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="jenis" class="form-label">Pilih Jenis:</label>
            <select name="jenis" id="year" class="form-select">
                <option value="" disabled selected>Semua jenis</option>
                <option value="sholat jumat" {{ request('jenis') == 'sholat jumat' ? 'selected' : '' }}>sholat jumat</option>
                <option value="sholat fardu" {{ request('jenis') == 'sholat fardu' ? 'selected' : '' }}>sholat fardu</option>
                <option value="sholat teraweh" {{ request('jenis') == 'sholat teraweh' ? 'selected' : '' }}>sholat teraweh</option>
            </select>
        </div>
        <div class="col-md-12 mt-2 d-flex">
            <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
            <a href="{{ route('imamkhotib') }}" class="btn btn-secondary w-50 ms-2">Reset</a>
        </div>
    </form>
    <!-- end filter -->
    <!-- tabel imam & khotib -->
    <div class="table-responsive" style="height: 500px;">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Imam</th>
                    <th>Khotib</th>
                    <th>Hari & tanggal</th>
                    <th>Jenis</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataImam as $index => $imam)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $imam -> imam }}</td>
                    <td>{{ $imam -> muazin }}</td>
                    <td>{{ \Carbon\Carbon::parse($imam->tanggal)->locale('id')->isoformat('dddd, D MMMM YYYY') }}</td>
                    <td>{{ $imam -> jenis }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data pada bulan ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$dataImam->links()}}
        </div>
    </div>
</div>
@endsection