@extends('layouts.joliadmin')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
    <li> <a href="{{url('/admin/siswa')}}">Data Siswa</a></li>
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
              <!-- <li><a href="#tab-five" role="tab" data-toggle="tab">Data Tugas</a></li> -->
          </ul>
          <div class="panel-body tab-content">

              <div class="tab-pane active" id="tab-first">
                <form action="{{route('admin.siswa.updatedatasekolah', $siswa->id)}}" method="post">
                  {{csrf_field()}}
                  <div class="row">
                    <div class="col-md-6">

                      <div class="form-group">
                          <label class="col-md-3 control-label">NISN</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input name="NISN" type="text" class="form-control"  value="{{$siswa->NISN}}" required>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">NIS</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input name="NIS" type="text" class="form-control"  value="{{$siswa->NIS}}" required>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Nama Depan</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input name="nama_depan" type="text" class="form-control"  value="{{$siswa->nama_depan}}" required>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Nama Belakang</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input name="nama_belakang" type="text" class="form-control"  value="{{$siswa->nama_belakang}}" required>
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Tahun Ajaran</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input name="tahun_masuk" type="text" class="form-control"  value="{{$siswa->tahun_masuk}}">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Kelas</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <select name="kelas_id" class="form-control select">
                                      @foreach($kelas as $k)
                                      <option value="{{$k->id}}" {{($k->id == $siswa->kelas_id) ? 'selected' : '' }}>{{$k->nama_kelas}}</option>
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
                                    <select name="status" class="form-control select" style="display: none;">
                                    <option value="1" @if($siswa->status == '1') selected @endif >Aktif</option>
                                    <option value="0" @if($siswa->status == '0') selected @endif >Tidak Aktif</option>
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

              <div class="tab-pane " id="tab-second">
                <form action="{{route('admin.siswa.updatedatadiri', $siswa->id)}}" method="post">
                  {{csrf_field()}}
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
                            <!-- <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-info btn-rounded btn-block"><span class="fa fa-camera"></span>
                                          <input class="fileinput btn-info" type="file" name="filename3" id="filename3" data-filename-placement="inside" title=" Pilih Foto">
                                        </button>
                                    </div>
                                </div>
                            </div> -->
                        </div>

                    </div>

                    <div class="col-md-8">

                      <div class="panel-body">

                          <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama Depan</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input name="nama_depan" type="text" class="form-control"  value="{{$siswa->nama_depan}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama Belakang</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input name="nama_belakang" type="text" class="form-control"  value="{{$siswa->nama_belakang}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Jenis Kelamin</label>
                                    <div class="col-md-9">
                                      <select name="jenis_kelamin" class="form-control select" id="exampleFormControlSelect1">
                                        <option value="L" @if($siswa->jenis_kelamin == 'L') selected @endif >Laki-Laki</option>
                                        <option value="P" @if($siswa->jenis_kelamin == 'P') selected @endif >Perempuan</option>
                                      </select>
                                      <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tempat Lahir</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input name="tempat_lahir" type="text" class="form-control"  value="{{$siswa->tempat_lahir}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tanggal Lahir</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                            <input name="tanggal_lahir" type="datepicker" class="form-control datepicker" value="{{$siswa->tanggal_lahir}}">
                                        </div>
                                        <span class="help-block">.</span>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label">Alamat Lengkap</label>
                                    <div class="col-md-9 col-xs-12">
                                        <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="4">{{$siswa->alamat_sekarang ?? ''}}</textarea>
                                    </div>
                                    <span class="help-block">.</span>
                                </div>
                            </div>

                            <div class="col-md-6">

                              <div class="form-group">
                                  <label class="col-md-3 control-label">Kewarga- negaraan</label>
                                  <div class="col-md-9">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                          <input name="kebangsaan" type="text" class="form-control"  value="{{$siswa->kebangsaan}}">
                                      </div>
                                      <span class="help-block">.</span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-3 control-label">Agama</label>
                                  <div class="col-md-9">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                          <input name="agama" type="text" class="form-control"  value="{{$siswa->agama}}">
                                      </div>
                                      <span class="help-block">.</span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-3 control-label">No Hp</label>
                                  <div class="col-md-9">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                          <input name="no_phone" type="tel" class="form-control"  value="{{$siswa->no_phone}}">
                                      </div>
                                      <span class="help-block">.</span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-3 control-label">Email</label>
                                  <div class="col-md-9">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                          <input name="email_siswa" type="email" class="form-control"  value="{{$siswa->email_siswa}}">
                                      </div>
                                      <span class="help-block">.</span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-3 control-label">Anak Ke</label>
                                  <div class="col-md-9">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                          <input name="anak_ke" type="text" class="form-control"  value="{{$siswa->siswadetail->anak_ke ?? ''}}" placeholder="Masukan Anak Keberapa">
                                      </div>
                                      <span class="help-block">.</span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-3 control-label">Jumlah Saudara</label>
                                  <div class="col-md-9">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                          <input name="jumlah_saudara" type="text" class="form-control"  value="{{$siswa->siswadetail->jumlah_saudara ?? ''}}" placeholder="Masukan Jumlah Saudara">
                                      </div>
                                      <span class="help-block">.</span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-3 control-label">Kondisi Siswa</label>
                                  <div class="col-md-9">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                          <input name="kondisi_siswa" type="text" class="form-control"  value="{{$siswa->siswadetail->kondisi_siswa ?? ''}}" placeholder="Masukan Kondisi Siswa">
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

              <div class="tab-pane " id="tab-third">
                <form action="{{route('admin.siswa.updatedatapendidikan', $siswa->id)}}" method="post">
                  {{csrf_field()}}
                  <div class="row">
                    <div class="col-md-6">

                      <div class="form-group">
                          <label class="col-md-3 control-label">Asal SD/MI</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input name="asal_sd" type="text" class="form-control"  value="{{$siswa->siswadetail->asal_sd ?? ''}}" placeholder="Masukan Asal SD">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Asal SMP/MTS</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input name="asal_smp" type="text" class="form-control"  value="{{$siswa->siswadetail->asal_smp ?? ''}}" placeholder="Masukan Asal SMP">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">SMA/SMK/MA</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input type="text" class="form-control"  value="{{$data_sekolah->nama_sekolah ?? ''}}" disabled>
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

              <div class="tab-pane " id="tab-fourth">
                <form action="{{route('admin.siswa.updatedataorangtua', $siswa->id)}}" method="post">
                {{csrf_field()}}
                  <div class="row">
                    <div class="col-md-6">

                      <div class="form-group">
                          <label class="col-md-3 control-label">Nama Ayah</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input name="nama_ayah" type="text" class="form-control"  value="{{$siswa->siswadetail->nama_ayah ?? ''}}">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Jenis Kelamin</label>
                          <div class="col-md-9">
                            <div class="input-group">
                              <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                              <select name="" class="form-control select" id="exampleFormControlSelect1" disabled>
                                <option>Laki-Laki</option>
                                <option>Perempuan</option>
                              </select>
                            </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Pendidikan Terakhir</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input name="pendidikan_ayah" type="text" class="form-control"  value="{{$siswa->siswadetail->pendidikan_ayah ?? ''}}">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Pekerjaan</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input name="pekerjaan_ayah" type="text" class="form-control"  value="{{$siswa->siswadetail->pekerjaan_ayah ?? ''}}">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Penghasilan Ayah</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input name="penghasilan_ayah" type="text" class="form-control"  value="Rp. {{$siswa->siswadetail->penghasilan_ayah ?? ''}} /bln">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Alamat Lengkap Ayah</label>
                          <div class="col-md-9 col-xs-12">
                              <textarea name="alamat_lengkap_ayah" class="form-control" rows="5">{{$siswa->siswadetail->alamat_lengkap_ayah ?? ''}}</textarea>
                          </div>
                          <span class="help-block">.</span>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">No Hp</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input name="no_hp_ayah" type="tel" class="form-control"  value="{{$siswa->siswadetail->no_hp_ayah ?? ''}}">
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
                                  <input name="nama_ibu" type="text" class="form-control"  value="{{$siswa->siswadetail->nama_ibu ?? ''}}">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Jenis Kelamin</label>
                          <div class="col-md-9">
                            <div class="input-group">
                              <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                              <select name="" class="form-control select" style="display: none;" disabled>
                                <option>Perempuan</option>
                                <option>Laki-Laki</option>
                              </select>
                            </div>
                            <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Pendidikan Terakhir</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input name="pendidikan_ibu" type="text" class="form-control"  value="{{$siswa->siswadetail->pendidikan_ibu ?? ''}}">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Pekerjaan</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input name="pekerjaan_ibu" type="text" class="form-control"  value="{{$siswa->siswadetail->pekerjaan_ibu ?? ''}}">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Penghasilan Ibu</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input name="penghasilan_ibu" type="text" class="form-control"  value="Rp. {{$siswa->siswadetail->penghasilan_ibu ?? ''}} /bln">
                              </div>
                              <span class="help-block">.</span>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Alamat Lengkap Ibu</label>
                          <div class="col-md-9 col-xs-12">
                              <textarea name="alamat_lengkap_ibu" class="form-control" rows="5">{{$siswa->siswadetail->alamat_lengkap_ibu ?? ''}}</textarea>
                          </div>
                          <span class="help-block">.</span>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">No Hp</label>
                          <div class="col-md-9">
                              <div class="input-group">
                                  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                  <input name="no_hp_ibu" type="tel" class="form-control"  value="{{$siswa->siswadetail->no_hp_ibu ?? ''}}">
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

              <!-- <div class="tab-pane " id="tab-five">
                <div class="row">
                  <div class="col-md-6">

                    <div class="panel panel-default">

                      <div class="panel-heading ui-draggable-handle">
                            <h3 class="panel-title"><span class="fa fa-pencil-square-o"></span> Tugas</h3>
                            <ul class="panel-controls">
                              <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                              <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                            </ul>
                        </div>
                        <div class="panel-body">
                          <div class="row">
                            <div class="panel-heading">
                              <h2><span class="fa fa-pencil-square-o"></span> Matematika</h2>
                              <div class="user">
                                <img src="{{asset('admin/assets/images/users/user4.jpg')}}" alt="Nadia Ali">
                                <a href="#" class="name">Maman Suherman S.Pd</a>
                                <div class="pull-right" style="width: 100px;">
                                  <button class="btn btn-info btn-block"><span class="fa fa-comment"></span> Chat</button>
                                </div>
                              </div>
                            </div>
                            <div class="panel-body list-group">
                              <div class="list-group-item">
                                Tugas 1 <a href="#">#Download</a> Massa vulputate at. Sed imperdiet congue enim.<br>
                                <span class="text-muted">1h ago</span>
                              </div>
                              <div class="list-group-item">
                                Tugas 2 <a href="#">#Download</a> Nam faucibus vulputate justo, id viverra orci porta vel.<br>
                                <span class="text-muted">1h ago</span>
                              </div>
                            </div>
                          </div><br>


                          <div class="row">
                            <div class="panel-heading">
                                <h2><span class="fa fa-pencil-square-o"></span> Biologi</h2>
                                <div class="user">
                                    <img src="{{asset('admin/assets/images/users/user4.jpg')}}" alt="Nadia Ali">
                                    <a href="#" class="name">Eman Suheman S.Pd</a>
                                    <div class="pull-right" style="width: 100px;">
                                        <button class="btn btn-info btn-block"><span class="fa fa-comment"></span> Chat</button>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body list-group">
                                <div class="list-group-item">
                                  Tugas 1 <a href="#">#Download</a> Massa vulputate at. Sed imperdiet congue enim.<br>
                                    <span class="text-muted">1h ago</span>
                                </div>
                                <div class="list-group-item">
                                  Tugas 2 <a href="#">#Download</a> Nam faucibus vulputate justo, id viverra orci porta vel.<br>
                                    <span class="text-muted">1h ago</span>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>

                  </div>

                  <div class="col-md-6">

                    <div class="panel panel-default">

                      <div class="panel-heading ui-draggable-handle">
                            <h3 class="panel-title"><span class="fa fa-file-text"></span> Kuis</h3>
                            <ul class="panel-controls">
                              <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                              <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                            </ul>
                        </div>
                        <div class="panel-body">
                          <div class="row">
                            <div class="panel-heading">
                              <h2><span class="fa fa-file-text"></span> Matematika</h2>
                              <div class="user">
                                <img src="{{asset('admin/assets/images/users/user4.jpg')}}" alt="Nadia Ali">
                                <a href="#" class="name">Maman Suherman S.Pd</a>
                                <div class="pull-right" style="width: 100px;">
                                  <button class="btn btn-info btn-block"><span class="fa fa-comment"></span> Chat</button>
                                </div>
                              </div>
                            </div>
                            <div class="panel-body list-group">
                              <div class="list-group-item">
                                Tugas 1 <a href="#">#Download</a> Massa vulputate at. Sed imperdiet congue enim.<br>
                                <span class="text-muted">1h ago</span>
                              </div>
                              <div class="list-group-item">
                                Tugas 2 <a href="#">#Download</a> Nam faucibus vulputate justo, id viverra orci porta vel.<br>
                                <span class="text-muted">1h ago</span>
                              </div>
                            </div>
                          </div><br>


                          <div class="row">
                            <div class="panel-heading">
                                <h2><span class="fa fa-file-text"></span> Biologi</h2>
                                <div class="user">
                                    <img src="{{asset('admin/assets/images/users/user4.jpg')}}" alt="Nadia Ali">
                                    <a href="#" class="name">Eman Suheman S.Pd</a>
                                    <div class="pull-right" style="width: 100px;">
                                        <button class="btn btn-info btn-block"><span class="fa fa-comment"></span> Chat</button>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body list-group">
                                <div class="list-group-item">
                                  Tugas 1 <a href="#">#Download</a> Massa vulputate at. Sed imperdiet congue enim.<br>
                                    <span class="text-muted">1h ago</span>
                                </div>
                                <div class="list-group-item">
                                  Tugas 2 <a href="#">#Download</a> Nam faucibus vulputate justo, id viverra orci porta vel.<br>
                                    <span class="text-muted">1h ago</span>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>

                  </div>
                </div>

              </div> -->

          </div>
      </div>
      <!-- END TABS -->
    </div>


  </div>
</div>
<!-- END DEFAULT DATATABLE -->

@stop
