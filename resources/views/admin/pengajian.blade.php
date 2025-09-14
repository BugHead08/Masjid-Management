@extends('layouts.admin')

@section('title', 'Menu Pencatatan Pengajian')

@section('content')
<div class="container">
    <h1 class="display-3 ">Pengajian & kegiatan masjid</h1>
    <hr>
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
    <div class="input-data sticky-top d-flex justify-content-end">
        <button type="submit" class="btn btn-primary rounded" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus m-1"></i>Tambahkan data Pengajian atau kegiatan</button>
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
    <div class="card w-80 mt-2 ">
        <div class="card-body">
            <h5 class="card-title">Tema Pengajian : {{$pengajian -> tema}}</h5>
            <p class="card-text">Penceramah : {{$pengajian -> penceramah}}</p>
            <p class="card-text">Waktu : {{$pengajian -> waktu}}</p>
            <p class="card-text">Tanggal : {{ \Carbon\Carbon::parse($pengajian->tanggal)->format('d-m-Y') }}</p>
            <p class="card-text">Pengajian untuk {{$pengajian -> jenis}}</p>
        </div>
        <div class="container d-flex justify-content-end p-3">
            <form action="{{route('pengajian.delete',['id'=> $pengajian -> id])}}" class="m-1 " method="post">
                @csrf
                @method('delete')
                <button class="btn btn-danger"><i class="fa fa-trash text-white"></i></button>
            </form>
            <button class="btn btn-primary m-1" data-bs-toggle="modal"
                data-bs-target="#modal-edit-{{$loop -> index}}" aria-expanded="false "><i class="fa fa-edit"></i></button>
        </div>
    </div>
    
    <!-- modal untuk edit data -->
    <div class="modal fade" id="modal-edit-{{$loop -> index}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Masukan Data Pengajian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('pengajian.update',['id'=> $pengajian -> id])}}" method="post">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tema Pengajian</label>
                            <input type="text" name="tema" class="form-control" value="{{ $pengajian -> tema }}" id="exampleFormControlailInput1" placeholder="Masukkan Tema Pengajian">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Penceramah</label>
                            <input type="text" name="penceramah" value="{{ $pengajian->penceramah }}" class="form-control" id="exampleFormControlInput1" placeholder="Masukan Nama Penceramah">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Jam dilaksanakan </label>
                            <input type="time" name="waktu" value="{{ $pengajian->waktu }}" class="form-control" placeholder="Masukan jam " lang="en-GB">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tanggal Dilaksanakan</label>
                            <input type="date" name="tanggal" value="{{ $pengajian->tanggal }}" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Jenis Pengajian</label>
                            <select class="form-select" name="jenis" id="inputGroupSelect01">
                                <option value="Muslim & muslimah" {{ $pengajian -> jenis == 'muslim & muslimah' ? 'selected' : '' }}>Muslim & muslimah</option>
                                <option value="Muslimah" {{ $pengajian -> jenis == 'muslimah' ? 'selected' : '' }}>Muslimah</option>
                                <option value="Kuliah subuh" {{ $pengajian -> jenis == 'kuliah subuh' ? 'selected' : '' }}>Kuliah subuh</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal edit -->
    @empty
    <tr>
        <td colspan="5" class="text-center">Data tidak tersedia</td>
    </tr>
    @endforelse

    <div class="d-flex justify-content-center my-1">
        {{ $dataPengajian->links() }}
    </div>

    <!-- modal untuk input -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Masukan Data Pengajian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('pengajian.input')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tema Pengajian</label>
                            <input type="text" name="tema" class="form-control" id="exampleFormControlailInput1" placeholder="Masukkan Tema Pengajian">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Penceramah</label>
                            <input type="text" name="penceramah" class="form-control" id="exampleFormControlInput1" placeholder="Masukan Nama Penceramah">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Jam dilaksanakan </label>
                            <input type="time" name="waktu" class="form-control" placeholder="Masukan jam " lang="en-GB">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tanggal Dilaksanakan</label>
                            <input type="date" name="tanggal" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Jenis Pengajian</label>
                            <select class="form-select" name="jenis" id="inputGroupSelect01">
                                <option selected>Pilih..</option>
                                <option value="Muslim & muslimah">Muslim & muslimah</option>
                                <option value="Muslimah">Muslimah</option>
                                <option value="Kuliah subuh">Kuliah subuh</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- emd modal input -->
</div>
@endsection