@extends('layouts.joliadmin-top')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('pegawai.halamanutama.index') }}">Halaman Utama</a></li>
    <li> <a href="{{url('/pegawai/mahasiswa')}}">Data Mahasiswa</a></li>
    <li>Detail Mahasiswa</a></li>
</ul>
<!-- END BREADCRUMB -->

<!-- START DEFAULT DATATABLE -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Detail Mahasiswa</h3>
    </div>
    <div class="panel-body">

      <!-- START TABS -->
      
      <div class="panel panel-default tabs">
        <ul class="nav nav-tabs" role="tablist">
              <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Data Kampus</a></li>
              <li><a href="#tab-second" role="tab" data-toggle="tab">Data Pribadi</a></li>
              <li><a href="#tab-third" role="tab" data-toggle="tab">Data Orang Tua</a></li>
              <li><a href="#tab-fourth" role="tab" data-toggle="tab">Lainnya</a></li>
          </ul>
          <div class="panel-body tab-content">

            <!-- Data Kampus -->
              <div class="tab-pane active" id="tab-first">
                <form action="{{route('pegawai.mahasiswa.updatedatakampus', $mahasiswa->id)}}" method="post">
                  {{csrf_field()}}
                  <div class="row">
                    <div class="col-md-6">

                    <div class="form-group">
                          <label class="col-md-3 control-label">NIM</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input name="nim" type="text" class="form-control"  value="{{$mahasiswa->nim}}" required>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">NISN</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input name="nisn" type="text" class="form-control"  value="{{$mahasiswa->nisn}}" required>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Nama Lengkap</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input name="nama_mahasiswa" type="text" class="form-control"  value="{{$mahasiswa->nama_mahasiswa}}" required>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      

                      <div class="form-group">
                                  <label class="col-md-3 control-label">No Hp</label>
                                  <div class="col-md-9">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                          <input name="handphone" type="tel" class="form-control"  value="{{$mahasiswa->handphone}}">
                                      </div>
                                      <span class="help-block">.</span>
                                  </div>
                              </div>

                      <div class="form-group">
                                  <label class="col-md-3 control-label">Email</label>
                                  <div class="col-md-9">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                          <input name="email" type="email" class="form-control"  value="{{$mahasiswa->email}}" required>
                                      </div>
                                      <span class="help-block">.</span>
                                  </div>
                              </div>

                    
                      <div class="form-group">
                          <label class="col-md-3 control-label">Kelas</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <select name="kelas_id" class="form-control">
                                      @if($kelas_mahasiswa!=null)
                                        @foreach($data_kelas as $k)                                    
                                        <option value="{{$k->id}}" {{($k->id == $kelas_mahasiswa->id_kelas) ? 'selected' : '' }}>{{$k->nama_kelas}}</option>
                                        @endforeach
                                      @else
                                      @foreach($data_kelas as $k)                                    
                                        <option value="{{$k->id}}" >{{$k->nama_kelas}}</option>
                                        @endforeach
                                      @endif
                                  </select>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Fakultas</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <select name="id_fakultas" id="id_fakultas" class="form-control">
                                    @if($kelas_mahasiswa!=null)
                                        @foreach($fakultas as $fakul)
                                        <option value="{{$fakul->id}}" {{$kelas_mahasiswa->id_fakultas ==$fakul->id ? 'selected' : ''}}>{{$fakul->nama_fakultas}}</option>
                                        @endforeach
                                    @else
                                        @foreach($fakultas as $fakul)
                                        <option value="{{$fakul->id}}" >{{$fakul->nama_fakultas}}</option>
                                        @endforeach
                                    @endif
                                  </select>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>
                      @if($kelas_mahasiswa!=null)
                      <input name="jurusan" id="jurusan" type="text" value="{{$kelas_mahasiswa->id_jurusan}}" hidden>
                      @else
                      <input name="jurusan" id="jurusan" type="text" value="0" hidden>
                      @endif
                      <div class="form-group">
                          <label class="col-md-3 control-label">Jurusan</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <select id="id_jurusan" name="id_jurusan" class="form-control">
                                  <option value="">== Pilih Jurusan ==</option>
                                  </select>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      @if($kelas_mahasiswa!=null)
                      <input name="prodi" id="id_prodi" type="text" value="{{$kelas_mahasiswa->id_prodi}}" hidden>
                      @else
                      <input name="prodi" id="id_prodi" type="text" value="0" hidden>
                      @endif
                              <div class="form-group">
                                  <label class="col-md-3 control-label">Prodi</label>
                                  <div class="col-md-9">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <select name="id_prodi" id="prodi" class="form-control">
                                                <option value="">== Pilih Prodi ==</option>
                                            </select>
                                      </div>
                                      <span class="help-block">.</span>
                                  </div>
                              </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Semester</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <select name="id_semester" class="form-control">
                                    @if($kelas_mahasiswa!=null)
                                      @foreach($data_semester as $semester)
                                      <option value="{{$semester->id}}" {{($semester->id == $kelas_mahasiswa->id_semester) ? 'selected' : '' }}>{{$semester->nama_semester}}</option>
                                      @endforeach
                                    @else
                                      @foreach($data_semester as $semester)
                                      <option value="{{$semester->id}}" >{{$semester->nama_semester}}</option>
                                      @endforeach
                                    @endif
                                  </select>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Tahun Ajaran</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <select name="id_tahun_ajaran" class="form-control">
                                    @if($kelas_mahasiswa!=null)
                                      @foreach($data_tahun_ajaran as $tahun_ajaran)
                                      <option value="{{$tahun_ajaran->id}}" {{($tahun_ajaran->id == $kelas_mahasiswa->id_tahun_ajaran) ? 'selected' : '' }}>{{$tahun_ajaran->nama_tahun_ajaran}}</option>
                                      @endforeach
                                    @else
                                      @foreach($data_tahun_ajaran as $tahun_ajaran)
                                      <option value="{{$tahun_ajaran->id}}" >{{$tahun_ajaran->nama_tahun_ajaran}}</option>
                                      @endforeach
                                    @endif
                                  </select>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                    <div class="form-group">
                          <label class="col-md-3 control-label">Status Mahasiswa</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <select name="status" class="form-control">
                                    <option value="1,Aktif" @if($mahasiswa->id_status_mahasiswa == '1' ||$mahasiswa->nama_status_mahasiswa == 'Aktif') selected @endif >Aktif</option>
                                    <option value="2,Cuti" @if($mahasiswa->id_status_mahasiswa == '2' ||$mahasiswa->nama_status_mahasiswa == 'Cuti') selected @endif >Cuti</option>
                                    <option value="3,Double Degree" @if($mahasiswa->id_status_mahasiswa == '3'||$mahasiswa->nama_status_mahasiswa == 'Double Degree') selected @endif >Double Degree</option>
                                    <option value="0,Non Aktif" @if($mahasiswa->id_status_mahasiswa == '0'||$mahasiswa->id_status_mahasiswa == 'Non Aktif') selected @endif >Non Aktif</option>
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

            <!-- Data Pribadi -->
              <div class="tab-pane " id="tab-second">
                <form action="{{route('pegawai.mahasiswa.updatedatadiri', $mahasiswa->id)}}" method="post">
                  {{csrf_field()}}
                  <div class="row">

                    <div class="col-md-3">

                        <div class="panel panel-default">
                            <div class="panel-body profile">
                                <div class="profile-image">
                                  @if($mahasiswa->photo != null)
                                  <img src="{{asset('pegawai/assets/images/users/siswa/'.$mahasiswa->photo)}}" alt="">
                                  @else
                                  <img src="{{asset('pegawai/assets/images/users/siswa/no-image.jpg')}}" alt="">
                                  @endif
                                </div>
                                <div class="profile-data">
                                    <div class="profile-data-name">{{$mahasiswa->nama_mahasiswa}}</div>
                                    <div class="profile-data-title" style="color: #FFF;">{{$mahasiswa->nim}}</div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-8">

                      <div class="panel-body">

                          <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama Lengkap</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input name="nama_mahasiswa" type="text" class="form-control"  value="{{$mahasiswa->nama_mahasiswa}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Jenis Kelamin</label>
                                    <div class="col-md-9">
                                      <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
                                        <option value="L" @if($mahasiswa->jenis_kelamin == 'L') selected @endif >Laki-Laki</option>
                                        <option value="P" @if($mahasiswa->jenis_kelamin == 'P') selected @endif >Perempuan</option>
                                      </select>
                                      <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tempat Lahir</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input name="tempat_lahir" type="text" class="form-control"  value="{{$mahasiswa->tempat_lahir}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tanggal Lahir</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                            <input name="tanggal_lahir" onkeydown="return false" type="datepicker" class="form-control datepicker" value="{{$mahasiswa->tanggal_lahir}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Agama</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <select name="nama_agama" class="form-control">
                                                <option value="1,Islam"  @if($mahasiswa->nama_agama == 'Islam')selected @endif>Islam</option>
                                                <option value="2,Kristen" @if($mahasiswa->nama_agama == 'Kristen')selected @endif>Kristen</option>
                                                <option value="3,Katolik" @if($mahasiswa->nama_agama == 'Katolik')selected @endif>Katolik</option>
                                                <option value="4,Hindu" @if($mahasiswa->nama_agama == 'Hindu')selected @endif>Hindu</option>
                                                <option value="5,Budha" @if($mahasiswa->nama_agama == 'Budha')selected @endif>Budha</option>
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
                                            <input name="handphone" type="tel" class="form-control"  value="{{$mahasiswa->handphone}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                                

                              <div class="form-group">
                                  <label class="col-md-3 control-label">Email</label>
                                  <div class="col-md-9">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                          <input name="email" type="email" class="form-control"  value="{{$mahasiswa->email}}">
                                      </div>
                                      <span class="help-block">.</span>
                                  </div>
                              </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label">Jalan</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input name="jalan" type="text" class="form-control"  value="{{$mahasiswa->jalan}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>


                                
                            </div>

                            <div class="col-md-6">

                            <div class="form-group">
                                    <label class="col-md-3 control-label">Dusun</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input name="dusun" type="text" class="form-control"  value="{{$mahasiswa->dusun}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label">RT/RW</label>
                                    <div class="col-md-9">
                                    <div class="row">
                                        <div class="input-group col-sm">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input name="rt" type="text" class="form-control"  value="{{$mahasiswa->rt}}">
                                        </div>
                                        <div class="input-group col-sm">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input name="rw" type="text" class="form-control"  value="{{$mahasiswa->rw}}">
                                        </div>
                                    </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                            <div class="form-group">
                                    <label class="col-md-3 control-label">Kelurahan</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input name="kelurahan" type="text" class="form-control"  value="{{$mahasiswa->kelurahan}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Kode POS</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input name="kode_pos" type="text" class="form-control"  value="{{$mahasiswa->kode_pos}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-md-3 control-label">Kota</label>
                                  <div class="col-md-9">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <select id="nama_kota" name="nama_kota" class="form-control">
                                                @foreach($data_kota as $kota)
                                                <option value="{{$kota->id}},{{$kota->name}}" {{($kota->id == $mahasiswa->id_wilayah)||($kota->name == $mahasiswa->nama_wilayah) ? 'selected' : '' }}>{{$kota->name}}</option>
                                                @endforeach
                                            </select>
                                      </div>
                                      <span class="help-block">.</span>
                                  </div>
                              </div>
                              

                              <input name="id_kecamatan" id="id_kecamatan" type="text" value="{{$mahasiswa->id_kecamatan}}" hidden>
                              <div class="form-group">
                                  <label class="col-md-3 control-label">Kecamatan</label>
                                  <div class="col-md-9">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <select name="kecamatan" id="kecamatan" class="form-control">
                                                <option value="">== Pilih Kecamatan ==</option>
                                            </select>
                                      </div>
                                      <span class="help-block">.</span>
                                  </div>
                              </div>

                                <div class="form-group">
                                  <label class="col-md-3 control-label">Kewarganegaraan</label>
                                  <div class="col-md-9">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                          <select id="kewarganegaraan" name="kewarganegaraan" class="form-control">
                                                @foreach($data_negara as $negara)
                                                <option value="{{$negara->kode_negara}},{{$negara->nama_negara}}" {{($negara->kode_negara == $mahasiswa->id_negara)||($negara->nama_negara == $mahasiswa->kewarganegaraan) 
                                                ? 'selected' : '' }}>{{$negara->nama_negara}}</option>
                                                @endforeach
                                            </select>
                                      </div>
                                      <span class="help-block">.</span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-3 control-label">NPWP</label>
                                  <div class="col-md-9">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                          <input name="npwp" type="text" class="form-control"  value="{{$mahasiswa->npwp}}">
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
                  </form>
                  </div>
              </div>

            <!-- Data Orangtua -->
              <div class="tab-pane " id="tab-third">
                <form action="{{route('pegawai.mahasiswa.updatedataorangtua', $mahasiswa->id)}}" method="post">
                {{csrf_field()}}
                  <div class="row">
                    <div class="col-md-4">

                    <div class="form-group">
                          <label class="col-md-3 control-label">NIK Ayah</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input name="nik_ayah" type="text" class="form-control"  value="{{$mahasiswa->nik_ayah ?? ''}}">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Nama Ayah</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input name="nama_ayah" type="text" class="form-control"  value="{{$mahasiswa->nama_ayah ?? ''}}">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Tanggal Lahir</label>
                          <div class="col-md-9">
                            <div class="input-group">
                              <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input name="tanggal_lahir_ayah" onkeydown="return false" type="datepicker" class="form-control datepicker" value="{{$mahasiswa->tanggal_lahir_ayah}}">
                            </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Pendidikan Terakhir</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <select name="pendidikan_ayah" class="form-control" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                      @foreach($jenis_pendidikan as $pendidikan)
                                      <option value="{{$pendidikan->id}},{{$pendidikan->jenis_pendidikan}}" {{($pendidikan->id == $mahasiswa->id_pendidikan_ayah)||
                                        ($pendidikan->jenis_pendidikan == $mahasiswa->nama_pendidikan_ayah) ? 'selected' : '' }}>{{$pendidikan->jenis_pendidikan}}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Pekerjaan</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <select name="pekerjaan_ayah" class="form-control" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                      @foreach($jenis_pekerjaan as $pekerjaan)
                                      <option value="{{$pekerjaan->id}},{{$pekerjaan->jenis_pekerjaan}}" {{($pekerjaan->id == $mahasiswa->id_pekerjaan_ayah)||
                                        ($pekerjaan->jenis_pekerjaan == $mahasiswa->nama_pekerjaan_ayah) ? 'selected' : '' }}>{{$pekerjaan->jenis_pekerjaan}}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Penghasilan Ayah</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <select name="penghasilan_ayah" class="form-control" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                      @foreach($jenis_penghasilan as $penghasilan)
                                      <option value="{{$penghasilan->id}},{{$penghasilan->jenis_penghasilan}}" {{($penghasilan->id == $mahasiswa->id_penghasilan_ayah)||
                                        ($penghasilan->jenis_penghasilan == $mahasiswa->nama_penghasilan_ayah) ? 'selected' : '' }}>Rp. {{$penghasilan->jenis_penghasilan}} /Bln</option>
                                      @endforeach
                                  </select>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                    </div>

                    <div class="col-md-4">

                    <div class="form-group">
                          <label class="col-md-3 control-label">NIK Ibu</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input name="nik_ibu" type="text" class="form-control"  value="{{$mahasiswa->nik_ibu ?? ''}}">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Nama Ibu</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input name="nama_ibu" type="text" class="form-control"  value="{{$mahasiswa->nama_ibu ?? ''}}">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Tanggal Lahir</label>
                          <div class="col-md-9">
                            <div class="input-group">
                              <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input name="tanggal_lahir_ibu" onkeydown="return false" type="datepicker" class="form-control datepicker" value="{{$mahasiswa->tanggal_lahir_ibu}}">
                            </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Pendidikan Terakhir</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <select name="pendidikan_ibu" class="form-control" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                      @foreach($jenis_pendidikan as $pendidikan)
                                      <option value="{{$pendidikan->id}},{{$pendidikan->jenis_pendidikan}}" {{($pendidikan->id == $mahasiswa->id_pendidikan_ibu)
                                        ||($pendidikan->jenis_pendidikan == $mahasiswa->nama_pendidikan_ibu)  ? 'selected' : '' }}>{{$pendidikan->jenis_pendidikan}}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Pekerjaan</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <select name="pekerjaan_ibu" class="form-control" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                      @foreach($jenis_pekerjaan as $pekerjaan)
                                      <option value="{{$pekerjaan->id}},{{$pekerjaan->jenis_pekerjaan}}" {{($pekerjaan->id == $mahasiswa->id_pekerjaan_ibu)||
                                        ($pekerjaan->jenis_pekerjaan == $mahasiswa->nama_pekerjaan_ibu) ? 'selected' : '' }}>{{$pekerjaan->jenis_pekerjaan}}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Penghasilan Ibu</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <select name="penghasilan_ibu" class="form-control" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                      @foreach($jenis_penghasilan as $penghasilan)
                                      <option value="{{$penghasilan->id}},{{$penghasilan->jenis_penghasilan}}" {{($penghasilan->id == $mahasiswa->id_penghasilan_ibu)||
                                        ($penghasilan->jenis_penghasilan == $mahasiswa->nama_penghasilan_ibu) ? 'selected' : '' }}>Rp. {{$penghasilan->jenis_penghasilan}} /Bln</option>
                                      @endforeach
                                  </select>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                    </div>

                <div class="col-md-4">
                    
                <label class="col-md-4 control-label" style="color:red">* Optional</label>
                      <div class="form-group">
                          <label class="col-md-3 control-label">Nama Wali</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input name="nama_wali" type="text" class="form-control"  value="{{$mahasiswa->nama_wali ?? ''}}">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Tanggal Lahir</label>
                          <div class="col-md-9">
                            <div class="input-group">
                              <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input name="tanggal_lahir_wali" onkeydown="return false" type="datepicker" class="form-control datepicker" value="{{$mahasiswa->tanggal_lahir_wali}}">
                            </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Pendidikan Terakhir</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <select name="pendidikan_wali" class="form-control" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                      @foreach($jenis_pendidikan as $pendidikan)
                                      <option value="{{$pendidikan->id}},{{$pendidikan->jenis_pendidikan}}" {{($pendidikan->id == $mahasiswa->id_pendidikan_wali)||
                                        ($pendidikan->jenis_pendidikan == $mahasiswa->nama_pendidikan_wali)  ? 'selected' : '' }}>{{$pendidikan->jenis_pendidikan}}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Pekerjaan</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <select name="pekerjaan_wali" class="form-control" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                      @foreach($jenis_pekerjaan as $pekerjaan)
                                      <option value="{{$pekerjaan->id}},{{$pekerjaan->jenis_pekerjaan}}" {{($pekerjaan->id == $mahasiswa->id_pekerjaan_wali)||
                                        ($pekerjaan->jenis_pekerjaan == $mahasiswa->nama_pekerjaan_wali)  ? 'selected' : '' }}>{{$pekerjaan->jenis_pekerjaan}}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Penghasilan Wali</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <select name="penghasilan_wali" class="form-control" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                      @foreach($jenis_penghasilan as $penghasilan)
                                      <option value="{{$penghasilan->id}},{{$penghasilan->jenis_penghasilan}}" {{($penghasilan->id == $mahasiswa->id_penghasilan_wali)||
                                        ($penghasilan->jenis_penghasilan == $mahasiswa->nama_penghasilan_wali) ? 'selected' : '' }}>Rp. {{$penghasilan->jenis_penghasilan}} /Bln</option>
                                      @endforeach
                                  </select>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                    </div>
                </div>

                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                  </form>
                  </div>

              </div>
              
              <!-- Lainnya -->
              <div class="tab-pane " id="tab-fourth">
                <form action="{{route('pegawai.mahasiswa.updatedatalain', $mahasiswa->id)}}" method="post">
                  {{csrf_field()}}
                  <div class="row">
                    <div class="col-md-6">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Jenis Tinggal</label>
                        <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <select name="jenis_tinggal" class="form-control">
                                      @foreach($jenis_tinggal as $j)
                                      <option value="{{$j->id}},{{$j->jenis_tinggal}}" {{($j->id == $mahasiswa->id_jenis_tinggal || $j->jenis_tinggal == $mahasiswa->nama_jenis_tinggal) ? 'selected' : '' }}>{{$j->jenis_tinggal}}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <span class="help-block">.</span>
                          </div>                
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Alat Transportasi</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <select name="alat_transportasi" class="form-control">
                                      @foreach($alat_transportasi as $alat)
                                      <option value="{{$alat->id}},{{$alat->alat_transportasi}}" {{($alat->id == $mahasiswa->id_alat_transportasi || $alat->alat_transportasi == $mahasiswa->nama_alat_transportasi) ? 'selected' : '' }}>{{$alat->alat_transportasi}}</option>
                                      @endforeach
                                    </select>
                                </div>
                                <span class="help-block">.</span>
                            </div>
                    </div>

                    
                    <div class="form-group">
                                  <label class="col-md-3 control-label">Penerima KPS</label>
                                  <div class="col-md-9">
                                      <div class="input-group">
                                            <input id="ya" class="col-md-3" type="radio" name="penerima_kps" value="1" {{($mahasiswa->penerima_kps == 1)||($mahasiswa->nomor_kps != null) ? 'checked' : '' }}>Ya</input>
                                            <input id="tidak" class="col-md-3" type="radio" name="penerima_kps" value="0" {{($mahasiswa->penerima_kps == 0) ? 'checked' : '' }}>Tidak</input>
                                      </div>
                                      <span class="help-block">.</span>
                                  </div>
                              </div>

                              

                              <div class="form-group" id="no_kps" {{($mahasiswa->penerima_kps ==0) ? 'hidden="hidden"' :''}}>
                                  <label class="col-md-3 control-label">No KPS</label>
                                  <div class="col-md-9">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                          <input name="nomor_kps" type="text" class="form-control"  value="{{$mahasiswa->nomor_kps}}">
                                      </div>
                                      <span class="help-block">.</span>
                                  </div>
                              </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Kebutuhan Khusus Mahasiswa</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <select name="kebutuhan_mahasiswa" class="form-control">
                                      @foreach($kebutuhan_khusus as $kebutuhan)
                                      <option value="{{$kebutuhan->id}},{{$kebutuhan->kebutuhan_khusus}}" {{($kebutuhan->id == $mahasiswa->id_kebutuhan_khusus_mahasiswa)||
                                        ($kebutuhan->kebutuhan_khusus == $mahasiswa->nama_kebutuhan_khusus_mahasiswa) ? 'selected' : '' }}>{{$kebutuhan->kebutuhan_khusus}}</option>
                                      @endforeach
                                    </select>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Kebutuhan Khusus Ayah</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <select name="kebutuhan_ayah" class="form-control">
                                      @foreach($kebutuhan_khusus as $kebutuhan)
                                      <option value="{{$kebutuhan->id}},{{$kebutuhan->kebutuhan_khusus}}" {{($kebutuhan->id == $mahasiswa->id_kebutuhan_khusus_ayah)||
                                        ($kebutuhan->kebutuhan_khusus == $mahasiswa->nama_kebutuhan_khusus_ayah) ? 'selected' : '' }}>{{$kebutuhan->kebutuhan_khusus}}</option>
                                      @endforeach
                                    </select>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Kebutuhan Khusus Ibu</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <select name="kebutuhan_ibu" class="form-control">
                                      @foreach($kebutuhan_khusus as $kebutuhan)
                                      <option value="{{$kebutuhan->id}},{{$kebutuhan->kebutuhan_khusus}}" {{($kebutuhan->id == $mahasiswa->id_kebutuhan_khusus_ibu)||
                                        ($kebutuhan->kebutuhan_khusus == $mahasiswa->nama_kebutuhan_khusus_ibu) ? 'selected' : '' }}>{{$kebutuhan->kebutuhan_khusus}}</option>
                                      @endforeach
                                    </select>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                    </div>
                  </div>

                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                  </form>
                </div>
              </div>

          </div>
      </div>
      <!-- END TABS -->
    </div>

</div>
<!-- END DEFAULT DATATABLE -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<!-- JS Select Option -->
<script>

    $(function () {
        $("input[name='penerima_kps']").click(function () {
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
            if(kota[0])
               {
                  jQuery.ajax({
                     url :"{{ route( 'pegawai.mahasiswa.store', '')}}"+"/"+kota[0],
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('#kecamatan').empty();
                        jQuery.each(data, function(key,value){
                            if(kecamatan.value!=value){
                                $('#kecamatan').append('<option value="'+ value +','+ key +'" >'+ key +'</option>');
                            }else{
                                $('#kecamatan').append('<option value="'+ value +','+ key +'" selected >'+ key +'</option>');
                            }
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="kecamatan"]').empty();
            }
        }



    $(document).on('change','#nama_kota',function(){
        var kota = jQuery(this).val();
        var id_kota = kota.split(',');
                console.log(id_kota[0]);
               if(id_kota[0])
               {
                  jQuery.ajax({
                     url :"{{ route( 'pegawai.mahasiswa.store', '')}}"+"/"+id_kota[0],
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('#kecamatan').empty();
                        jQuery.each(data, function(key,value){
                           $('#kecamatan').append('<option value="'+ value +','+ key +'">'+ key +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="kecamatan"]').empty();
               }    
    });

    //Jurusan & Prodi
    var fakultas = document.getElementById("id_fakultas");
        if (fakultas && fakultas.value) {
            values = fakultas.value;
            if(values)
               {
                  jQuery.ajax({
                     url :"{{ route( 'pegawai.kurikulum.jurusan', '')}}"+"/"+values,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('#id_jurusan').empty();
                        jQuery.each(data, function(key,value){
                          $('#id_jurusan').append('<option value="'+ value +'">'+ key +'</option>'); 
                        });
                        
                     }
                  });
               }
               else
               {
                  $('select[name="id_jurusan"]').empty();
            }
        }

        $(document).on('change','#id_fakultas',function(){
            var fakultas = jQuery(this).val();
                  if(fakultas)
                  {
                      jQuery.ajax({
                        url :"{{ route( 'pegawai.kurikulum.jurusan', '')}}"+"/"+fakultas,
                        type : "GET",
                        dataType : "json",
                        success:function(data)
                        {
                            jQuery('#id_jurusan').empty();
                            jQuery.each(data, function(key,value){
                              $('#id_jurusan').append('<option value="'+ value +' ">'+ key +'</option>');
              
                            });

                            var jurusan = document.getElementById("id_jurusan");
                              jQuery.ajax({
                                url :"{{ route( 'pegawai.kurikulum.prodi', '')}}"+"/"+jurusan.value,
                                type : "GET",
                                dataType : "json",
                                success:function(data)
                                {
                                    console.log(data);
                                    jQuery('#prodi').empty();
                                    jQuery.each(data, function(key,value){
                                      $('#prodi').append('<option value="'+ value +'">'+ key +'</option>'); 
                                    });
                                }
                              });
                        }
                      });
                  }
                  else
                  {
                      $('select[name="id_jurusan"]').empty();
                  }

           
        });

        var myInput2 = document.getElementById("id_fakultas");
        if (myInput2 && myInput2.value) {
            var jurusan = myInput2.value;
            if(jurusan)
               {
                  jQuery.ajax({
                     url :"{{ route( 'pegawai.kurikulum.jurusan', '')}}"+"/"+jurusan,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        var prodi = document.getElementById('jurusan');
                        jQuery('#id_jurusan').empty();
                        jQuery.each(data, function(key,value){
                            if(prodi.value!=value){
                                $('#id_jurusan').append('<option value="'+ value +'" >'+ key +'</option>');
                            }else{
                                $('#id_jurusan').append('<option value="'+ value +'" selected >'+ key +'</option>');
                            }
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="id_jurusan"]').empty();
            }
        }


        $(document).on('change','#id_jurusan',function(){
            var jurusan = jQuery(this).val();
                  if(jurusan)
                  {
                      jQuery.ajax({
                        url :"{{ route( 'pegawai.kurikulum.prodi', '')}}"+"/"+jurusan,
                        type : "GET",
                        dataType : "json",
                        success:function(data)
                        {
                            console.log(data);
                            jQuery('#prodi').empty();
                            jQuery.each(data, function(key,value){
                              $('#prodi').append('<option value="'+ value +'">'+ key +'</option>');
                            });
                        }
                      });
                  }
                  else
                  {
                      $('select[name="prodi"]').empty();
                  }    
        });

        var myInput2 = document.getElementById("jurusan");
        if (myInput2 && myInput2.value) {
            var jurusan = myInput2.value;
            if(jurusan)
               {
                  jQuery.ajax({
                     url :"{{ route( 'pegawai.kurikulum.prodi', '')}}"+"/"+jurusan,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        var prodi = document.getElementById('id_prodi');
                        console.log(data);
                        jQuery('#prodi').empty();
                        jQuery.each(data, function(key,value){
                            if(prodi.value!=value){
                                $('#prodi').append('<option value="'+ value +'" >'+ key +'</option>');
                            }else{
                                $('#prodi').append('<option value="'+ value +'" selected >'+ key +'</option>');
                            }
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="prodi"]').empty();
            }
        }



</script>


@stop
