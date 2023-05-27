@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
    <li><a href="{{route('admin.daftarulang.pilih.tahun')}}">Pilih Tahun Ajaran</a></li>
    <li><a href="{{route('admin.daftarulang.pilih.prodi',[ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id])}}">Pilih Prodi</a></li>
    <li><a href="{{route('admin.daftarulang.prodi', [ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id,'id_prodi' => $prodi->id_prodi])}}">Program Studi {{$prodi->nama_program_studi}}</a></li>
    <li class="active">Daftar Ulang</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Daftar Ulang {{$daftarulang->mahasiswa->nama_mahasiswa}} Tingkat/Semester {{$daftarulang->tingkat_semester}}</h2>
</div>
<!-- END PAGE TITLE -->


<div class="page-content-wrap">
    <div class="row">

        <div class="col-md-4">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    </ul>
                </div>
                @include('layouts.alert')
                <div class="panel-body">
                    <form action="{{route('admin.daftarulang.update',[ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id,'id_prodi' => $prodi->id_prodi, 'id' => $daftarulang->id])}}" method="post">
                        @csrf
                        
                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <div class="input-group">
                                <input type="text" value="{{$daftarulang->tahun->nama_tahun_ajaran}}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <div class="input-group">
                                <input type="text" value="{{$daftarulang->semester->nama_semester}}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Fakultas</label>
                            <div class="input-group">
                                <input type="text" value="{{$daftarulang->prodi->jurusan->fakultas->nama_fakultas}}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <div class="input-group">
                                <input type="text" value="{{$daftarulang->prodi->jurusan->nama_jurusan}}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Program Studi</label>
                            <div class="input-group">
                                <input type="text" value="{{$daftarulang->prodi->nama_program_studi}}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Mahasiswa</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{$daftarulang->mahasiswa->nama_mahasiswa}}" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Tingkat (Semester)</label>
                            <div class="input-group">
                                <select name="tingkat_semester" id="tingkat_semester" class="form-control" disabled>
                                    <option value="1" {{($daftarulang->tingkat_semester == 1) ? 'selected' : ''}}>1</option>
                                    <option value="2" {{($daftarulang->tingkat_semester == 2) ? 'selected' : ''}}>2</option>
                                    <option value="3" {{($daftarulang->tingkat_semester == 3) ? 'selected' : ''}}>3</option>
                                    <option value="4" {{($daftarulang->tingkat_semester == 4) ? 'selected' : ''}}>4</option>
                                    <option value="5" {{($daftarulang->tingkat_semester == 5) ? 'selected' : ''}}>5</option>
                                    <option value="6" {{($daftarulang->tingkat_semester == 6) ? 'selected' : ''}}>6</option>
                                    <option value="7" {{($daftarulang->tingkat_semester == 7) ? 'selected' : ''}}>7</option>
                                    <option value="8" {{($daftarulang->tingkat_semester == 8) ? 'selected' : ''}}>8</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Status (Konfirmasi Tagihan)</label>
                            <div class="input-group">
                                <select name="konfirmasi" id="konfirmasi" class="form-control">
                                    <option value="0" {{($daftarulang->konfirmasi == 0) ? 'selected' : ''}}>Belum Konfirmasi</option>
                                    <option value="1" {{($daftarulang->konfirmasi == 1) ? 'selected' : ''}}>Konfirmasi</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Status (Pembayaran)</label>
                            <div class="input-group">
                                <input type="text" name="status_pembayaran" id="status_pembayaran" class="form-control" value="{{($daftarulang->status_pembayaran == 1) ? 'LUNAS' : 'BELUM LUNAS'}}" disabled="">
                                <!--
                         <select name="status_pembayaran" id="status_pembayaran" class="form-control">
                                    <option value="0" {{($daftarulang->status_pembayaran == 0) ? 'selected' : ''}}>Belum Lunas</option>
                                    <option value="1" {{($daftarulang->status_pembayaran == 1) ? 'selected' : ''}}>Lunas</option>
                                </select> -->
                            </div>
                        </div>



                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->



        </div>
        <div class="col-md-8">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="panel-title">
                        <a href="#" class=" btn btn-success" data-toggle="modal" onclick="store()">Buat Tagihan Baru</a>
                    </ul>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Tagihan</th>
                                <th>Jumlah Tagihan</th>
                                <th>Status</th>
                                <th>Batas Waktu Pembayaran</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data_pembayaran as $key => $pembayaran)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$pembayaran->nama_tagihan}}</td>
                                <td>{{number_format($pembayaran->jumlah_tagihan)}}</td>
                                <td> <span class="{{$pembayaran->status == 'BELUM LUNAS' ? 'badge badge-danger' : 'badge badge-success'}}">{{$pembayaran->status == 'BELUM LUNAS' ? 'Belum Lunas' : 'Lunas'}}</span> </td>
                                <td>{{$pembayaran->deadline}}</td>
                                <td><button class="btn btn-success btn-sm" onclick="ubah({{$pembayaran->id}},'{{$pembayaran->nama_tagihan}}','{{number_format($pembayaran->jumlah_tagihan)}}','{{$pembayaran->status}}',{{$pembayaran->jumlah_tagihan}})" id="ubah">Ubah</button></td>
                            </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Tagihan</th>
                                <th>Jumlah Tagihan</th>
                                <th>Status</th>
                                <th>Batas Waktu Pembayaran</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->


            <!-- MODAL TAMBAH MAPEL-->
            <div class="modal fade" id="tambahModul" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Tagihan Kuliah</h5>
                        </div>
                        <div class="modal-body">

                            <form action="{{route('admin.daftarulang.pembayaran',['id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id,'id_prodi' => $prodi->id_prodi,'id_mahasiswa' => $daftarulang->id_mahasiswa])}}" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="id_daftar_ulang" value="{{$id}}" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tingkat Semester</label>
                                    <input id="tingkat_semester" name="tingkat_semester" class="form-control" value="{{$daftarulang->tingkat_semester}}" required>
                                </div>

                                <div class="form-group">
                                    <label>Nama Tagihan</label>
                                    <select for="" id="nama_tagihan" name="nama_tagihan" class="form-control select2" required></select>
                                    
                                </div>

                                <div class="form-group">
                                    <label for="">Jumlah Tagihan</label>
                                    <input id="jumlah_tagihan" name="jumlah_tagihan" class="form-control" type="number" required>
                                </div>

                                <div class="form-group">
                                    <label for="">Deadline</label>
                                    <input id="deadline" name="deadline" class="form-control" type="date" required>
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

            <!-- MODAL TAMBAH MAPEL-->
            <div class="modal fade" id="ubahModul" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title" id="staticBackdropLabel">Ubah Status Tagihan</h5>
                        </div>
                        <div class="modal-body">

                            <form action="{{route('admin.daftarulang.ubahpembayaran',['id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id,'id_prodi' => $prodi->id_prodi,'id_mahasiswa' => $daftarulang->id_mahasiswa])}}" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="edit_id" id="edit_id">
                                <input type="hidden" name="edit_id_daftar_ulang" value="{{$id}}" >
                                <div class="form-group">
                                    <label>Nama Tagihan</label>
                                    <select for="" id="edit_nama_tagihan" name="edit_nama_tagihan" class="form-control select2"></select>
                                </div>
                                
                                <div class="form-group">  
                                    <label for="">Jumlah Tagihan</label>
                                    <input id="edit_jumlah_tagihan" name="edit_jumlah_tagihan" class="form-control" type="text" readonly="">
                                </div>

                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="edit_status_pembayaran" id="edit_status_pembayaran" class="form-control" required="">
                                        <option value="BELUM LUNAS">Belum Lunas</option>
                                        <option value="LUNAS">Lunas</option>
                                    </select>
                                </div>
                                <input type="hidden" name="edit_jml" id="edit_jml">


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btnSubmit">Ubah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('data-scripts')
<script type="text/javascript">
    
    var ubah = function(id,nama,jml,sts,jumlah_real){
        $('#edit_id').val(id);
       // $('#edit_nama_tagihan').val(nama);
        var opt_tagihan = new Option(nama,nama, false, false);
        $('#edit_nama_tagihan').html(opt_tagihan);

        $('#edit_jumlah_tagihan').val(jml);
        $('#edit_jml').val(jumlah_real);
        $('#edit_status_pembayaran').val(sts);
        $('#ubahModul').modal('show');
        //console.log(sts);
        
        if(sts=='BELUM LUNAS'){
            $('#btnSubmit').attr("disabled", false);
        }
        if(sts=='LUNAS'){
            $("#btnSubmit").attr("disabled", true);
        }
    }

    var store = function(){
       // $('#edit_id').val(id);
        
        $('#tambahModul').modal('show');
        //console.log(id);
        
    }

        
    $('#nama_tagihan').select2({
        ajax: {
            url: "<?php echo URL::to('admin/daftarulang/get_tagihan'); ?>",
            dataType: 'json',
            delay: 200, //delay panggil ajax ketika ketik (milisecond)
            data: function (params) {
                var query = {
                    searchingan: params.term,
                    page: params.page || 1,
                    limit: 10
                }
                return query;
            },
            processResults: function (response) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                data = response.data.data;
                // console.log(data);
                data = $.map(data, function (obj) {
                    obj.id = obj.nama; // replace id with the property used for the id
                    obj.text = obj.nama; // replace name with the property used for the text
                    return obj;
                });
                page = true;
                if (data.length < 10) page = false;
                return {
                    results: data,
                    pagination: {
                        more: page
                    }
                };
            }
        },
        tags: true,
        createTag: function (params) {
            return {
                id: params.term,
                text: params.term,
                newOption: true
            }
        },
        // minimumInputLength: 1,
        allowClear : true,
        placeholder: "--  Pilih  --",
        width: "100%",
        dropdownParent: $("#tambahModul") //select2 kalo di modal dialog harus ditambah ini,issue nya gt
    });
    
    $('#edit_nama_tagihan').select2({
        ajax: {
            url: "<?php echo URL::to('admin/daftarulang/get_tagihan'); ?>",
            dataType: 'json',
            delay: 200, //delay panggil ajax ketika ketik (milisecond)
            data: function (params) {
                var query = {
                    searchingan: params.term,
                    page: params.page || 1,
                    limit: 10
                }
                return query;
            },
            processResults: function (response) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                data = response.data.data;
                // console.log(data);
                data = $.map(data, function (obj) {
                    obj.id = obj.nama || obj.nama; // replace id with the property used for the id
                    obj.text = obj.text || obj.nama; // replace name with the property used for the text
                    return obj;
                });
                page = true;
                if (data.length < 10) page = false;
                return {
                    results: data,
                    pagination: {
                        more: page
                    }
                };
            }
        },
        tags: true,
        createTag: function (params) {
            return {
                id: params.term,
                text: params.term,
                newOption: true
            }
        },
        // minimumInputLength: 1,
        allowClear : true,
        placeholder: "--  Pilih  --",
        width: "100%",
        dropdownParent: $("#ubahModul") //select2 kalo di modal dialog harus ditambah ini,issue nya gt
    });


</script>



@stop