@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar py-3 py-lg-6 ">
        <div class="app-container container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 my-4">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Edit Data Pribadi
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('siswa.datapribadi.index') }}" class="btn fw-bold btn-light">Cancel</a>
                <a  href="{{route('siswa.datapribadi.updating')}}" onclick="event.preventDefault(); document.getElementById('editdatapribadi').submit();" class="btn fw-bold btn-primary">Update</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <form class="form" id="editdatapribadi" action="{{route('siswa.datapribadi.updating')}}" method="POST">
        @csrf
        <div class="card card-flush py-4 mb-5">
            <div class="card-header">
                <div class="card-title">
                    <h2>Data Pribadi</h2>
                </div>
            </div>

            <div class="card-body pt-0">
                <div class="mb-5 fv-row">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_mahasiswa"
                        value="{{ $mahasiswa->nama_mahasiswa }}">
                </div>
                <div class="mb-5 fv-row">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                        <option value="L" {{ $mahasiswa->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $mahasiswa->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="d-flex flex-wrap gap-5">
                    <div class="mb-5 fv-row w-100 flex-md-root">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir"
                            value="{{ $mahasiswa->tempat_lahir }}">
                    </div>
                    <div class="mb-5 fv-row w-100 flex-md-root">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir"
                            value="{{ $mahasiswa->tanggal_lahir }}">
                    </div>
                </div>
                <div class="mb-5 fv-row">
                    <label class="form-label">Agama</label>
                    <select name="nama_agama" class="form-select">
                        <option value="1,Islam" @if ($mahasiswa->nama_agama == 'Islam') selected @endif>Islam</option>
                        <option value="2,Kristen" @if ($mahasiswa->nama_agama == 'Kristen') selected @endif>Kristen</option>
                        <option value="3,Katolik" @if ($mahasiswa->nama_agama == 'Katolik') selected @endif>Katolik</option>
                        <option value="4,Hindu" @if ($mahasiswa->nama_agama == 'Hindu') selected @endif>Hindu</option>
                        <option value="5,Budha" @if ($mahasiswa->nama_agama == 'Budha') selected @endif>Budha</option>
                    </select>
                </div>
                <div class="mb-5 fv-row">
                    <label class="form-label">Kewarganegaraan</label>
                    <select id="kewarganegaraan" name="kewarganegaraan" class="form-control" data-control="select2"
                        data-placeholder="Pilih Kewarganegaraan">>
                        @foreach ($data_negara as $negara)
                            <option value="{{ $negara->kode_negara }},{{ $negara->nama_negara }}"
                                {{ $negara->kode_negara == $mahasiswa->id_negara || $negara->nama_negara == $mahasiswa->kewarganegaraan ? 'selected' : '' }}>
                                {{ $negara->nama_negara }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card card-flush py-4 mb-5">
            <div class="card-header">
                <div class="card-title">
                    <h2>Keterangan Tempat Tinggal</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="mb-5 fv-row">
                    <label class="form-label">Alamat</label>
                    <div class="d-flex flex-wrap gap-5">
                        <div class="fv-row w-100 flex-md-root fv-plugins-icon-container">
                            <input type="text" class="form-control" name="jalan" value="{{ $mahasiswa->jalan }}"
                                placeholder="Jalan">
                        </div>
                        <div class="fv-row w-50 flex-md-root fv-plugins-icon-container">
                            <input type="text" class="form-control" name="dusun" value="{{ $mahasiswa->dusun }}"
                                placeholder="Dusun">
                        </div>
                        <div class="fv-row w-100px">
                            <input type="text" class="form-control" name="rt" value="{{ $mahasiswa->rt }}"
                                placeholder="RT">
                        </div>
                        <div class="fv-row w-100px">
                            <input type="text" class="form-control" name="rw" value="{{ $mahasiswa->rw }}"
                                placeholder="RW">
                        </div>
                        <input type="text" class="form-control" name="kelurahan" value="{{ $mahasiswa->kelurahan }}"
                            placeholder="Kelurahan">
                    </div>
                </div>
                <div class="mb-5 fv-row">
                    <label class="form-label">Kode Pos</label>
                    <input type="text" class="form-control" name="kode_pos" value="{{ $mahasiswa->kode_pos }}"
                        placeholder="Kode pos">
                </div>
                <div class="mb-5 fv-row">
                    <label class="form-label">Kota</label>
                    <select id="nama_kota" name="nama_kota" class="form-control">
                        @foreach ($data_kota as $kota)
                            <option value="{{ $kota->id }},{{ $kota->name }}"
                                {{ $kota->id == $mahasiswa->id_wilayah || $kota->name == $mahasiswa->nama_wilayah ? 'selected' : '' }}>
                                {{ $kota->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5 fv-row">
                    <label class="form-label">Kecamatan</label>
                    <input name="id_kecamatan" id="id_kecamatan" type="text" value="{{ $mahasiswa->id_kecamatan }}"
                        hidden>
                    <select name="kecamatan" id="kecamatan" class="form-control">
                        <option value="">== Pilih Kecamatan ==</option>
                    </select>
                </div>
                <div class="mb-5 fv-row">
                    <label class="form-label">Nomor Hp</label>
                    <input type="text" class="form-control" name="handphone" value="{{ $mahasiswa->handphone }}"
                        placeholder="No HP">
                </div>
                <div class="mb-5 fv-row">
                    <label class="form-label">Alamat Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $mahasiswa->email }}"
                        placeholder="Email Aktif">
                </div>
            </div>
        </div>
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>Keterangan Orang Tua</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-xl-6 col-md-12">
                        <div class="mb-5 fv-row">
                            <label class="form-label">Nama Ayah</label>
                            <input type="text" class="form-control" name="nama_ayah" value="{{$mahasiswa->nama_ayah}}" placeholder="Nama Ayah">
                        </div>
                        <div class="mb-5 fv-row">
                            <label class="form-label">NIK Ayah</label>
                            <input type="text" class="form-control" name="nama_ayah" value="{{$mahasiswa->nik_ayah}}" placeholder="NIK Ayah">
                        </div>
                        <div class="mb-5 fv-row">
                            <label class="form-label">Pekerjaan</label>
                            <select name="pekerjaan_ayah" class="form-select" data-control="select2" data-placeholder="-Pilih-" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                @foreach($jenis_pekerjaan as $pekerjaan)
                                <option value="{{$pekerjaan->id}},{{$pekerjaan->jenis_pekerjaan}}" {{($pekerjaan->id == $mahasiswa->id_pekerjaan_ayah)||
                            ($pekerjaan->jenis_pekerjaan == $mahasiswa->nama_pekerjaan_ayah) ? 'selected' : '' }}>{{$pekerjaan->jenis_pekerjaan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-5 fv-row">
                            <label class="form-label">Pendidikan</label>
                            <select name="pendidikan_ayah" class="form-select" data-control="select2" data-placeholder="-Pilih-" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                @foreach($jenis_pendidikan as $pendidikan)
                                <option value="{{$pendidikan->id}},{{$pendidikan->jenis_pendidikan}}" {{($pendidikan->id == $mahasiswa->id_pendidikan_ayah)||
                                ($pendidikan->jenis_pendidikan == $mahasiswa->nama_pendidikan_ayah) ? 'selected' : '' }}>{{$pendidikan->jenis_pendidikan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-5 fv-row">
                            <label class="form-label">Penghasilan</label>
                            <select name="penghasilan_ayah" class="form-select" data-control="select2" data-placeholder="-Pilih-" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                @foreach($jenis_penghasilan as $penghasilan)
                                <option value="{{$penghasilan->id}},{{$penghasilan->jenis_penghasilan}}" {{($penghasilan->id == $mahasiswa->id_penghasilan_ayah)||
                                ($penghasilan->jenis_penghasilan == $mahasiswa->nama_penghasilan_ayah) ? 'selected' : '' }}>Rp. {{$penghasilan->jenis_penghasilan}} /Bln</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-12">
                        <div class="mb-5 fv-row">
                            <label class="form-label">Nama Ibu</label>
                            <input type="text" class="form-control" name="nama_ibu" value="{{$mahasiswa->nama_ibu}}" placeholder="Nama Ibu">
                        </div>
                        <div class="mb-5 fv-row">
                            <label class="form-label">NIK Ibu</label>
                            <input type="text" class="form-control" name="nama_ibu" value="{{$mahasiswa->nik_ibu}}" placeholder="NIK Ibu">
                        </div>
                        <div class="mb-5 fv-row">
                            <label class="form-label">Pekerjaan</label>
                            <select name="pekerjaan_ibu" class="form-select" data-control="select2" data-placeholder="-Pilih-" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                @foreach($jenis_pekerjaan as $pekerjaan)
                                <option value="{{$pekerjaan->id}},{{$pekerjaan->jenis_pekerjaan}}" {{($pekerjaan->id == $mahasiswa->id_pekerjaan_ibu)||
                            ($pekerjaan->jenis_pekerjaan == $mahasiswa->nama_pekerjaan_ibu) ? 'selected' : '' }}>{{$pekerjaan->jenis_pekerjaan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-5 fv-row">
                            <label class="form-label">Pendidikan</label>
                            <select name="pendidikan_ibu" class="form-select" data-control="select2" data-placeholder="-Pilih-" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                @foreach($jenis_pendidikan as $pendidikan)
                                <option value="{{$pendidikan->id}},{{$pendidikan->jenis_pendidikan}}" {{($pendidikan->id == $mahasiswa->id_pendidikan_ibu)||
                                ($pendidikan->jenis_pendidikan == $mahasiswa->nama_pendidikan_ibu) ? 'selected' : '' }}>{{$pendidikan->jenis_pendidikan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-5 fv-row">
                            <label class="form-label">Penghasilan</label>
                            <select name="penghasilan_ibu" class="form-select" data-control="select2" data-placeholder="-Pilih-" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                @foreach($jenis_penghasilan as $penghasilan)
                                <option value="{{$penghasilan->id}},{{$penghasilan->jenis_penghasilan}}" {{($penghasilan->id == $mahasiswa->id_penghasilan_ibu)||
                                ($penghasilan->jenis_penghasilan == $mahasiswa->nama_penghasilan_ibu) ? 'selected' : '' }}>Rp. {{$penghasilan->jenis_penghasilan}} /Bln</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('data-scripts')
<script>
    $(function() {
        $("input[name='penerima_kps']").click(function() {
            if ($("#ya").is(":checked")) {
                $("#no_kps").removeAttr("hidden");
                $("#no_kps").focus();
            } else {
                $("#no_kps").attr("hidden", "hidden");
            }
        });
    });

    var myInput = document.getElementById("nama_kota");
    var kecamatan = document.getElementById("id_kecamatan");
    if (myInput && myInput.value) {
        var kota = myInput.value.split(',');
        if (kota[0]) {
            jQuery.ajax({
                url: "{{ route( 'siswa.get.kecamatan', '')}}" + "/" + kota[0],
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    jQuery('#kecamatan').empty();
                    jQuery.each(data, function(key, value) {
                        if (kecamatan.value != value) {
                            $('#kecamatan').append('<option value="' + value + ',' + key + '" >' + key + '</option>');
                        } else {
                            $('#kecamatan').append('<option value="' + value + ',' + key + '" selected >' + key + '</option>');
                        }
                    });
                }
            });
        } else {
            $('select[name="kecamatan"]').empty();
        }
    }



    $(document).on('change', '#nama_kota', function() {
        var kota = jQuery(this).val();
        var id_kota = kota.split(',');
        console.log(id_kota[0]);
        if (id_kota[0]) {
            jQuery.ajax({
                url: "{{ route( 'siswa.get.kecamatan', '')}}" + "/" + id_kota[0],
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    jQuery('#kecamatan').empty();
                    jQuery.each(data, function(key, value) {
                        $('#kecamatan').append('<option value="' + value + ',' + key + '">' + key + '</option>');
                    });
                }
            });
        } else {
            $('select[name="kecamatan"]').empty();
        }
    });
</script>
@endsection
