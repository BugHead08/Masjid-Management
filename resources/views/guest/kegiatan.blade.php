@extends('layouts.guest')
@section('title', 'Kegiatan pengajian - Masjid')
@section('content')
<div class="container">
    <div class="container p-3 text-kegiatan">
        <div class="text-body text-center" style="height:500px ">
            <h1 class="display-3">Kegiatan Masjid <br>Beribadah dan Bersama dalam Keberkahan</h1>
            <h1 class="display-4">~-~</h1>
            <h3 class="display-4 fs-3">Temukan informasi lengkap tentang kegiatan masjid kami. Ikuti jadwal pengajian, kajian Islami, kegiatan sosial, dan acara lainnya yang membawa kebaikan untuk kita semua.</h3>
            <p class="lead">Masjid kami tidak hanya menjadi tempat ibadah, tetapi juga pusat kegiatan Islami yang mempererat ukhuwah Islamiyah. Kami mengundang Anda untuk bergabung dalam berbagai program kami, mulai dari Pengajian Muslim & Muslimah, Kuliah Subuh dan Pengajian Muslimah</p>
        </div>
    </div>
    <div class="container kegiatan-week">
        <div class="card mt-0 p-2" style="height: 400px; margin-top: 10px;">
            <div class="card-body">
                <div class="card-title text-center">
                    <h1 class="display-4 "> Kegiatan minggu ini </h1>
                    <h4 class="display-4 fs-4">{{ ucfirst($hariini)}}</h4>
                </div>
                <div class="card-body text-center">
                    @if ($dataPengajianWeek->isEmpty())
                    <p>Tidak ada kegiatan untuk minggu ini.</p>
                    @else
                    @foreach ($dataPengajianWeek as $kegiatan)
                    <img src="{{asset('img/icon_manajemen.png')}}" alt="" style="width: 100px;">
                    <h4 class="uppercase">Tema : {{$kegiatan -> tema }}</h4>
                    <h4 class="uppercase">Pengisi Acara : {{$kegiatan -> penceramah }}</h4>
                    <h4 class="uppercase">waktu & tanggal : {{$kegiatan -> waktu }}, {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d-m-Y') }}</h4>
                    <h4 class="uppercase">Untuk : {{$kegiatan -> jenis }}</h4>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-2">
            {{$dataPengajianWeek -> links()}}
        </div>
    </div>

    <!-- tabel kegiatan -->
    <form action="{{route('kegiatan')}}" method="GET" class="row mb-4 p-2" >
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
                <option value="muslim & muslimah" {{ request('jenis') == 'muslim & muslimah' ? 'selected' : '' }}>muslim & muslimah</option>
                <option value="muslimah" {{ request('jenis') == 'muslimah' ? 'selected' : '' }}>muslimah</option>
                <option value="kuliah subuh" {{ request('jenis') == 'kuliah subuh' ? 'selected' : '' }}>kuliah subuh</option>
            </select>
        </div>
        <div class="col-md-12 mt-2 d-flex">
            <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
            <a href="{{ route('kegiatan') }}" class="btn btn-secondary w-50 ms-2">Reset</a>
        </div>
    </form>

    <!-- Tabel Data Keuangan -->
    <div class="table-responsive p-3" style="height: 500px;">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tema</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Jenis</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataPengajian as $index => $pengajian)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pengajian -> tema }}</td>
                    <td>{{ \Carbon\Carbon::parse($pengajian->tanggal)->locale('id')->isoformat('dddd, D MMMM YYYY') }}</td>
                    <td>{{ $pengajian -> waktu }}</td>
                    <td>{{ $pengajian -> jenis }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data pada bulan ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection