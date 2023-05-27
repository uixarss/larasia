@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
    <li><a href="{{route('admin.khs.pilih.tahun')}}">Pilih Tahun Ajaran</a></li>
    <li><a href="{{route('admin.khs.pilih.prodi',[ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id])}}">Pilih Prodi</a></li>
    <li><a href="{{route('admin.khs.prodi', [ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id,'id_prodi' => $prodi->id_prodi])}}">Program Studi {{$prodi->nama_program_studi}}</a></li>
    <li class="active">Lihat Kartu Hasil Studi</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Lihat Kartu Hasil Studi {{$mahasiswa->nama_mahasiswa}}</h2>
</div>
<!-- END PAGE TITLE -->


<div class="page-content-wrap">
    <div class="row">

        <div class="col-md-3">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    </ul>
                </div>
                @include('layouts.alert')
                <div class="panel-body">
                    <form action="{{route('admin.khs.store',[ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id,'id_prodi' => $prodi->id_prodi])}}" method="post">
                        @csrf
                        <input type="hidden" name="id_mahasiswa" value="{{$mahasiswa->id}}">
                        <div class="form-group">
                            <label>Tambah KHS|</label>
                            <label>Tingkat (Semester)</label>
                            <div class="input-group">
                                <select name="tingkat_semester" id="tingkat_semester" class="form-control" data-live-search="true">
                                    <option value="1" >1</option>
                                    <option value="2" >2</option>
                                    <option value="3" >3</option>
                                    <option value="4" >4</option>
                                    <option value="5" >5</option>
                                    <option value="6" >6</option>
                                    <option value="7" >7</option>
                                    <option value="8" >8</option>
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
        <div class="col-md-9">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="panel-controls">
                        <form action="{{route('admin.khs.store',[ 'id_tahun_ajaran' => $tahun->id,'id_semester' => $semester->id,'id_prodi' => $prodi->id_prodi])}}" method="post">
                        @csrf
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Semester</th>
                                <th>Kode Mata Kuliah</th>
                                <th>Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Mutu</th>
                                <th>Nilai</th>
                                <th>Dosen</th>                              
                                <th>Disetujui oleh</th>
                                <th>Ubah Nilai</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i=0; ?>
                            @foreach($data_khs as $khs)
                            @foreach($khs->detail as $key => $detail)
                            <?php $i++; ?>
                            <tr>
                                <td>{{$i}}</td>
                                <td>
                                {{$khs->tahun->nama_tahun_ajaran}} / {{$khs->semester->nama_semester}}
                                </td>
                                <td>
                                {{$detail->mapel->kode_mapel}}
                                </td>
                                <td>{{$detail->mapel->nama_mapel}}</td>
                                <td>
                                {{$detail->mapel->jumlah_sks}}
                                </td>
                                <td>
                                <input type="text" value="{{$detail->mutu}}" id="mutu-{{$i}}" name="mutu" class="form-control">
                                </td>
                                <td>
                                <input type="text" value="{{$detail->nilai}}" id="nilai-{{$i}}" name="nilai" class="form-control">
                                </td>
                                <td>
                                {{$detail->dosen->nama_dosen ?? ''}}
                                </td>
                                <td>
                                {{$detail->disetujui_oleh}}
                                </td>
                                <td>
                                <a href="javascript:save_nilai({{$detail->id}},{{$i}});" class="btn btn-info">Save</a>
                                </td>
                                <td>
                                    <a href="javascript:hapus({{$detail->id}});" class="btn btn-danger">Delete</a>
                                </td>

                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                        </form>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->
            


        </div>
    </div>
</div>


<script type="text/javascript">
    

    var save_nilai = function(id,idx){
        var mutu = $('#mutu-'+idx).val();
        var nilai = $('#nilai-'+idx).val();

        var url = '{{ url('admin/khs/update_nilai') }}';


        $.ajax({
            type : 'ajax',
            url: url,
            method: 'post',
            data: {
                id:id,
                mutu:mutu,
                nilai:nilai
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response, status, xhr, $form) {
                alert("Data Berhasil disimpan!!");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 401) {
                    alert(jqXHR.responseJSON.message);
                }else if(jqXHR.status == 422){
                    let response = JSON.parse(jqXHR.responseText);
                    let errorString = '<ul>';
                    $.each(response.errors, function(key, value) {
                        errorString += '<li>' + value + '</li>';
                    });
                    errorString += '</ul>';
                    alert(errorString);
                }else{
                    alert('Error Proses');
                }
            }
        });
    }

    var hapus = function(id){
    
        var url = '{{ url('admin/khs/destroyKHS') }}';
        console.log(id);

        $.ajax({
            type : 'ajax',
            url: url,
            method: 'post',
            data: {
                id:id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response, status, xhr, $form) {
                alert("Data Berhasil dihapus!!");
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 401) {
                    alert(jqXHR.responseJSON.message);
                }else if(jqXHR.status == 422){
                    let response = JSON.parse(jqXHR.responseText);
                    let errorString = '<ul>';
                    $.each(response.errors, function(key, value) {
                        errorString += '<li>' + value + '</li>';
                    });
                    errorString += '</ul>';
                    alert(errorString);
                }else{
                    alert('Error Proses');
                }
            }
        });
    }

        
</script>

@stop