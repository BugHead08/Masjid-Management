@extends('layouts.admin')

@section('title', 'Menu Penjadwalan Imam')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <ul>
            {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </ul>
    </div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <ul>
            @foreach($errors -> all() as $error)
            {{$error}}
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
                    <th scope="col">tanggal</th>
                    <th scope="col">jenis</th>
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
                            <form action="{{route('imam.delete',['id'=> $imam -> id])}}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm delete-btn">✕</button>
                            </form>
                            <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="collapse"
                                data-bs-target="#collapse-{{$loop -> index}}" aria-expanded="false " onclick="toggleEditForm({{ $imam->id }})"><i class="fa fa-edit"></i></button>
                        </div>
                    </td>
                </tr>
                <tr id="edit-form-{{ $imam->id }}" style="display: none;">
                    <td colspan="6">
                        <form action="{{route('imam.update',['id'=> $imam -> id])}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-3 align-items-center">
                                <div class="col-md-3">
                                    <input
                                        type="text"
                                        name="imam"
                                        class="form-control"
                                        placeholder="Keterangan"
                                        value="{{ $imam->imam }}"
                                        required>
                                </div>
                                <div class="col-md-3">
                                    <input
                                        type="text"
                                        name="muazin"
                                        class="form-control"
                                        placeholder="Keterangan"
                                        value="{{ $imam->muazin }}"
                                        required>
                                </div>
                                <div class="col-md-2">
                                    <input
                                        type="date"
                                        name="tanggal"
                                        class="form-control"
                                        value="{{ $imam->tanggal }}"
                                        required>
                                </div>
                                <div class="col-md-2">
                                <select name="jenis" class="form-select" required>
                                        <option value="sholat fardu" {{ $imam->jenis == 'sholat fardu' ? 'selected' : '' }}>Sholat fardu</option>
                                        <option value="sholat jumat" {{ $imam->jenis == 'sholat jumat' ? 'selected' : '' }}>Sholat jumat</option>
                                        <option value="sholat teraweh" {{ $imam->jenis == 'sholat teraweh' ? 'selected' : '' }}>Sholat Teraweh</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="toggleEditForm({{ $imam->id }})">Batal</button>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Data tidak tersedia</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <form class="row g-3 justify-content-center needs-validation my-5" action="{{route('imam.input')}}" method="post">
        @csrf
        <h2>Input data imam & muazin</h2>
        <div class="col-md-3">
            <label for="validationCustom01" class="form-label">Nama Imam & Khotib</label>
            <input type="text" class="form-control" id="validationCustom01" name="imam" required>
        </div>
        <div class="col-md-3">
            <label for="validationCustom02" class="form-label">Nama Muazin</label>
            <input type="text" class="form-control" id="validationCustom02" name="muazin" required>
        </div>
        <div class="col-md-3">
            <label for="validationCustom04" class="form-label">tanggal</label>
            <input type="date" class="form-control" id="validationCustom02" name="tanggal" required>
        </div>
        <div class="col-md-3">
            <label for="validationCustom04" class="form-label">Jenis</label>
            <select name="jenis" class="form-select" required>
                <option value="sholat fardu" >Sholat Fardu</option>
                <option value="sholat jumat" >Sholat Jumat</option>
                <option value="sholat teraweh">Sholat Teraweh</option>
            </select>
        </div>
        <div class="col-md-9">
            <button class="btn btn-primary" style="width: 100%;" type="submit">Submit form</button>
        </div>
    </form>
</div>
@endsection