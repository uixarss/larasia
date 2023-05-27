@extends('layouts.joliadmintop')

@section('content')

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap push-up-10">
  <!-- START Content -->
  <div class="row">
    <div class="col-md-12">
      <!-- Jumbutorn -->
      <div class="jumbotron jumbotron-fluid">
        <div class="container conent-home text-center">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{asset('admin/img/Rectangle-1.png')}}" class="d-block w-100" alt="background1">
              </div>
              <div class="carousel-item">
                <img src="{{asset('admin/img/Rectangle-2.jpg')}}" class="d-block w-100" alt="background1">
              </div>
              <div class="carousel-item">
                <img src="{{asset('admin/img/Rectangle-3.jpg')}}" class="d-block w-100" alt="background1">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
      <!-- Akhir Jumbutorn -->
    </div>
  </div>
  <!-- Berita Kampus -->
  <div class="row" style="margin: 5vh 1vh;">
    <div class="col-xs-12 col-md-12 col-lg-12">
      <div class="container conent-home">
        <div class="row">
          <div class="col-xs-3 col-md-3 col-lg-3">
            <h2>Berita Kampus</h2>
            <p>Berita terbaru mengenai kampus.</p>
          </div>
          <div class="col-xs-3 col-md-3 col-lg-3">
            <div class="card" style="display:inline-block; width: 100%;">
              <img src="{{asset('admin/img/berita-6.jpg')}}" class="card-img-top" alt="berita">
              <div class="card-body">
                <h5 class="card-title">Perpustakaan Menerima Donasi Buku</h5>
                <p class="card-text">Perpustakaan Kampus ABCD menerima donasi buku dari pemerintah.</p>
                <a href="#" class="btn btn-primary">Selengkapnya</a>
              </div>
            </div>
          </div>
          <div class="col-xs-3 col-md-3 col-lg-3">
            <div class="card" style="display:inline-block; width: 100%;">
              <img src="{{asset('admin/img/berita-5.jpg')}}" class="card-img-top" alt="berita">
              <div class="card-body">
                <h5 class="card-title">Pemberitahuan Penutupan Kampus</h5>
                <p class="card-text">Dikarenakan COVID-19, maka dengan berat hati kami harus menutup kampus.</p>
                <a href="#" class="btn btn-primary">Selengkapnya</a>
              </div>
            </div>
          </div>
          <div class="col-xs-3 col-md-3 col-lg-3">
            <div class="card" style="display:inline-block; width: 100%;">
              <img src="{{asset('admin/img/berita-4.jpg')}}" class="card-img-top" alt="berita">
              <div class="card-body">
                <h5 class="card-title">Mahasiswa Belajar Secara Daring</h5>
                <p class="card-text">Selama masa penutupan kampus, mahasiswa akan melanjutkan pembelajarannya secara daring.</p>
                <a href="#" class="btn btn-primary">Selengkapnya</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Berita Kampus -->
  <!-- Pendidikan Kampus -->
  <div class="row">
    <div class="col-xs-12 col-md-12 col-lg-12">
      <div class="jumbotron jumbotron-fluid">
        <div class="container conent-home">
          <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-4">
              <div class="card" style="display:inline-block; width: 25rem;">
                <img src="{{asset('admin/img/pendidikan-1.png')}}" class="card-img-top" alt="berita">
              </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-8" style="padding-top: 10vh;">
              <h2>Pendidikan Kampus</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
              Viverra eu diam molestie non arcu.
              Morbi pellentesque platea velit neque.
              Fringilla cursus enim commodo scelerisque tortor.
              Suspendisse faucibus lacus in semper.
              </p>
              <a href="" type="button" class="btn-orange" style="margin:0;">Selengkapnya</a>
            </div>
          </div>
          <div class="row" style="margin-top: 5vh;">
            <div class="col-xs-12 col-md-12 col-lg-12">
              <div class="row">
                <div class="col-xs-12 col-md-12 col-lg-3">
                  <div class="card" style="width: 100%;">
                    <div class="card-body">
                      <h5 class="card-title">Program Sarjana</h5>
                      <p class="card-text">Program Sarjana 4 tahun dengan program praktik dan KKN di luar kampus untuk memperdalam softskill.</p>
                      <a href="#" class="card-link" style="margin:0; color:#f16734;">Baca Selengkapnya →</a>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-md-12 col-lg-3">
                  <div class="card" style="width: 100%;">
                    <div class="card-body">
                      <h5 class="card-title">Program Pascasarjana</h5>
                      <p class="card-text">Program Pascasarjana dengan Akreditasi A dan berada pada peringkat 1000 besar sedunia.</p>
                      <a href="#" class="card-link" style="margin:0; color:#f16734;">Baca Selengkapnya →</a>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-md-12 col-lg-3">
                  <div class="card" style="width: 100%;">
                    <div class="card-body">
                      <h5 class="card-title">Program Sekolah Vokasi</h5>
                      <p class="card-text">Berbagai pilihan jurusan untuk Sekolah Vokasi selama 3 atau 4 tahun. Cari tahu lebih banyak disini!</p>
                      <a href="#" class="card-link" style="margin:0; color:#f16734;">Baca Selengkapnya →</a>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-md-12 col-lg-3">
                  <div class="card" style="width: 100%;">
                    <div class="card-body">
                      <h5 class="card-title">Program Profesi</h5>
                      <p class="card-text">Program Profesi yang ditujukan untuk para profesional yang ingin mendapatkan sertifikasi profesi.</p>
                      <a href="#" class="card-link" style="margin:0; color:#f16734;">Baca Selengkapnya →</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Pendidikan Kampus -->
  <!-- Tentang Kampus -->
  <div class="row" style="background-color: #fff">
    <div class="col-xs-12 col-md-12 col-lg-12">
      <div class="row">
        <div class="col-xs-6 col-md-6 col-lg-6">
          <div id="img-besar">
            <img src="{{asset('admin/img/image-besar.png')}}" alt="tentang">
            <div class="overlay">
              <h3>Tentang Kampus</h3>
              <p>Pelopor perguruan tinggi berkelas dunia yang unggul dan inovatif, mengabdi kepada kepentingan bangsa dan kemanusiaan.</p>
              <a href="">LEBIH LANJUT</a>
            </div>
          </div>
        </div>
        <div class="col-xs-6 col-md-6 col-lg-6">
          <div class="row">
            <div class="col-xs-6 col-md-6 col-lg-6">
              <div id="box-pendidikan">
                <h3>Pendidikan</h3>
                <p>Membangun pendidikan berkualitas internasional dan membawa perubahan yang lebih baik terhadap bangsa dan negara.</p>
                <a href="">LEBIH LANJUT</a>
              </div>
            </div>
            <div class="col-xs-6 col-md-6 col-lg-6">
                <div id="pendidikan">
                  <img src="{{asset('admin/img/image-kecil.png')}}" alt="tentang">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6 col-md-6 col-lg-6">
              <div id="mahasiswa">
                <img src="{{asset('admin/img/image-kecil2.png')}}" alt="tentang">
              </div>
            </div>
            <div class="col-xs-6 col-md-6 col-lg-6">
              <div id="box-mahasiswa">
                <h3>Mahasiswa</h3>
                <p>Mencetak mahasiswa berwawasan global dan berintegritas yang dilandasi nilai-nilai Pancasila.</p>
                <a href="">LEBIH LANJUT</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Tentang Kampus -->
  <!-- Agenda Kampus -->
  <div class="row">
    <div class="col-xs-12 col-md-12 col-lg-12">
      <div class="jumbotron jumbotron-fluid">
        <div class="row">
          <div id="agenda" class="col-xs-12 col-md-12 col-lg-12">
            <h2>Agenda Kampus</h2><br>
            <a href="" type="button" class="btn-orange" style="margin:0;">Lihat Agenda</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Agenda Kampus -->
  <!-- Footer -->
  <div class="footer">
    <div class="row">
      <div class="col-xs-3 col-md-3 col-lg-3">
        <p>Kedawung, Cirebon 45456</p>
        <p>Email: kampus@kampus.ac.id</p>
        <p>Tel: 0231-123456789</p>
      </div>
      <div class="col-xs-3 col-md-3 col-lg-3">
        <p>KERJA SAMA</p>
        <p>KERJA SAMA DALAM NEGERI</p>
        <p>ALUMNI</p>
        <p>URUSAN LUAR NEGERI</p>
      </div>
      <div class="col-xs-3 col-md-3 col-lg-3">
        <p>TENTANG KAMPUS</p>
        <p>SAMBUTAN REKTOR</p>
        <p>VISI DAN MISI</p>
        <p>MANAJEMEN</p>
      </div>
      <div class="col-xs-3 col-md-3 col-lg-3">
        <p>PENDIDIKAN</p>
        <p>PASCASARJANA</p>
        <p>SARJANA</p>
        <p>DIPLOMA</p>
      </div>
    </div>
  </div>
  <!-- END Footer -->
</div>

<!-- END PAGE CONTENT WRAPPER -->

@stop