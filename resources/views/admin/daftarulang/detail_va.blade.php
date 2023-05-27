@extends('layouts.joliadmin')

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
    <li><a href="{{route('admin.daftarulang.pilih.tahun')}}">Pilih Tahun Ajaran</a></li>

    <li class="active">Detail Virtual Account </li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Detail Virtual Account </h2>
</div>
<!-- END PAGE TITLE -->


<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default tabs">
                    <!-- START DEFAULT DATATABLE -->
                    <div class="panel-body"> 
                                    @include('layouts.alert')         
                                        <table class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th>Nama Lengkap Mahasiswa</th>
                                                    <th>Nomor Tagihan</th>
                                                    <th>Nomor VA</th>
                                                    <th>Jumlah Tagihan</th>
                                                    <th>Deadline</th>
                                                    <th>Tanggal Lunas</th>
                                                    <th>Status Pembayaran</th>
                                                    <th>Status VA</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    
                                                    <td>{{$customer_name}}</td>
                                                    <td>{{$trx_id}}</td>
                                                    <td>{{$virtual_account}}</td>
                                                    <td>{{$trx_amount}}</td>
                                                    <td>{{$datetime_expired}}</td>
                                                    <td>{{$datetime_payment}}</td>
                                                    <td><span class="{{$datetime_payment == null ? 'badge badge-danger' : 'badge badge-success'}}">{{$datetime_payment == null ? 'BELUM LUNAS' : 'LUNAS'}}</span></td>
                                                    <td><span class="{{$va_status == 1 ? 'badge badge-success' : 'badge badge-danger'}}">{{$va_status == 1 ? 'Aktif' : 'Tidak Aktif'}}</span></td>
                                                    

                                                </tr>

                                                


                                            </tbody>
                                        </table> 
                        <div class="panel-body">
                            <table class="table">
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
                                        <td><span class="{{$pembayaran->status == 'BELUM LUNAS' ? 'badge badge-danger' : 'badge badge-success'}}">{{$pembayaran->status == 'BELUM LUNAS' ? 'Belum Lunas' : 'Lunas'}}</span></td> 
                                        <td>{{$pembayaran->deadline}}</td>
                                        <td><button class="btn btn-success btn-sm" onclick="ubah({{$pembayaran->id}},'{{$pembayaran->nama_tagihan}}','{{number_format($pembayaran->jumlah_tagihan)}}','{{$pembayaran->status}}',{{$pembayaran->jumlah_tagihan}})">Ubah</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div>                      
                    </div>
                    <!-- END DEFAULT DATATABLE -->
            </div>
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

                            <form action="{{route('admin.daftarulang.ubahpembayaran_va')}}" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="edit_id" id="edit_id">
                                
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