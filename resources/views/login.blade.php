<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login|Masjid</title>
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container ">
        <div class="card mx-auto shadow" style="width: 500px; margin-top:100px;">
            <div class="text-login text-center mx-auto p-1" >
                <h1 class="p-3 fs-4">Selamat Datang di Sistem Manajemen Masjid Al-Ikhlas</h1>
                <p class="lead p-1">Masuk untuk mengelola keuangan, jadwal kegiatan, serta informasi imam dan khotib dengan mudah dan terstruktur</p>
            </div>
            <div class="logo mx-auto">
                <img src="{{asset('img/favicon.png')}}" class=" text-center" alt="logo-masjid" style="height:150px; width: 150px;">
            </div>
            @if($errors -> any())
            <div class="alert alert-danger mx-auto" style="width: 400px;">
                <ul>
                    @foreach($errors->all() as $item)
                    <li>{{$item}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{route('login.auth')}}" method="post" class="p-3">
                @csrf
                <div class="mb-3 ">
                    <label for="exampleInputEmail1" class="form-label ">Email :</label>
                    <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3 ">
                    <label for="exampleInputPassword1" class="form-label">Password : </label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>