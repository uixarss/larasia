@extends('layouts.joliadmin-top')

@section('css-add')
<link type="stylesheet" src="{{asset('admin/js/datatables/datatables.min.css')}}"/>
<link type="stylesheet" src="{{asset('admin/js/datatables/dataTables.bootstrap4.min.css')}}"/>
@endsection
@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
  <li><span class="fa fa-book"></span><a href="{{ route('perpustakaan.databuku.index') }}"> Data Buku</a></li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
  <h3><span class="fa fa-book"></span> Data Buku</h3>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap push-up-10">
  <!-- START Kontent -->
  <div class="row">
    <div class="col-md-12">

      <!-- START TABS -->
      <div class="panel panel-default tabs">
        <ul class="nav nav-tabs" role="tablist">
          <li class="active"><a href="#tab-listbuku" role="tab" data-toggle="tab">Data List Buku</a></li>
          <li><a href="#tab-ebook" role="tab" data-toggle="tab">Data List E-Book</a></li>
          <li><a href="#tab-review" role="tab" data-toggle="tab">Review E-Book</a></li>
          <li><a href="#tab-listkategori" role="tab" data-toggle="tab">Data List Kategori</a></li>
          <li><a href="#tab-listdistributor" role="tab" data-toggle="tab">Data List Distributor</a></li>
        </ul>
        <div class="panel-body tab-content">

          <div class="tab-pane active" id="tab-listbuku">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Data List Buku</h3>
                <ul class="panel-controls">
                  <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                  <li><a class="" data-toggle="modal" data-target="#tambahDataBuku"><span class="fa fa-plus-circle"></span></a></li>
                </ul>
              </div>
              <div class="panel-body">
                <table class="table buku-table" id="buku-table">
                  <thead>
                    <tr>
                      <th width="120">Kategori</th>
                      <th width="130">ISBN</th>
                      <th>Judul Buku</th>
                      <th width="120">Penulis</th>
                      <th width="120">Penerbit</th>
                      <th width="100">Stok</th>
                      <th width="250">Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data_buku as $no => $buku)


                    <!-- MODAL EDIT DATA KATEGORI-->
                    <div class="modal fade" id="editDataBuku{{$buku->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title" id="staticBackdropLabel">Edit Data Buku</h5>
                          </div>
                        </td>

                        @php

                          $peminjaman = '1';
                          $pengembalian = '0';

                          $jmlh_peminjaman = App\Models\DataPeminjamanBuku::where('data_buku_id', $buku->id)
                          ->where('status', $peminjaman)
                          ->sum('jumlah');

                          $jmlh_pengembalian = App\Models\DataPeminjamanBuku::where('data_buku_id', $buku->id)
                          ->where('status', $peminjaman)
                          ->sum('jumlah');


                          $stok_peminjaman = $buku->stok_buku - $jmlh_peminjaman;

                          $jumlah_stok = $stok_peminjaman;

                        @endphp

                        <td><span class="badge badge-info"> <strong>{{$jumlah_stok}} Buku</strong></span></td>

                        <td>
                          <form action="{{route('perpustakaan.databuku.destroy', $buku->id )}}" method="post">
                            {{ csrf_field() }}
                            @method('delete')
                            <a href="{{route('perpustakaan.databuku.show', $buku->ISBN )}}" class="btn btn-info">Pendistributor</a>
                            <a class="btn btn-success" data-toggle="modal" data-target="#editDataBuku{{$buku->id}}">Edit</a>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                          </form>
                        </td>
                      </tr>

                      <!-- MODAL EDIT DATA KATEGORI-->
                      <div class="modal fade" id="editDataBuku{{$buku->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <h5 class="modal-title" id="staticBackdropLabel">Edit Data Buku</h5>
                            </div>
                            <div class="modal-body">

                              <form action="{{route('perpustakaan.databuku.update', $buku->id )}}" method="post">
                                {{csrf_field()}}
                                @method('put')
                                <div class="row">

                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="ISBN">ISBN</label>
                                      <input name="ISBN" type="text" class="form-control" value="{{$buku->ISBN}}" placeholder="Masukan ISBN">
                                    </div>
                                  </div>

                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="judul_buku">Judul Buku</label>
                                      <input name="judul_buku" type="text" class="form-control" value="{{$buku->judul_buku}}" placeholder="Masukan Judul Buku">
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="judul_buku">Judul Buku</label>
                                    <input name="judul_buku" type="text" class="form-control" value="{{$buku->judul_buku}}" placeholder="Masukan Judul Buku">
                                  </div>
                                </div>


                                <div class="col-md-4 push-down-15">
                                  <div class="form-group">
                                    <label for="kategori_id">Kategori</label>
                                    <select name="kategori_id" class="form-control select" data-live-search="true" required>
                                      <option>-Masukan Kategori Buku-</option>
                                      @foreach($data_kategori as $kategori)
                                      @if($kategori->id == $buku->kategori_buku_id)
                                      <option value="{{$kategori->id}}" selected>{{$kategori->nama_kategori}}</option>
                                      @else
                                      <option value="{{$kategori->id}}">{{$kategori->nama_kategori}}</option>
                                      @endif
                                      @endforeach
                                    </select>
                                  </div>
                                </div>


                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="penulis">Penulis</label>
                                    <input name="penulis" type="text" class="form-control" value="{{$buku->penulis}}" placeholder="Masukan Penulis Buku">
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="penerbit">Penerbit</label>
                                    <input name="penerbit" type="text" class="form-control" value="{{$buku->penerbit}}" placeholder="Masukan Penulis Buku">
                                  </div>
                                </div>

                                <div class="col-md-12 push-up-15">
                                  <div class="form-group">
                                    <label for="tanggal_terbit">Tanggal Terbit</label>
                                    <input name="tanggal_terbit" type="date" class="form-control" value="{{$buku->tanggal_terbit}}" placeholder="Masukan Tanggal Terbit">
                                  </div>
                                </div>

                                <div class="col-md-12 push-up-15">
                                  <div class="form-group">
                                    <label for="deskripsi_buku">Deskripsi Buku</label>
                                    <textarea name="deskripsi_buku" class="form-control" rows="3">{{$buku->deskripsi}} </textarea>
                                  </div>
                                </div>
                                <br>

                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
                            </form>


                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- END MODAL EDIT DATA KATEGORI -->

                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <!-- END DEFAULT DATATABLE -->
          </div>

          <div class="tab-pane" id="tab-ebook">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Data List E-Book</h3>
                <ul class="panel-controls">
                  <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                  <li><a class="" data-toggle="modal" data-target="#tambahDataEBook"><span class="fa fa-plus-circle"></span></a></li>
                </ul>
              </div>
              <div class="panel-body">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th width="100">No</th>
                      <th width="120">Kategori</th>
                      <th width="130">ISBN</th>
                      <th>Judul Buku</th>
                      <th>Penulis</th>
                      <th width="120">Penerbit</th>
                      <th width="120">Nama File</th>
                      <th width="120">Download</th>
                      <th width="120">Status</th>
                      <th width="200">Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data_ebook as $no => $buku)
                    <tr>
                      <td>{{++$no}}</td>
                      <td>{{$buku->kategori_ebook->nama_kategori}}</td>
                      <td>{{$buku->ISBN}}</td>
                      <td>{{$buku->judul_ebook}}</td>
                      <td>{{$buku->penulis}}</td>
                      <td>{{$buku->penerbit}}</td>
                      <td><span class="badge badge-info"> <strong>{{$buku->file_ebook}}</strong></span></td>

                      @php
                      $path = Storage::url('public/ebook/' . $buku->file_ebook);

                      $user = Illuminate\Support\Facades\Auth::id();


                      $jumlah_download = App\Models\DownloadEBook::where('id_ebook', $buku->id)->count();

                      @endphp

                      <td><span class="badge badge-info"> <strong>{{$jumlah_download}} Download</strong></span></td>
                      <td>@if($buku->status ==0)
                        <span class="badge badge-danger">Belum Review</span>
                        @else
                        <span class="badge badge-primary">Publish</span>
                        @endif
                      </td>

                      <td>
                        <form action="{{route('perpustakaan.databuku.destroyEBook', $buku->id )}}" method="post">
                          {{ csrf_field() }}
                          @method('delete')
                          <a href="{{route('unduh.ebook', [ 'path_ebook' => $path , 'user_id' => $user, 'id' => $buku->id ] )}}" class="btn btn-info btn-sm" target="_blank">Download File</a>
                          <a class="btn btn-success" data-toggle="modal" data-target="#editDataEBook{{$buku->id}}">Edit</a>
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                        </form>
                      </td>
                    </tr>

                    <!-- MODAL EDIT DATA KATEGORI-->
                    <div class="modal fade" id="editDataEBook{{$buku->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title" id="staticBackdropLabel">Edit Data E-Book</h5>
                          </div>
                          <div class="modal-body">

                            <form action="{{route('perpustakaan.databuku.updateEBook', $buku->id )}}" method="post" enctype="multipart/form-data">
                              {{csrf_field()}}
                              @method('put')
                              <div class="row">

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="ISBN">ISBN</label>
                                    <input name="ISBN" type="text" class="form-control" value="{{$buku->ISBN}}" placeholder="Masukan ISBN">
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="judul_buku">Judul Buku</label>
                                    <input name="judul_buku" type="text" class="form-control" value="{{$buku->judul_ebook}}" placeholder="Masukan Judul E-Book">
                                  </div>
                                </div>


                                <div class="col-md-4 push-down-15">
                                  <div class="form-group">
                                    <label for="kategori_id">Kategori</label>
                                    <select name="kategori_id" class="form-control" data-live-search="true" required>
                                      @foreach($data_kategori as $kategori)
                                      @if($kategori->id == $buku->kategori_ebook_id)
                                      <option value="{{$kategori->id}}" selected>{{$kategori->nama_kategori}}</option>
                                      @else
                                      <option value="{{$kategori->id}}">{{$kategori->nama_kategori}}</option>
                                      @endif
                                      @endforeach
                                    </select>
                                  </div>
                                </div>


                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="penulis">Penulis</label>
                                    <input name="penulis" type="text" class="form-control" value="{{$buku->penulis}}" placeholder="Masukan Penulis Buku">
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="penerbit">Penerbit</label>
                                    <input name="penerbit" type="text" class="form-control" value="{{$buku->penerbit}}" placeholder="Masukan Penulis Buku">
                                  </div>
                                </div>

                                <div class="col-md-12 push-up-15">
                                  <div class="form-group">
                                    <label for="tanggal_terbit">Tanggal Terbit</label>
                                    <input name="tanggal_terbit" type="date" class="form-control" value="{{$buku->tanggal_terbit}}" placeholder="Masukan Tanggal Terbit">
                                  </div>
                                </div>

                                <div class="col-md-12 push-up-15">
                                  <div class="form-group">
                                    <label for="deskripsi_buku">Deskripsi Buku</label>
                                    <textarea name="deskripsi_buku" class="form-control" rows="3">{{$buku->deskripsi}} </textarea>
                                  </div>
                                </div>

                                <div class="col-md-12 push-up-15">
                                  <div class="form-group">
                                    <label>Unggah E-Book</label><br />
                                    <input type="file" name="file_ebook" id="file_ebook" />
                                  </div>
                                </div>

                                <div class="col-md-12 push-up-15">
                                  <div class="form-group">
                                    <label for="kategori_id">Status</label>
                                    <select name="status" class="form-control" data-live-search="true" required>
                                      <option value="0" {{$buku->status == 0 ? 'selected':''}}>Belum Review</option>
                                      <option value="1" {{$buku->status == 1 ? 'selected':''}}>Publish</option>
                                    </select>
                                  </div>
                                </div>

                                <br>

                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
                            </form>


                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- END MODAL EDIT DATA KATEGORI -->

                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <!-- END DEFAULT DATATABLE -->
          </div>

          <div class="tab-pane" id="tab-review">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Data Review E-Book</h3>
                <ul class="panel-controls">
                  <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                </ul>
              </div>
              <div class="panel-body">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th width="100">No</th>
                      <th width="120">Kategori</th>
                      <th width="130">ISBN</th>
                      <th>Judul Buku</th>
                      <th>Penulis</th>
                      <th width="120">Penerbit</th>
                      <th width="120">Nama File</th>
                      <th width="120">Download</th>
                      <th width="200">Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data_review as $no => $buku)
                    <tr>
                      <td>{{++$no}}</td>
                      <td>{{$buku->kategori_ebook->nama_kategori}}</td>
                      <td>{{$buku->ISBN}}</td>
                      <td>{{$buku->judul_ebook}}</td>
                      <td>{{$buku->penulis}}</td>
                      <td>{{$buku->penerbit}}</td>
                      <td><span class="badge badge-info"> <strong>{{$buku->file_ebook}}</strong></span></td>

                      @php
                      $path = Storage::url('public/ebook/' . $buku->file_ebook);

                      $user = Illuminate\Support\Facades\Auth::id();


                      $jumlah_download = App\Models\DownloadEBook::where('id_ebook', $buku->id)->count();

                      @endphp

                      <td><span class="badge badge-info"> <strong>{{$jumlah_download}} Download</strong></span></td>

                      <td>
                        <a href="{{route('unduh.ebook', [ 'path_ebook' => $path , 'user_id' => $user, 'id' => $buku->id ] )}}" class="btn btn-info btn-sm" target="_blank">Download File</a>
                        <a href="{{route('perpustakaan.databuku.publish', ['id' => $buku->id])}}" class="btn btn-success btn-sm">Publish</a>
                      </td>
                    </tr>


                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <!-- END DEFAULT DATATABLE -->
          </div>

          <div class="tab-pane" id="tab-listkategori">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Data List Kategori</h3>
                <ul class="panel-controls">
                  <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                  <li><a class="" data-toggle="modal" data-target="#tambahDataKategori"><span class="fa fa-plus-circle"></span></a></li>
                </ul>
              </div>
              <div class="panel-body">
                <table class="table kategori-table" id="kategori-table">
                  <thead>
                    <tr>

                      <th width="120">Kode Kategori</th>
                      <th width="120">Nama Kategori</th>
                      <th width="250">Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data_kategori as $no => $kategori)


                    <!-- MODAL EDIT DATA KATEGORI-->
                    <div class="modal fade" id="editKategori{{$kategori->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title" id="staticBackdropLabel">Edit Data Kategori</h5>
                          </div>
                          <div class="modal-body">

                            <form action="{{route('perpustakaan.databuku.datakategori.update', $kategori->id )}}" method="post">
                              @csrf
                              <div class="row">

                                <div class="form-group col-md-6">
                                  <label for="kode_kategori">Kode Kategori</label>
                                  <input name="kode_kategori" type="text" class="form-control" value="{{$kategori->kode_kategori}}" placeholder="Masukan Kode Kategori Buku">
                                </div>

                                <div class="form-group col-md-6">
                                  <label for="nama_kategori">Nama Kategori</label>
                                  <input name="nama_kategori" type="text" class="form-control" value="{{$kategori->nama_kategori}}" placeholder="Masukan Nama Kategori Buku">
                                </div><br>

                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
                            </form>


                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- END MODAL EDIT DATA KATEGORI -->

                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <!-- END DEFAULT DATATABLE -->

          </div>

          <div class="tab-pane" id="tab-listdistributor">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Data List Distributor</h3>
                <ul class="panel-controls">
                  <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                  <li><a class="" data-toggle="modal" data-target="#tambahDataDistributor"><span class="fa fa-plus-circle"></span></a></li>
                </ul>
              </div>
              <div class="panel-body">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Distributor</th>
                      <th>Nama Distributor</th>
                      <th>Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data_distributor as $no => $distributor)
                    <tr>
                      <td>{{++$no}}</td>
                      <td>{{$distributor->kode_distributor}}</td>
                      <td>{{$distributor->nama_distributor}}</td>
                      <td>
                        <a class="btn btn-success" data-toggle="modal" data-target="#editDistributor{{$distributor->id}}">Edit</a>

                        <a href="{{route('perpustakaan.databuku.datadistributor.delete', $distributor->id )}}" class="btn btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>
                      </td>
                    </tr>

                    <!-- MODAL EDIT DATA KATEGORI-->
                    <div class="modal fade" id="editDistributor{{$distributor->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title" id="staticBackdropLabel">Edit Data Distributor</h5>
                          </div>
                          <div class="modal-body">

                            <form action="{{route('perpustakaan.databuku.datadistributor.update', $distributor->id )}}" method="post">
                              @csrf
                              <div class="row">

                                <div class="form-group col-md-6">
                                  <label for="kode_distributor">Kode Distributor</label>
                                  <input name="kode_distributor" type="text" class="form-control" value="{{$distributor->kode_distributor}}" placeholder="Masukan Kode Distributor Buku">
                                </div>

                                <div class="form-group col-md-6">
                                  <label for="nama_distributor">Nama Distributor</label>
                                  <input name="nama_distributor" type="text" class="form-control" value="{{$distributor->nama_distributor}}" placeholder="Masukan Nama distributor Buku">
                                </div><br>

                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
                            </form>


                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- END MODAL EDIT DATA KATEGORI -->

                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <!-- END DEFAULT DATATABLE -->

          </div>

        </div>
      </div>
      <!-- END TABS -->

    </div>
  </div>
  <!-- END Kontent -->
</div>
<!-- END PAGE CONTENT WRAPPER -->

<!-- MODAL TAMBAH DATA BUKU-->
<div class="modal fade" id="tambahDataBuku" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Buku</h5>
      </div>
      <div class="modal-body">

        <form action="{{route('perpustakaan.databuku.store')}}" method="post">
          @csrf
          <div class="row">

            <div class="col-md-4">
              <div class="form-group">
                <label for="ISBN">ISBN</label>
                <input name="ISBN" type="text" class="form-control" value="" placeholder="Masukan ISBN">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="judul_buku">Judul Buku</label>
                <input name="judul_buku" type="text" class="form-control" value="" placeholder="Masukan Judul Buku">
              </div>
            </div>

            <div class="col-md-4 push-down-15">
              <div class="form-group">
                <label for="kategori_id">Kategori</label>
                <select name="kategori_id" class="form-control" data-live-search="true" required>

                  @foreach($data_kategori as $kategori)
                  <option value="{{$kategori->id}}">{{$kategori->nama_kategori}}</option>
                  @endforeach

                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="penulis">Penulis</label>
                <input name="penulis" type="text" class="form-control" value="" placeholder="Masukan Penulis Buku">
              </div>
            </div>

            <div class="col-md-6 push-down-15">
              <div class="form-group">
                <label for="penerbit">Penerbit</label>
                <input name="penerbit" type="text" class="form-control" value="" placeholder="Masukan Penulis Buku">
              </div>
            </div>

            <div class="col-md-12 push-down-15">
              <div class="form-group">
                <label for="distributor_id">Distributor</label>
                <select name="distributor_id" class="form-control" data-live-search="true" required>

                  @foreach($data_distributor as $distributor)
                  <option value="{{$distributor->id}}">{{$distributor->nama_distributor}}</option>
                  @endforeach

                </select>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="deskripsi_buku">Deskripsi Buku</label>
                <textarea name="deskripsi_buku" class="form-control" id="exampleFormControlTextarea1" rows=""></textarea>
              </div>
            </div>


            <div class="col-md-4 push-up-15">
              <div class="form-group">
                <label for="jumlah_buku">Jumlah Buku</label>
                <input name="jumlah_buku" type="number" class="form-control" placeholder="Masukan Jumlah Buku">
              </div>
            </div>

            <div class="col-md-4 push-up-15">
              <div class="form-group">
                <label for="tanggal_terbit">Tanggal Terbit</label>
                <input name="tanggal_terbit" type="date" class="form-control" placeholder="Masukan Tanggal Terbit">
              </div>
            </div>

            <div class="col-md-4  push-up-15  push-down-15">
              <div class="form-group">
                <label for="tanggal_masuk">Tanggal Masuk Buku</label>
                <input name="tanggal_masuk" type="date" class="form-control" placeholder="Masukan Tanggal">
              </div>
            </div>

          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
        </form>


      </div>
    </div>
  </div>
</div>
<!-- END MODAL TAMBAH DATA BUKU -->

<!-- MODAL TAMBAH DATA EBOOK-->
<div class="modal fade" id="tambahDataEBook" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Data E-Book</h5>
      </div>
      <div class="modal-body">

        <form action="{{route('perpustakaan.databuku.storeEBook')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">

            <div class="col-md-4">
              <div class="form-group">
                <label for="ISBN">ISBN</label>
                <input name="ISBN" type="text" class="form-control" value="" placeholder="Masukan ISBN">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="judul_buku">Judul E-Book</label>
                <input name="judul_buku" type="text" class="form-control" value="" placeholder="Masukan E-Book Buku">
              </div>
            </div>

            <div class="col-md-4 push-down-15">
              <div class="form-group">
                <label for="kategori_id">Kategori</label>
                <select name="kategori_id" class="form-control" data-live-search="true" required>

                  @foreach($data_kategori as $kategori)
                  <option value="{{$kategori->id}}">{{$kategori->nama_kategori}}</option>
                  @endforeach

                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="penulis">Penulis</label>
                <input name="penulis" type="text" class="form-control" value="" placeholder="Masukan Penulis E-Book">
              </div>
            </div>

            <div class="col-md-6 push-down-15">
              <div class="form-group">
                <label for="penerbit">Penerbit</label>
                <input name="penerbit" type="text" class="form-control" value="" placeholder="Masukan Penerbit E-Book">
              </div>
            </div>


            <div class="col-md-12">
              <div class="form-group">
                <label for="deskripsi_buku">Deskripsi E-Book</label>
                <textarea name="deskripsi_buku" class="form-control" id="exampleFormControlTextarea1" rows=""></textarea>
              </div>
            </div>


            <div class="col-md-6 push-up-15">
              <div class="form-group">
                <label for="tanggal_terbit">Tanggal Terbit</label>
                <input name="tanggal_terbit" type="date" class="form-control" placeholder="Masukan Tanggal Terbit">
              </div>
            </div>

            <div class="col-md-6  push-up-15">
              <div class="form-group">
                <label for="tanggal_masuk">Tanggal Masuk E-Book</label>
                <input name="tanggal_masuk" type="date" class="form-control" placeholder="Masukan Tanggal">
              </div>
            </div>

            <div class="col-md-12  push-up-15">
              <div class="form-group">
                <label>Unggah E-Book</label><br />
                <input type="file" name="file_ebook" multiple id="file-simple" />
              </div>
            </div>

            <div class="col-md-12 push-up-15">
              <div class="form-group">
                <label for="kategori_id">Status</label>
                <select name="status" class="form-control" data-live-search="true" required>
                  <option value="0">Belum Review</option>
                  <option value="1">Publish</option>
                </select>
              </div>
            </div>

          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
        </form>


      </div>
    </div>
  </div>
</div>
<!-- END MODAL TAMBAH DATA EBOOK -->


<!-- MODAL TAMBAH DATA KATEGORI-->
<div class="modal fade" id="tambahDataKategori" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Kategori</h5>
      </div>
      <div class="modal-body">

        <form action="{{route('perpustakaan.databuku.datakategori.tambah')}}" method="post">
          @csrf
          <div class="row">

            <div class="form-group col-md-6">
              <label for="kode_kategori">Kode Kategori</label>
              <input name="kode_kategori" type="text" class="form-control" value="" placeholder="Masukan Kode Kategori Buku">
            </div>

            <div class="form-group col-md-6">
              <label for="nama_kategori">Nama Kategori</label>
              <input name="nama_kategori" type="text" class="form-control" value="" placeholder="Masukan Nama Kategori Buku">
            </div>


          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
        </form>


      </div>
    </div>
  </div>
</div>
<!-- END MODAL TAMBAH DATA KATEGORI -->


<!-- MODAL TAMBAH DATA DISTRIBOTOR-->
<div class="modal fade" id="tambahDataDistributor" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Distributor</h5>
      </div>
      <div class="modal-body">

        <form action="{{route('perpustakaan.databuku.datadistributor.tambah')}}" method="post">
          @csrf
          <div class="row">

            <div class="form-group col-md-6">
              <label for="kode_distributor">Kode Distributor</label>
              <input name="kode_distributor" type="text" class="form-control" value="" placeholder="Masukan Kode Distributor Buku">
            </div>

            <div class="form-group col-md-6">
              <label for="nama_distributor">Nama Distributor</label>
              <input name="nama_distributor" type="text" class="form-control" value="" placeholder="Masukan Nama Distributor Buku">
            </div>

          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
        </form>


      </div>
    </div>
  </div>
</div>
<!-- END MODAL TAMBAH DATA DISTRIBOTOR -->

@endsection

@section('data-scripts')
<script type="text/javascript" src="{{asset('admin/js/plugins/datatables/datatables.min.js')}}" defer></script>

<script>
  $(document).ready(function() {
    $('#buku-table').DataTable({
      paging: true,
      processing: true,
      serverSide: true,
      searching: true,
      sorting: true,
      ordering: true,
      ajax: {
        url: "{{ route('perpustakaan.ambil.data.buku') }}",
        type: "GET",
      },
      columns: [{
          "data": "kategori",
          "name": "kategori",
          searchable: true,
          orderable: true
        },
        {
          "data": "ISBN",
          "name": "ISBN",
          searchable: true,
          orderable: true
        },
        {
          "data": "judul_buku",
          "name": "judul_buku",
          searchable: true
        },
        {
          "data": "penulis",
          "name": "penulis"
        },
        {
          "data": "penerbit",
          "name": "penerbit"
        },
        {
          "data": "stok",
          "name": "stok"
        },
        {
          "data": "action",
          "name": "action",
          render: "",
          searchable: false,
        },

      ],
    });
    $('#kategori-table').DataTable({
      paging: true,
      processing: true,
      serverSide: true,
      searching: true,
      sorting: true,
      ordering: true,
      ajax: {
        url: "{{ route('perpustakaan.ambil.data.kategori.buku') }}",
        type: "GET",
      },
      columns: [{
          "data": "kode_kategori",
          "name": "kode_kategori",
        },
        {
          "data": "nama_kategori",
          "name": "nama_kategori",
          searchable: true,
        },
        {
          "data": "action",
          "name": "action",
          render: "",
          searchable: false,
        },

      ],
    });
  });
</script>
@endsection
