@extends('layouts.joliadmintop')

@section('content')

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap push-up-10">
  <!-- START Content -->
  <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
    <!-- Jumbutorn -->
      <div class="jumbotron jumbotron-fluid">
        <div class="row">
          <div class="col-xs-6 col-md-6 col-lg-6" style="padding:0;">
            <div id="page-kampus">
              <h2>Tentang Kampus</h2>
              <p>Kampus memiliki jati diri sebagai universitas nasional, universitas perjuangan, universitas pancasila, universitas kerakyatan, dan universitas pusat kebudayaan.</p>
            </div>
          </div>
          <div class="col-xs-6 col-md-6 col-lg-6" style="padding:0;">
            <img src="{{asset('admin/img/tentang2.png')}}" alt="pendidikan"s>
          </div>
        </div>
      </div>
    <!-- Akhir Jumbutorn -->
    </div>
  </div>
  <!-- Sejarah Kampus -->
  <div class="row" style="margin: 5vh 1vh;">
    <div class="col-xs-12 col-md-12 col-lg-12">
      <div class="container conent-home">
        <div class="row">
          <div class="col-xs-6 col-md-6 col-lg-6">
            <img src="{{asset('admin/img/sejarah.png')}}" class="card-img-top" alt="berita">
          </div>
          <div class="col-xs-6 col-md-6 col-lg-6">
            <h2 style="font-size: 40px">Sejarah Kampus</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Sejarah Kampus -->
  <!-- Sambutan Rektor -->
  <div class="row" style="margin: 5vh 1vh;">
    <div class="col-xs-12 col-md-12 col-lg-12">
      <div class="jumbotron jumbotron-fluid">
        <div class="container conent-home">
          <div class="row">
            <div class="col-xs-3 col-md-3 col-lg-3">
              <img src="{{asset('admin/img/avatar.png')}}" class="card-img-top" alt="berita">
            </div>
            <div class="col-xs-9 col-md-9 col-lg-9">
              <h2>Sambutan Rektor</h2>
              <h1>Prof. Ir. Omar Lipshutz. M.M</h1>
              <p>“Sejalan dengan program internasionalnya, mahasiswa asing di UGM juga semakin banyak.”</p>
              <a href="#" style="margin:0px; color:#F16734;" >Baca Selengkapnya</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Sambutan Rektor -->
  <!-- Statistik -->
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="jumbotron jumbotron-fluid">
                <div class="container conent-home">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="row" style="margin-bottom: 5vh;">
                                <div class="col-xs-12 col-md-12 col-lg-8">
                                    <h2 style="font-size: 40px; font-weight: 600">Statistik Kampus</h2>
                                    <p style="font-size: 18px; font-weight: 500">Kampus termasuk sebagai universitas yang tertua di Indonesia yang juga berperan sebagai pengemban Pancasila dan sebagai universitas pembina di Indonesia.</p>
                                </div>
                                <div class="col-xs-12 col-md-12 col-lg-4">
                                  <img src="{{asset('admin/img/statistik-kampus.png')}}" alt="statistik">
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 5vh;">
                                <div class="col-xs-12 col-md-12 col-lg-8">
                                  <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-6">  
                                      <h2 style="font-size: 32px; font-weight: 500">2900</h2>
                                      <p style="font-size: 14px; font-weight: 300">Pencapaian Mahasiswa</p>
                                    </div>
                                    <div class="col-xs-12 col-md-12 col-lg-6">  
                                      <h2 style="font-size: 32px; font-weight: 500">100</h2>
                                      <p style="font-size: 14px; font-weight: 300">Profesor</p>
                                    </div>
                                    <div class="col-xs-12 col-md-12 col-lg-6">  
                                      <h2 style="font-size: 32px; font-weight: 500">1000+</h2>
                                      <p style="font-size: 14px; font-weight: 300">Jurnal Publikasi</p>
                                    </div>
                                    <div class="col-xs-12 col-md-12 col-lg-6">  
                                      <h2 style="font-size: 32px; font-weight: 500">512</h2>
                                      <p style="font-size: 14px; font-weight: 300">Dosen Pengajar</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xs-12 col-md-12 col-lg-4">
                                  <div class="row" style="margin-bottom: 15px;">
                                    <div class="col-xs-12 col-md-12 col-lg-1">
                                      <img src="{{asset('admin/img/orange.png')}}" alt="orange">
                                    </div>
                                    <div class="col-xs-12 col-md-12 col-lg-6">
                                      <p><b>Sarjana</b></p>
                                    </div>
                                    <div class="col-xs-12 col-md-12 col-lg-5">
                                      <p><b>60%</b></p>
                                    </div>
                                  </div>
                                  <div class="row" style="margin-bottom: 15px;">
                                    <div class="col-xs-12 col-md-12 col-lg-1">
                                      <img src="{{asset('admin/img/navy.png')}}" alt="navy">
                                    </div>
                                    <div class="col-xs-12 col-md-12 col-lg-6">
                                      <p><b>Pascasarjana</b></p>
                                    </div>
                                    <div class="col-xs-12 col-md-12 col-lg-5">
                                      <p><b>22%</b></p>
                                    </div>
                                  </div>
                                  <div class="row" style="margin-bottom: 15px;">
                                    <div class="col-xs-12 col-md-12 col-lg-1">
                                      <img src="{{asset('admin/img/yellow.png')}}" alt="yellow">
                                    </div>
                                    <div class="col-xs-12 col-md-12 col-lg-6">
                                      <p><b>Diploma</b></p>
                                    </div>
                                    <div class="col-xs-12 col-md-12 col-lg-5">
                                      <p><b>18%</b></p>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <!-- Bagian Statistik Kampus -->
                    <div class="row">
                      <ul class="statistik">
                        <li class="statistik-kampus">
                          <h3>Fakultas</h3>
                          <span>5</span>
                        </li>
                        <li class="statistik-kampus">
                          <h3>Program Studi</h3>
                          <span>25</span>
                        </li>
                        <li class="statistik-kampus">
                          <h3>Join Degree</h3>
                          <span>5</span>
                        </li>
                        <li class="statistik-kampus">
                          <h3>Pusat Studi</h3>
                          <span>3</span>
                        </li>
                      </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!-- Akhir Statistik -->
  <!-- Peta Kampus -->
  <div class="row" style="margin: 5vh 1vh;">
    <div class="col-xs-12 col-md-12 col-lg-12">
      <div class="container conent-home">
        <div class="row">
          <div class="col-xs-12 col-md-12 col-lg-12">
            <h2 style="font-size: 40px; margin-bottom:10px;">Peta Kampus</h2>
          </div>
          <div class="col-xs-12 col-md-12 col-lg-12">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63245.98363572676!2d110.33982523941266!3d-7.803163972561892!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5787bd5b6bc5%3A0x21723fd4d3684f71!2sYogyakarta%2C%20Yogyakarta%20City%2C%20Special%20Region%20of%20Yogyakarta!5e0!3m2!1sen!2sid!4v1610330927888!5m2!1sen!2sid" width="100%" height="600" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Peta Kampus -->
    
  <!-- END Content -->
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
<!-- <div class="footer">
  <div class="footer-copyright text-center" style="background-color:#0d134d color:#ffffff;">
    Made by CV Akses Digital
  </div>
</div> -->
@stop