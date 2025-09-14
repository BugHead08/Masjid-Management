@extends('layouts.admin')
@section('title', 'Dashboard Admin|Masjid')
@section('content')

<div class="dashboard">
    <h5 class="my-4">Selamat Datang,</h5>
    <h3 class="my-4">Admin Masjid</h3>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-xl-4 col-md-6 mt-1">
                <!-- Card saldo terakhir -->
                <div class="card info-card sales-card">
                    <!-- Card Body -->
                    <div class="card-body">
                        <h5 class="card-title">Saldo Terakhir</h5>

                        <div class="d-flex align-items-center">
                            <!-- Card Icon -->
                            <div class=" d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-coins fs-1"></i>
                            </div>
                            <!-- End Card Icon -->

                            <!-- Sales Info -->
                            <div class="ps-3">
                                <h6 class="mb-1">{{ number_format($dataTotal, 2) }}</h6>
                            </div>
                            <!-- End Sales Info -->
                        </div>
                    </div>
                    <!-- End Card Body -->
                </div>
                <!-- End Card Container -->
            </div>
            <div class="col-xl-4 col-md-6 mt-1">
                <!-- Card Total pemasukan -->
                <div class="card info-card sales-card">

                    <!-- Card Body -->
                    <div class="card-body">
                        <h5 class="card-title">Total Pemasukan</h5>

                        <div class="d-flex align-items-center">
                            <!-- Card Icon -->
                            <div class=" d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-money-bill-trend-up fs-1"></i>
                            </div>
                            <!-- End Card Icon -->

                            <!-- Sales Info -->
                            <div class="ps-3">
                                <h6 class="mb-1">{{ number_format($dataTotalPemasukan, 2) }}</h6>
                            </div>
                            <!-- End Sales Info -->
                        </div>
                    </div>
                    <!-- End Card Body -->
                </div>
                <!-- End Card Container -->
            </div>
            <div class="col-xl-4 col-md-6 mt-1">
                <!-- Card total pengeluaran -->
                <div class="card info-card sales-card">

                    <!-- Card Body -->
                    <div class="card-body">
                        <h5 class="card-title">Total Pengeluaran</h5>

                        <div class="d-flex align-items-center">
                            <!-- Card Icon -->
                            <div class=" d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-money-bill-transfer fs-1"></i>
                            </div>
                            <!-- End Card Icon -->

                            <!-- Sales Info -->
                            <div class="ps-3">
                                <h6 class="mb-1">{{ number_format($dataTotalPengeluaran, 2) }}</h6>
                            </div>
                            <!-- End Sales Info -->
                        </div>
                    </div>
                    <!-- End Card Body -->
                </div>
                <!-- End Card Container -->
            </div>
        </div>
    </div>
    <br>
    <div class="col-lg-8 mx-auto">
        <h4 class="my-4">SELURUH DATA KEUANGAN</h4>
        <table class="table table-hover mt-3">
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
    </div>
</div>

@endsection