@extends('layouts.joliadmin')

@section('content')


    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="{{ route('guru.halamanutama.index') }}">Halaman Utama</a></li>
        <li>Jadwal Kelas</li>
        <li class="active">Pengumuman 1</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span> Pengumuman 1</h2>
    </div>
    <!-- END PAGE TITLE -->

    <div class="kt-portlet__body">
        <div class="kt-section__body">
            <form action="{{ route('guru.pengumuman.update') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group row">
                    <input type="text" id="id" name="id" />
                    <input type="text" id="id_jadwal" name="id_jadwal" />
                    <div class="col-lg-4">
                        <label>Judul Pengumuman:</label>
                        <input type="text" class="form-control" id="judul" name="judul" required />
                        <span class="form-text text-muted"></span>
                    </div>
                    <div class="col-lg-4">
                        <label>Isi Pengumuman</label>
                        <input type="text" class="form-control" id="isi" name="isi" cols="20"
                            rows="3" required />
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group" align="left">
                        <button type="Submit" class="btn btn-primary" id="btn-simpan-input">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop

@section('data-scripts')

    <script type="text/javascript">
        var _id = '{{ $id }}';

        function loadpage() {
            $.ajax({
                url: "<?php echo URL::to('dosen/pengumuman/get_id'); ?>/" + _id,

                type: "GET",
                success: function(res) {
                    data = res.data;
                    $('#id').val(_id);
                    $('#id_jadwal').val(data.id_jadwal);
                    $('#isi').val(data.isi);
                    $('#judul').val(data.judul);

                },
            });


        }

        jQuery(document).ready(function() {
            loadpage();
        });
    </script>

@stop
