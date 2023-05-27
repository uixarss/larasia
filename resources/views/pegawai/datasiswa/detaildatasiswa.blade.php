@extends('layouts.joliadmin-top')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('pegawai.halamanutama.index') }}">Halaman Utama</a></li>
    <li><a href="{{ route('pegawai.datasiswa.index') }}">Data Siswa</a></li>
    <li>Detail Siswa</a></li>
</ul>
<!-- END BREADCRUMB -->

<!-- START DEFAULT DATATABLE -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Detail Siswa</h3>
    </div>
    <div class="panel-body">

        <!-- START TABS -->
        <div class="panel panel-default tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Data Sekolah</a></li>
                <li><a href="#tab-second" role="tab" data-toggle="tab">Data Pribadi</a></li>
                <li><a href="#tab-third" role="tab" data-toggle="tab">Data Pendidikan</a></li>
                <li><a href="#tab-fourth" role="tab" data-toggle="tab">Data Orang Tua</a></li>
            </ul>
            <div class="panel-body tab-content">

                <div class="tab-pane active" id="tab-first">
                    <div class="row">

                        <div class="col-md-6">
                            <form action="{{route('pegawai.datasiswa.updateSekolah', ['id' => $siswa->id] ) }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label class="col-md-3 control-label">NIS</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" name="NIS" value="{{$siswa->NIS}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama Depan Siswa</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" name="nama_depan" value="{{$siswa->nama_depan}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama Belakang Siswa</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" name="nama_belakang" value="{{$siswa->nama_belakang}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tahun Masuk</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" value="2019/2020">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Kelas</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <select name="kelas_id" id="kelas_id" class="form-control select">
                                                @foreach($data_kelas as $kelas)
                                                <option value="{{$kelas->id}}" {{($kelas->id == $siswa->kelas_id) ? 'selected' : '' }}>{{$kelas->nama_kelas}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Status Siswa</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <select name="status" id="status" class="form-control select">
                                                <option value="1" {{($siswa->status == 1) ? 'selected' : ''}}>Aktif</option>
                                                <option value="0" {{($siswa->status == 0) ? 'selected' : ''}}>Non Aktif</option>
                                            </select>

                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                    </form>

                </div>

                <div class="tab-pane" id="tab-second">

                    <div class="row">

                        <div class="col-md-3">

                            <div class="panel panel-default">
                                <div class="panel-body profile">
                                    <div class="profile-image">
                                        @if($siswa->photo != null)
                                        <img src="{{asset('admin/assets/images/users/siswa/'.$siswa->photo)}}" alt="">
                                        @else
                                        <img src="{{asset('admin/assets/images/users/siswa/no-image.jpg')}}" alt="">
                                        @endif
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name">{{$siswa->nama_depan}} {{$siswa->nama_belakang}}</div>
                                        <div class="profile-data-title" style="color: #FFF;">{{$siswa->NIS}}</div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-info btn-rounded btn-block"><span class="fa fa-camera"></span>
                                                <input class="fileinput btn-info" type="file" name="filename3" id="filename3" data-filename-placement="inside" title=" Pilih Foto">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-8">
                            <form action="{{route('pegawai.datasiswa.updatePribadi', ['id' => $siswa->id] ) }}" method="post">
                                @csrf

                                <div class="panel-body">

                                    <div class="row">


                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Nama Depan</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control" name="nama_depan" value="{{$siswa->nama_depan}}">
                                                    </div>
                                                    <span class="help-block">.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Nama Belakang</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control" name="nama_belakang" value="{{$siswa->nama_belakang}}">
                                                    </div>
                                                    <span class="help-block">.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Jenis Kelamin</label>
                                                <div class="col-md-9">
                                                    <select class="form-control select" name="jenis_kelamin" style="display: none;">
                                                        <option value="L" {{($siswa->jenis_kelamin == 'L') ? 'selected': ''}}>Laki-Laki</option>
                                                        <option value="P" {{($siswa->jenis_kelamin == 'P') ? 'selected': ''}}>Perempuan</option>
                                                    </select>
                                                    <span class="help-block">.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Tanggal Lahir</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                                        <input type="text" class="form-control datepicker" name="tanggal_lahir" value="{{$siswa->tanggal_lahir}}">
                                                    </div>
                                                    <span class="help-block">.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Tempat Lahir</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control" name="tempat_lahir" value="{{$siswa->tempat_lahir}}">
                                                    </div>
                                                    <span class="help-block">.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Kewarganegaraan</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control" name="kebangsaan" value="{{$siswa->kebangsaan}}">
                                                    </div>
                                                    <span class="help-block">.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Alamat Lengkap</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <textarea class="form-control" name="alamat_sekarang" rows="5">{{$siswa->alamat_sekarang}}</textarea>
                                                </div>
                                                <span class="help-block">.</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Anak Ke</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control" name="anak_ke" value="{{$siswa_detail->anak_ke}}">
                                                    </div>
                                                    <span class="help-block">.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Jumlah Saudara</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control" name="jumlah_saudara" value="{{$siswa_detail->jumlah_saudara}}">
                                                    </div>
                                                    <span class="help-block">.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Kondisi Siswa</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control" name="kondisi_siswa" value="{{$siswa_detail->kondisi_siswa}}">
                                                    </div>
                                                    <span class="help-block">.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Agama</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <select class="form-control select" name="agama">
                                                            <option value="Islam" {{($siswa->agama == 'Islam') ? 'selected': ''}}>Islam</option>
                                                            <option value="Kristen" {{($siswa->agama == 'Kristen') ? 'selected': ''}}>Kristen</option>
                                                            <option value="Katolik" {{($siswa->agama == 'Katolik') ? 'selected': ''}}>Katolik</option>
                                                            <option value="Budha" {{($siswa->agama == 'Budha') ? 'selected': ''}}>Budha</option>
                                                            <option value="Hindu" {{($siswa->agama == 'Hindu') ? 'selected': ''}}>Hindu</option>
                                                            <option value="Lainnya" {{($siswa->agama == 'Lainnya') ? 'selected': ''}}>Lainnya</option>
                                                        </select>
                                                    </div>
                                                    <span class="help-block">.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">No Hp</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control" name="no_phone" value="{{$siswa->no_phone}}">
                                                    </div>
                                                    <span class="help-block">.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Email</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="email" name="email_siswa" class="form-control" value="{{$siswa->email_siswa}}">
                                                    </div>
                                                    <span class="help-block">.</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                    </form>
                </div>

                <div class="tab-pane" id="tab-third">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{route('pegawai.datasiswa.updatePendidikan', ['id' => $siswa->id] ) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Asal SD</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="asal_sd" class="form-control" value="{{$siswa_detail->asal_sd}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Asal SMP</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="asal_smp" class="form-control" value="{{$siswa_detail->asal_smp}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                    </form>

                </div>

                <div class="tab-pane" id="tab-fourth">
                    <div class="row">

                        <form action="{{route('pegawai.datasiswa.updateOrtu', ['id' => $siswa->id] ) }}" method="post">
                            @csrf

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama Ayah</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" name="nama_ayah" value="{{$siswa_detail->nama_ayah}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-md-3 control-label">Pendidikan Terakhir</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" name="pendidikan_ayah" value="{{$siswa_detail->pendidikan_ayah}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Pekerjaan</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" name="pekerjaan_ayah" value="{{$siswa_detail->pekerjaan_ayah}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Penghasilan Ayah</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" name="penghasilan_ayah" value="Rp {{number_format($siswa_detail->penghasilan_ayah,2)}},-">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Alamat Lengkap Ayah</label>
                                    <div class="col-md-9 col-xs-12">
                                        <textarea class="form-control" rows="5" name="alamat_lengkap_ayan">{{$siswa_detail->alamat_lengkap_ayah}}</textarea>
                                    </div>
                                    <span class="help-block">.</span>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">No Hp</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" name="no_hp_ayah" value="{{$siswa_detail->no_hp_ayah}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama Ibu</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" name="nama_ibu" value="{{$siswa_detail->nama_ibu}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Pendidikan Terakhir</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" name="pendidikan_ibu" value="{{$siswa_detail->pendidikan_ibu}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Pekerjaan</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" name="pekerjaan_ibu" value="{{$siswa_detail->pekerjaan_ibu}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Penghasilan Ibu</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" name="penghasilan_ibu" value="Rp. {{number_format($siswa_detail->penghasilan_ibu,2)}},-">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Alamat Lengkap Ibu</label>
                                    <div class="col-md-9 col-xs-12">
                                        <textarea class="form-control" rows="5" name="alamat_lengkap_ibu">{{$siswa_detail->alamat_lengkap_ibu}}</textarea>
                                    </div>
                                    <span class="help-block">.</span>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">No Hp</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" name="no_hp_ibu" value="{{$siswa_detail->no_hp_ibu}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                    </form>


                </div>

            </div>
        </div>
        <!-- END TABS -->
    </div>


</div>
</div>
<!-- END DEFAULT DATATABLE -->

@stop