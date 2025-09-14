<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container">
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-3 my-auto logo-text ">
          <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{asset('img/favicon.png')}}" class="footer-logo" alt="logo-masjid" style="height: 50px; width: 50px;">
          Masjid Al-Ikhlas</a>
        </div>
      </div>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse navbar-light bg-light" id="navbarNav">
      <ul class="navbar-nav ms-auto p-2">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{route('home')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('guest.keuangan.index')}}">Keuangan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('kegiatan')}}">Kegiatan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('imamkhotib')}}">Imam & khotib</a>
        </li>
      </ul>
    </div>
  </div>
</nav>