@extends('layouts.guest')
@section('title', 'Beranda - Masjid')
@section('content')

<div class="jumbotron jumbotron-fluid bg-image" style="margin-top: -60px;">
    <div class="container text-white text-center">
        <h1 class="display-3 font-weight-bold">MASJID AL-IKHLAS</h1>
        <p class="lead">~ Bersama kita membangun masjid, bersama kita membangun umat. ~</p>
    </div>
</div>

<!-- visi -->
<section class="py-5 visi">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4 h-50">
                <div class="card shadow border-0 h-100">
                    <div class="card-body ">
                        <div class="icon w-100 h-50">
                            <img src="{{asset('img/icon_masjid.png')}}" class="border border-3 border-dark rounded-pill" style="width:100px; height:100px;"></img>
                        </div>
                        <h5 class="card-title fw-bold">Tentang Kami</h5>
                        <p class="card-text">
                        Masjid ini berdiri sebagai pusat ibadah dan kegiatan sosial, berkomitmen membangun umat yang berdaya melalui program spiritual dan pemberdayaan masyarakat yang berkelanjutan.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4 h-50">
                <div class="card shadow border-0 h-100">
                    <div class="card-body">
                        <div class="icon w-100 h-50">
                            <img src="{{asset('img/icon_manajemen.png')}}" class="border border-3 border-dark rounded-pill" style="width:100px; height:100px;"></img>
                        </div>
                        <h5 class="card-title fw-bold">Manajemen Masjid</h5>
                        <p class="card-text">
                        Kami mengelola masjid dengan pendekatan modern yang tetap berpijak pada nilai-nilai Islam, menghadirkan transparansi dan inovasi demi manfaat yang lebih luas bagi masyarakat.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4 h-50" >
                <div class="card shadow border-0 h-100">
                    <div class="card-body">
                        <div class="icon w-100 h-50">
                            <img src="{{asset('img/icon_support.png')}}" class="border border-3 border-dark rounded-pill" style="width:100px; height:100px;"></img>
                        </div>
                        <h5 class="card-title fw-bold">Support</h5>
                        <p class="card-text">
                        Dukung misi kami dengan infak, sedekah, zakat, dan wakaf. Setiap kontribusi Anda akan kami kelola dengan amanah untuk mendukung program dakwah dan kegiatan sosial.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- jadwal solat -->

<section class="jadwal">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="text-body">
                    <h4 class="display-4">Jadwal Shalat Selanjutnya</h4>
                    <div id="next-prayer" class="fs-3 fw-bold text-primary"></div>
                    <p id="current-time"></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row my-5" id="prayer-times">

                </div>
            </div>
        </div>
    </div>
</section>

<!-- agenda -->

<section class="agenda bg-success ">
    <div class="container">
        <div class="heading text-center text-white">
            <h4 class="display-5 mt-3">Agenda Kegiatan Masjid</h4>
            <p>Kami juga mengadakan acara khusus seperti seminar keislaman, tabligh akbar, dan kegiatan sosial yang dirancang untuk memenuhi kebutuhan spiritual dan sosial masyarakat.</p>
        </div>
        <div class="card" style="height: 370px;">
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
                    <h4 class="uppercase">Waktu & tanggal : {{$kegiatan -> waktu }}, {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d-m-Y') }}</h4>
                    <a class="btn btn-primary" href="{{route('kegiatan')}}">Daftar kegiatan/taklim masjid</a>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- laporan keuangan -->
<div class="container laporan">
    <h2 class="mb-4 mt-2">Laporan Keuangan Masjid</h2>
    <div class="container ">
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
        <a href="{{route('guest.keuangan.index')}}" class="btn btn-primary">Selengkapnya</a>
    </div>
</div>

@endsection