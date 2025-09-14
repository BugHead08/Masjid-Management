<footer class="footer bg-dark text-white py-4">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-2">
        <img src="{{asset('img/favicon.png')}}" class="footer-logo" alt="logo-masjid" srcset="">
      </div>
      <div class="col-lg-4 mb-2">
        <h5>Masjid AL-IKHLAS</h5>
        <p class="mb-0">Jl. Raya Perum Serdang Asri 1, Citra Raya,</p>
        <p class="mb-0">Tangerang</p>
        <p class="mb-0">Telp: 0813 15425 368</p>
        <p class="mb-0">Email: info@masjidalfalah.com</p>
      </div>
      <div class="col-md-3 ">
        <h5>Keuangan & Kegiatan</h5>
        <ul class="list-unstyled">
          <li class="mb-0"><a href="{{route('guest.keuangan.index')}}" class="text-white text-decoration-none">Keuangan</a></li>
          <li class="mb-0"><a href="{{route('kegiatan')}}" class="text-white text-decoration-none">Pengajian</a></li>
          <li class="mb-0"><a href="{{route('imamkhotib')}}" class="text-white text-decoration-none">Imam & Khatib</a></li>
        </ul>
      </div>
      <div class="col-md-2 mb-4">
        <h5>Donasi</h5>
        <p>BNI: 0000000 a.n. Masjid </p>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 mb-4 mb-md-0 mt-4 text-md-start">
      <small>&copy; 2024 Masjid Management. All rights reserved.</small>
    </div>
  </div>
</footer>