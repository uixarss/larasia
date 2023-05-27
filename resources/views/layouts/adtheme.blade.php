<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    @yield('css-add')
    <link href="{{ asset('adtheme/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adtheme/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>

<body id="kt_app_body"
    @role('admin|dosen')
    data-kt-app-layout="light-sidebar" data-kt-app-header-fixed="true"
    data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true"
    data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true"
    @endrole
    @role('mahasiswa|perpustakaan|pegawai')
    data-kt-app-layout="dark-header" data-kt-app-header-fixed="true"
    data-kt-app-toolbar-enabled="true"
    @endrole
    class="app-default">
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid " id="kt_app_page">
            @include('layouts.partials._header')
            <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
                @role('admin|dosen')
                @include('layouts.partials._sidebar')
                @endrole
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <div class="d-flex flex-column flex-column-fluid">
                        @yield('toolbar')
                        <div id="kt_app_content" class="app-content  flex-column-fluid">
                            <div id="kt_app_content_container" class="app-container container-fluid">
                                @include('layouts.partials._alert')
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="logoutAlert">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('logout') }}" method="POST">
                @csrf
                <div class="modal-body d-flex flex-column flex-sm-row pb-5">
                    <i class="bi bi-exclamation-diamond-fill fs-2hx me-5 mb-5 mb-sm-0 text-warning"></i>
                    <div class="d-flex flex-column text-gray-700">
                        <h4 class="mb-2">Ingin keluar dari sistem?</h4>
                        <span>Apakah Anda yakin ingin keluar? Tekan <b>"Ya"</b> untuk keluar dari pengguna yang sedang
                            login saat ini.</span>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary">Ya</button>
                </div>
            </form>
        </div>
    </div>

    @role('admin')
        <div class="modal fade" tabindex="-1" id="pengaturan">
            <div class="modal-dialog">
                <form class="modal-content" action="{{ route('admin.pengaturan.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h3 class="modal-title">Pengaturan Sistem</h3>
                        <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x-lg fs-3"></i>
                        </div>
                    </div>
                    <div class="modal-body">
                            <input name="name" type="hidden" class="form-control" value="{{ auth()->user()->name }}">
                            <input name="email" type="hidden" class="form-control" value="{{ auth()->user()->email }}">
                        <div class="fv-row mb-5">
                            <label class="form-label">Nama Sekolah</label>
                            <input name="nama_sekolah" type="text" class="form-control" value="{{ $data_sekolah->nama_sekolah ?? '' }}">
                        </div>

                        <div class="fv-row mb-5">
                            <label class="form-label">Alamat Sekolah</label>
                            <textarea name="alamat_sekolah" class="form-control" >{{ $data_sekolah->alamat_sekolah ?? '' }}</textarea>
                        </div>

                        <div class="fv-row mb-5">
                            <label class="form-label">No Telephon</label>
                            <input name="no_phone" type="text" class="form-control"
                                value="{{ $data_sekolah->no_phone ?? '' }}">
                        </div>

                        <div class="fv-row mb-5">
                            <label class="form-label">Logo Sekolah</label>
                            <input type="file" class="form-control" name="photo_logo" id="filename" title="Browse file">
                            <span class="help-block">* Format Gambar Harus .PNG</span>
                        </div>

                        <div class="fv-row mb-5">
                            <label class="form-label">Latitude</label>
                            <input name="latitude" type="text" class="form-control" id="latitude"
                                value="{{ $data_sekolah->latitude ?? '' }}">
                        </div>

                        <div class="fv-row mb-5">
                            <label class="form-label">Longitude</label>
                            <input name="longitude" type="text" class="form-control" id="longitude"
                                value="{{ $data_sekolah->longitude ?? '' }}">
                        </div>

                        <div class="fv-row">
                            <a href="#getlocation" id="btn_get_location" class="btn btn-sm btn-info">Get
                                location</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="profil">
            <div class="modal-dialog">
                <form class="modal-content" action="{{ route('admin.pengaturan.update') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Profile</h3>
                        <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x-lg fs-3"></i>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="fv-row mb-5">
                            <label class="form-label">Nama</label>
                            <input name="name" type="text" class="form-control" value="{{ auth()->user()->name }}">
                        </div>

                        <div class="fv-row mb-5">
                            <label class="form-label">Alamat Email</label>
                            <input name="email" type="text" class="form-control"
                                value="{{ auth()->user()->email }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input name="password" type="password" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endrole


    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <span class="menu-icon">
            <i class="bi bi-rocket fs-3"></i>
        </span>
    </div>

    <script src="{{ asset('adtheme/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('adtheme/js/scripts.bundle.js') }}"></script>
    @yield('data-scripts')

    @role('admin')
        <script type="text/javascript"
            src="http://maps.google.com/maps/api/js?key=AIzaSyDxB62KiQX8odWh4wq5M_UY-0v_Sde74a4&libraries=geometry">
            //calculates distance between two points in km's
            $('#btn-loc').click(function() {
                getLocation();
            });

            function calcDistance(p1, p2) {
                return (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2);
            }

            function getPosition(position) {
                var userPosition = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                $.getJSON("places.json", function(data) {
                    for (var i = 0; i < data.length; i++) {

                        var p1 = new google.maps.LatLng(userPosition.lat, userPosition.lng);
                        var p2 = new google.maps.LatLng(data[i].lat, data[i].lng);

                        var distance = calcDistance(p1, p2) * 1000;

                        if ((distance * 1000) <= 100) {
                            html += '<p>' + data[i].location + ' - ' + data[i].code + '</p>';
                            $('#nearbystops').append(html);
                        }

                        console.log(html);

                    }

                })
            }

            // get user's current latitude & longitude
            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(getPosition);
                } else {
                    alert("Geolocation is not supported by this browser.");
                }
            }
        </script>
        <script>
            $(document).ready(function() {
                // if (navigator.geolocation) {
                //   navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
                // } else {
                //   alert('It seems like Geolocation, which is required for this page, is not enabled in your browser.');
                // }

            });


            function successFunction(position) {
                var lat = position.coords.latitude;
                var long = position.coords.longitude;

                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = long;


            }

            function errorFunction(position) {
                alert('Error!');
            }

            $('#btn_get_location').click(function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
                } else {
                    alert(
                        'It seems like Geolocation, which is required for this page, is not enabled in your browser.'
                    );
                }
            });
        </script>
    @endrole
</body>

</html>
