@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
    <li><a href="{{route('admin.daftarulang.pilih.tahun')}}">Pilih Tahun Ajaran</a></li>
    <li><a href="{{route('admin.daftarulang.pilih.prodi',[ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id])}}">Pilih Prodi</a></li>
    <li><a href="{{route('admin.daftarulang.prodi', [ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id,'id_prodi' => $prodi->id_prodi])}}">Program Studi {{$prodi->nama_program_studi}}</a></li>
    <li class="active">Buat Daftar Ulang</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Buat Daftar Ulang {{$prodi->nama_program_studi}}</h2>
</div>
<!-- END PAGE TITLE -->


<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    </ul>
                </div>
                @include('layouts.alert')
                <div class="panel-body">
                    <form action="{{route('admin.daftarulang.store',[ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id,'id_prodi' => $prodi->id_prodi])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <div class="input-group">
                                <input type="text" value="{{$tahun->nama_tahun_ajaran}}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <div class="input-group">
                                <input type="text" value="{{$semester->nama_semester}}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Fakultas</label>
                            <div class="input-group">
                                <input type="text" value="{{$prodi->jurusan->fakultas->nama_fakultas}}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <div class="input-group">
                                <input type="text" value="{{$prodi->jurusan->nama_jurusan}}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Program Studi</label>
                            <div class="input-group">
                                <input type="text" value="{{$prodi->nama_program_studi}}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Mahasiswa</label>
                            <div class="input-group">
                                <select name="id_mahasiswa" id="id_mahasiswa" class="form-control">
                                    @foreach($data_mahasiswa as $mahasiswa)
                                    <option value="{{$mahasiswa->id}}">{{$mahasiswa->nama_mahasiswa}} | {{$mahasiswa->nim}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Tingkat (Semester)</label>
                            <div class="input-group">
                                <select name="tingkat_semester" id="tingkat_semester" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
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
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    //Jurusan & Prodi

    $(document).on('change', '#id_mahasiswa', function() {
        var id_mahasiswa = jQuery(this).val();
        console.log(id_mahasiswa);
        if (id_mahasiswa) {
            jQuery.ajax({
                url: "{{ route( 'admin.daftarulang.mahasiswa.tingkat', '')}}" + "/" + id_mahasiswa,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    jQuery('#tingkat_semester').empty();
                    jQuery.each(data, function(key, value) {
                        $('#tingkat_semester').append('<option value="' + value + '">' + key + '</option>');
                    });
                }
            });
        } else {
            $('select[name="id_prodi"]').empty();
        }
    });

    $(document).ready(function() {
        var id_mahasiswa = jQuery('#id_mahasiswa').val();
        console.log(id_mahasiswa);
        if (id_mahasiswa) {
            jQuery.ajax({
                url: "{{ route( 'admin.daftarulang.mahasiswa.tingkat', '')}}" + "/" + id_mahasiswa,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    jQuery('#tingkat_semester').empty();
                    jQuery.each(data, function(key, value) {
                        $('#tingkat_semester').append('<option value="' + value + '">' + key + '</option>');
                    });
                }
            });
        } else {
            $('select[name="id_prodi"]').empty();
        }
    });

    var myInput2 = document.getElementById("id_jurusan");
    var prodi = document.getElementById("id_prodi");
    if (myInput2 && myInput2.value) {
        var jurusan = myInput2.value;
        if (jurusan) {
            jQuery.ajax({
                url: "{{ route( 'admin.modulmatkul.prodi', '')}}" + "/" + jurusan,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // console.log(data);
                    jQuery('#id_prodi').empty();
                    jQuery.each(data, function(key, value) {
                        if (prodi.value != value) {
                            $('#id_prodi').append('<option value="' + value + '" >' + key + '</option>');
                        } else {
                            $('#id_prodi').append('<option value="' + value + '" selected >' + key + '</option>');
                        }
                    });
                }
            });
        } else {
            $('select[name="id_prodi"]').empty();
        }
    }

    var jumlah = document.getElementById("jumlah");
    for (let i = 1; i <= jumlah.value; i++) {
        $(document).on('change', '#id_jurusan' + i + '', function() {
            var id_jurusan = jQuery(this).val();
            if (id_jurusan) {
                jQuery.ajax({
                    url: "{{ route( 'admin.modulmatkul.prodi', '')}}" + "/" + id_jurusan,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        jQuery('#id_prodi' + i + '').empty();
                        jQuery.each(data, function(key, value) {
                            $('#id_prodi' + i + '').append('<option value="' + value + '">' + key + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="id_prodi' + i + '"]').empty();
            }
        });

        var myInput2 = document.getElementById("id_jurusan" + i);
        // console.log(prodi.id);
        if (myInput2 && myInput2.value) {
            var jurusan = myInput2.value;
            if (jurusan) {
                values = prodi.value;
                jQuery.ajax({
                    url: "{{ route( 'admin.modulmatkul.prodi', '')}}" + "/" + jurusan,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var prodi = document.getElementById('prodi' + i);
                        jQuery('#id_prodi' + i).empty();
                        jQuery.each(data, function(key, value) {
                            if (prodi.value != value) {
                                $('#id_prodi' + i).append('<option value="' + value + '" >' + key + '</option>');
                            } else {
                                $('#id_prodi' + i).append('<option value="' + value + '" selected >' + key + '</option>');
                            }
                        });
                    }
                });
            } else {
                $('select[name="id_prodi"' + i + ']').empty();
            }
        }

    }
</script>
@stop