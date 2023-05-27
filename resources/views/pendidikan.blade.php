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
                        <div id="page-pendidikan">
                            <h2>Pendidikan</h2>
                            <p>Kampus menyelenggarakan berbagai program pendidikan meliputi program sarjana, pascasarjana, profesi, spesialis, dan diploma.
                                Beberapa fakultas juga menyelenggarakan program internasional baik pada program sarjana maupun pascasarjana.</p>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-6 col-lg-6" style="padding:0;">
                        <img src="{{asset('admin/img/pendidikan-2.png')}}" alt="pendidikan"s>
                    </div>
                </div>
            </div>
        <!-- Akhir Jumbutorn -->
        </div>
    </div>
    <!-- Fakultas dan Sekolah -->
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="jumbotron jumbotron-fluid">
                <div class="container conent-home">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="row" style="margin-bottom: 5vh;">
                                <div class="col-xs-12 col-md-12 col-lg-6">
                                    <h2 style="font-size: 40px; font-weight: 600">Fakultas dan Sekolah</h2>
                                    <p style="font-size: 18px; font-weight: 500">Kampus menyelenggarakan berbagai program pendidikan meliputi program sarjana, pascasarjana, profesi, spesialis, dan diploma.
                                    Beberapa fakultas juga menyelenggarakan program internasional baik pada program sarjana maupun pascasarjana.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Bagian Foto -->
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <img src="{{asset('admin/img/fakultas-1.png')}}" alt="fakultas">
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <img src="{{asset('admin/img/fakultas-2.png')}}" alt="fakultas">
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <img src="{{asset('admin/img/fakultas-3.png')}}" alt="fakultas">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <img src="{{asset('admin/img/fakultas-4.png')}}" alt="fakultas">
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <img src="{{asset('admin/img/fakultas-5.png')}}" alt="fakultas">
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <img src="{{asset('admin/img/fakultas-6.png')}}" alt="fakultas">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <img src="{{asset('admin/img/fakultas-7.png')}}" alt="fakultas">
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <img src="{{asset('admin/img/fakultas-8.png')}}" alt="fakultas">
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <img src="{{asset('admin/img/fakultas-9.png')}}" alt="fakultas">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
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