@extends('layouts.admin')

@section('title', 'Menu Penjadwalan Imam')

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

    <div class="col-lg-8 mx-auto">
        <table class="table table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Imam & Khotib</th>
                    <th scope="col">Muazin</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataImam as $imam)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $imam->imam }}</td>
                    <td>{{ $imam->muazin }}</td>
                    <td>{{ $imam->tanggal }}</td>
                    <td>{{ $imam->jenis }}</td>
                    <td>
                        <div class="btn-group">
                            <!-- Tombol hapus -->
                            <form action="{{ route('imam.destroy', ['id' => $imam->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm delete-btn">✕</button>
                            </form>
                            <!-- Tombol edit -->
                            <button class="btn btn-primary btn-sm edit-btn" onclick="toggleEditForm({{ $imam->id }})">
                                <i class="fa fa-edit"></i>
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Form edit -->
                <tr id="edit-form-{{ $imam->id }}" style="display: none;">
                    <td colspan="6">
                        <form action="{{ route('imam.update', ['id' => $imam->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-3 align-items-center">
                                <div class="col-md-3">
                                    <input type="text" name="imam" class="form-control"
                                           value="{{ $imam->imam }}" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="muazin" class="form-control"
                                           value="{{ $imam->muazin }}" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" name="tanggal" class="form-control"
                                           value="{{ $imam->tanggal }}" required>
                                </div>
                                <div class="col-md-2">
                                    <select name="jenis" class="form-select" required>
                                        <option value="sholat fardu" {{ $imam->jenis == 'sholat fardu' ? 'selected' : '' }}>Sholat Fardu</option>
                                        <option value="sholat jumat" {{ $imam->jenis == 'sholat jumat' ? 'selected' : '' }}>Sholat Jumat</option>
                                        <option value="sholat teraweh" {{ $imam->jenis == 'sholat teraweh' ? 'selected' : '' }}>Sholat Teraweh</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="toggleEditForm({{ $imam->id }})">Batal</button>
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

    <!-- Form tambah imam -->
    <form class="row g-3 justify-content-center needs-validation my-5" 
          action="{{ route('imam.store') }}" method="POST">
        @csrf
        <h2>Input data imam & muazin</h2>
        <div class="col-md-3">
            <label class="form-label">Nama Imam & Khotib</label>
            <input type="text" class="form-control" name="imam" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Nama Muazin</label>
            <input type="text" class="form-control" name="muazin" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Tanggal</label>
            <input type="date" class="form-control" name="tanggal" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Jenis</label>
            <select name="jenis" class="form-select" required>
                <option value="sholat fardu">Sholat Fardu</option>
                <option value="sholat jumat">Sholat Jumat</option>
                <option value="sholat teraweh">Sholat Teraweh</option>
            </select>
        </div>
        <div class="col-md-9">
            <button class="btn btn-primary w-100" type="submit">Submit form</button>
        </div>
    </form>
</div>
@endsection
