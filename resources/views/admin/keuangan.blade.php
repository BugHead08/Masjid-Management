@extends('layouts.admin')

@section('title', 'Menu Keuangan')

@section('content')
<div class="container">

    @if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <ul>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </ul>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </ul>
    </div>
    @endif

    <h1>Keuangan</h1>

    <!-- Tabel catatan -->
    <div class="col-lg-8 mx-auto">
        <h4 class="my-4">Laporan Keuangan</h4>
        <table class="table table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataKeuangan as $keuangan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $keuangan->keterangan }}</td>
                    <td>{{ $keuangan->jenis }}</td>
                    <td>{{ $keuangan->tanggal }}</td>
                    <td>{{ number_format($keuangan->jumlah, 2, ',', '.') }}</td>
                    <td>
                        <div class="btn-group">
                            <form action="{{ route('keuangan.destroy', ['id' => $keuangan->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm delete-btn">✕</button>
                            </form>
                            <button class="btn btn-primary btn-sm edit-btn" 
                                onclick="toggleEditForm({{ $keuangan->id }})">
                                <i class="fa fa-edit"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr id="edit-form-{{ $keuangan->id }}" style="display: none;">
                    <td colspan="6">
                        <form action="{{ route('keuangan.update', ['id' => $keuangan->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row g-3 align-items-center">
                                <div class="col-md-3">
                                    <input type="text" name="keterangan" class="form-control"
                                           value="{{ $keuangan->keterangan }}" required>
                                </div>
                                <div class="col-md-2">
                                    <select name="jenis" class="form-select" required>
                                        <option value="pemasukan" {{ $keuangan->jenis == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                        <option value="pengeluaran" {{ $keuangan->jenis == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                                        <option value="infak_jumat" {{ $keuangan->jenis == 'infak_jumat' ? 'selected' : '' }}>Infak Jumat</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" name="tanggal" class="form-control"
                                           value="{{ $keuangan->tanggal }}" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="jumlah" class="form-control"
                                           value="{{ $keuangan->jumlah }}" required>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="toggleEditForm({{ $keuangan->id }})">Batal</button>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Data tidak tersedia</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Form input baru -->
    <div class="card my-3 p-5 col-md-9 mx-auto shadow">
        <form class="row g-3 justify-content-center needs-validation" 
              action="{{ route('keuangan.store') }}" method="POST">
            @csrf
            <h2>Input Laporan</h2>
            <div class="col-md-3">
                <label class="form-label">Keterangan</label>
                <input type="text" class="form-control" name="keterangan" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Nominal</label>
                <input type="number" class="form-control" name="jumlah" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Jenis</label>
                <select class="form-select" name="jenis" required>
                    <option selected disabled value="">Pilih...</option>
                    <option value="pemasukan">Pemasukan</option>
                    <option value="pengeluaran">Pengeluaran</option>
                    <option value="infak_jumat">Infak Jumat</option>
                </select>
            </div>
            <div class="col-md-9">
                <label class="form-label">Tanggal</label>
                <input type="date" class="form-control" name="tanggal" required>
            </div>
            <div class="col-md-9">
                <button class="btn btn-primary w-100" type="submit">Submit form</button>
            </div>
        </form>
    </div>
</div>
@endsection
