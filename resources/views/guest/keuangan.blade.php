@extends('layouts.guest')
@section('title', 'Keuangan - Masjid')
@section('content')
<div class="container">
    <div class="text-body text-center">
        <h1 class="display-3">Keuangan Masjid</h1>
        <h1 class="display-4">~-~</h1>
        <h3 class="display-4 fs-3">Selamat Datang di Halaman Informasi Keuangan Masjid Kami</h3>
        <p class="lead">Kami berkomitmen untuk menjaga amanah dan transparansi dalam mengelola setiap donasi yang Anda titipkan. Di sini, Anda dapat melihat laporan keuangan masjid secara detail, mulai dari pemasukan hingga pengeluaran, semua disusun untuk kenyamanan dan kepercayaan Anda.</p>
    </div>
</div>
<section>
    <div class="container">
        <div class="container mt-5">
            <h2 class="mb-4">Laporan Keuangan Masjid</h2>
            <div class="container">
                <div class="row">
                    <!-- Highlight Pemasukan -->
                    <div class="col-md-4">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-header">Total Pemasukan</div>
                            <div class="card-body">
                                <h5 class="card-title">Rp {{ number_format($dataTotalPemasukan, 0, ',', '.') }}</h5>
                                <p class="card-text">Jumlah total pemasukan kas masjid.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Highlight Pengeluaran -->
                    <div class="col-md-4">
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-header">Total Pengeluaran</div>
                            <div class="card-body">
                                <h5 class="card-title">Rp {{ number_format($dataTotalPengeluaran, 0, ',', '.') }}</h5>
                                <p class="card-text">Jumlah total pengeluaran kas masjid.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Highlight Saldo Kas -->
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header">Saldo Kas</div>
                            <div class="card-body">
                                <h5 class="card-title">Rp {{ number_format($dataTotal, 0, ',', '.') }}</h5>
                                <p class="card-text">Saldo kas saat ini (pemasukan - pengeluaran).</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Filter Bulan dan Tahun -->
            <form action="{{ route('guest.keuangan.index') }}" method="GET" class="row mb-4 p-2">
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
                        <option value="pemasukan" {{ request('jenis') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                        <option value="pengeluaran" {{ request('jenis') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                        <option value="infak_jumat" {{ request('jenis') == 'infak_jumat' ? 'selected' : '' }}>infak jumat</option>
                    </select>
                </div>
                <div class="col-md-12 mt-2 d-flex">
                    <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
                    <a href="{{ route('guest.keuangan.index') }}" class="btn btn-secondary w-50 ms-2">Reset</a>
                </div>
            </form>

            <!-- Tabel Data Keuangan -->
            <div class="table-responsive p-2" style="height: 500px;">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataKeuangan as $index => $keuangan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td> {{ \Carbon\Carbon::parse($keuangan->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $keuangan->keterangan }}</td>
                            <td>{{ ucfirst($keuangan->jenis) }}</td> <!-- pemasukan/pengeluaran -->
                            <td>Rp {{ number_format($keuangan->jumlah, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data pada bulan ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $dataKeuangan->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection