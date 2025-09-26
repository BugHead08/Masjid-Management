@extends('layouts.admin')

@section('title', 'Menu Pencatatan Pengajian')

@section('content')
<div class="container">
    <h1 class="display-3">Pengajian & Kegiatan Masjid</h1>
    <hr>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="input-data sticky-top d-flex justify-content-end">
        <button type="button" class="btn btn-primary rounded" data-bs-toggle="modal" data-bs-target="#modal-create">
            <i class="fa-solid fa-plus m-1"></i> Tambahkan data Pengajian atau Kegiatan
        </button>
    </div>

    <nav class="navbar navbar-light bg-light mt-2 rounded">
        <div class="container-fluid">
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>

    @forelse ($dataPengajian as $pengajian)
    <div class="card w-80 mt-2">
        <div class="card-body">
            <h5 class="card-title">Tema Pengajian: {{ $pengajian->tema }}</h5>
            <p class="card-text">Penceramah: {{ $pengajian->penceramah }}</p>
            <p class="card-text">Waktu: {{ $pengajian->waktu }}</p>
            <p class="card-text">Tanggal: {{ \Carbon\Carbon::parse($pengajian->tanggal)->format('d-m-Y') }}</p>
            <p class="card-text">Jenis: {{ $pengajian->jenis }}</p>
        </div>
        <div class="container d-flex justify-content-end p-3">
            <!-- Hapus -->
            <form action="{{ route('pengajian.destroy', ['id' => $pengajian->id]) }}" method="POST" class="m-1">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger"><i class="fa fa-trash text-white"></i></button>
            </form>

            <!-- Edit -->
            <button class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#modal-edit-{{ $loop->index }}">
                <i class="fa fa-edit"></i>
            </button>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modal-edit-{{ $loop->index }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Pengajian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pengajian.update', ['id' => $pengajian->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Tema Pengajian</label>
                            <input type="text" name="tema" class="form-control" value="{{ $pengajian->tema }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penceramah</label>
                            <input type="text" name="penceramah" class="form-control" value="{{ $pengajian->penceramah }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jam</label>
                            <input type="time" name="waktu" class="form-control" value="{{ $pengajian->waktu }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ $pengajian->tanggal }}">
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text">Jenis Pengajian</label>
                            <select name="jenis" class="form-select">
                                <option value="Muslim & muslimah" {{ $pengajian->jenis == 'Muslim & muslimah' ? 'selected' : '' }}>Muslim & Muslimah</option>
                                <option value="Muslimah" {{ $pengajian->jenis == 'Muslimah' ? 'selected' : '' }}>Muslimah</option>
                                <option value="Kuliah subuh" {{ $pengajian->jenis == 'Kuliah subuh' ? 'selected' : '' }}>Kuliah Subuh</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <p class="text-center">Data tidak tersedia</p>
    @endforelse

    <div class="d-flex justify-content-center my-1">
        {{ $dataPengajian->links() }}
    </div>

    <!-- Modal Input Baru -->
    <div class="modal fade" id="modal-create" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Pengajian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pengajian.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tema Pengajian</label>
                            <input type="text" name="tema" class="form-control" placeholder="Masukkan Tema">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penceramah</label>
                            <input type="text" name="penceramah" class="form-control" placeholder="Masukkan Nama Penceramah">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jam</label>
                            <input type="time" name="waktu" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text">Jenis Pengajian</label>
                            <select class="form-select" name="jenis">
                                <option selected disabled>Pilih..</option>
                                <option value="Muslim & muslimah">Muslim & Muslimah</option>
                                <option value="Muslimah">Muslimah</option>
                                <option value="Kuliah subuh">Kuliah Subuh</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
