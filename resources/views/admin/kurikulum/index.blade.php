@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Kurikulum
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Kurikulum</li>
    </ul>
@endsection

@section('content')
    @include('layouts.alert')
    <div class="card card-px-0 bg-opacity-0">
        <div class="card-header border-0 pb-5">
            <div class="d-flex align-items-center position-relative me-4">
                <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                <input type="text" id="table_search"
                    class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                    placeholder="Search">
            </div>
            <div class="card-toolbar">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#tambah">Tambah</button>
            </div>
        </div>
        <div class="card-body py-0">
            <table id="table_data"
                class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                <thead class="fs-5 fw-semibold bg-light">
                    <tr>
                        <th class="min-w-80px">No</th>
                        <th class="min-w-150px">Nama Kurikulum</th>
                        <th class="min-w-250px">Fakultas</th>
                        <th class="min-w-250px">Jurusan</th>
                        <th class="min-w-250px">Program Studi</th>
                        <th class="min-w-150px">Mulai Semester</th>
                        <th class="min-w-150px">Mulai Tahun Ajaran</th>
                        <th class="min-w-150px">Jumlah SKS Lulus</th>
                        <th class="min-w-150px">Jumlah SKS Wajib</th>
                        <th class="min-w-150px">Jumlah SKS Pilihan</th>
                        <th class="min-w-250px text-end">Opsi</th>
                    </tr>
                </thead>
                <tbody class="fs-6 fw-semibold text-gray-600">
                    <?php $no = 0;
                    $f = 0;
                    $j = 0;
                    $p = 0;
                    ?>
                    @foreach ($kurikulum as $kurikulum)
                        <?php $no++;
                        $f++;
                        $j++;
                        $p++;
                        ?>
                        <tr>
                            <td>{{ $no }}</td>
                            <td><a href="{{ route('admin.kurikulum.detail', ['id' => $kurikulum->id]) }}">{{ $kurikulum->nama_kurikulum }}</a></td>
                            <td>{{ $kurikulum->nama_fakultas }}</td>
                            <td>{{ $kurikulum->nama_jurusan }}</td>
                            <td>{{ $kurikulum->nama_program_studi }}</td>
                            <td>{{ $kurikulum->nama_semester }}</td>
                            <td>{{ $kurikulum->nama_tahun_ajaran }}</td>
                            <td>{{ $kurikulum->jumlah_sks_lulus }}</td>
                            <td>{{ $kurikulum->jumlah_sks_wajib }}</td>
                            <td>{{ $kurikulum->jumlah_sks_pilihan }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.kurikulum.detail', ['id' => $kurikulum->id]) }}"
                                    class="btn btn-sm btn-info">Detail</a>
                                <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editKurikulum{{ $kurikulum->id }}">Edit</a>
                                <a href="{{ route('admin.kurikulum.destroy', $kurikulum->id) }}"
                                    class="btn btn-sm btn-danger" onclick="return confirm('Yakin Mau di Hapus ?')">Hapus</a>

                            </td>
                        </tr>
                        <!-- Modal edit-->
                        <div class="modal fade" id="editKurikulum{{ $kurikulum->id }}" data-backdrop="static"
                            tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Edit Kurikulum</h3>
                                        <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i class="bi bi-x-lg fs-3"></i>
                                        </div>
                                    </div>

                                    <div class="modal-body">

                                        <form action="{{ route('admin.kurikulum.update', $kurikulum->id) }}"
                                            method="post">
                                            @csrf

                                            <div class="fv-row mb-5">
                                                <label class="form-label">Nama Kurikulum</label>
                                                <input name="nama_kurikulum" type="text" class="form-control"
                                                    value="{{ $kurikulum->nama_kurikulum }}" placeholder="Nama Kurikulum">
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label class="form-label">Fakultas</label>
                                                <select name="id_fakultas" id="id_fakultas{{ $f }}"
                                                    class="form-control">
                                                    @foreach ($fakultas as $fakul)
                                                        <option value="{{ $fakul->id }}"
                                                            {{ $kurikulum->id_fakultas == $fakul->id ? 'selected' : '' }}>
                                                            {{ $fakul->nama_fakultas }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <input name="jurusan" id="jurusan{{ $j }}" type="text"
                                                value="{{ $kurikulum->id_jurusan }}" hidden>
                                            <div class="fv-row mb-5">
                                                <label class="form-label">Jurusan</label>
                                                <select name="id_jurusan" id="id_jurusan{{ $j }}"
                                                    class="form-control">
                                                    <option value="">== Pilih Jurusan ==</option>
                                                </select>
                                            </div>

                                            <input name="prodi" id="prodi{{ $p }}" type="text"
                                                value="{{ $kurikulum->id_prodi }}" hidden>
                                            <div class="fv-row mb-5">
                                                <label class="form-label">Program Studi</label>
                                                <select name="id_prodi" id="id_prodi{{ $p }}"
                                                    class="form-control">
                                                    <option value="">== Pilih Prodi ==</option>
                                                </select>
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label class="form-label">Mulai Semester</label>
                                                <select name="id_semester" class="form-control">
                                                    @foreach ($semester as $semes)
                                                        <option value="{{ $semes->id }}"
                                                            {{ $kurikulum->id_semester = $semes->id ? 'selected' : '' }}>
                                                            {{ $semes->nama_semester }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label class="form-label">Mulai Tahun Ajaran</label>
                                                <select name="id_tahun_ajaran" class="form-control">
                                                    @foreach ($tahun_ajaran as $ajaran)
                                                        <option value="{{ $ajaran->id }}"
                                                            {{ $kurikulum->id_tahun_ajaran = $ajaran->id ? 'selected' : '' }}>
                                                            {{ $ajaran->nama_tahun_ajaran }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label class="form-label">Jumlah SKS Lulus</label>
                                                <input name="jumlah_sks_lulus" type="number" class="form-control"
                                                    value="{{ $kurikulum->jumlah_sks_lulus }}"
                                                    placeholder="Jumlah SKS Lulus">
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label class="form-label">Jumlah SKS Wajib</label>
                                                <input name="jumlah_sks_wajib" type="number" class="form-control"
                                                    value="{{ $kurikulum->jumlah_sks_wajib }}"
                                                    placeholder="Jumlah SKS Wajib">
                                            </div>

                                            <div class="fv-row mb-5">
                                                <label class="form-label">Jumlah SKS Pilihan</label>
                                                <input name="jumlah_sks_pilihan" type="number" class="form-control"
                                                    value="{{ $kurikulum->jumlah_sks_pilihan }}"
                                                    placeholder="Jumlah SKS Pilihan">
                                            </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal end-->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- BEGIN Modal Tambah-->
    <div class="modal fade" tabindex="-1" id="tambah">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.kurikulum.create') }}" method="post">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Kurikulum</h3>
                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-3"></i>
                    </div>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="fv-row mb-5">
                        <label class="form-label">Nama Kurikulum</label>
                        <input name="nama_kurikulum" type="text" class="form-control" placeholder="Nama Kurikulum">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Fakultas</label>
                        <select name="id_fakultas" id="id_fakultas" class="form-control">
                            @foreach ($fakultas as $fakultas)
                                <option value="{{ $fakultas->id }}">{{ $fakultas->nama_fakultas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Jurusan</label>
                        <select name="id_jurusan" id="id_jurusan" class="form-control">
                            <option value="">== Pilih Jurusan ==</option>
                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Program Studi</label>
                        <select name="id_prodi" id="id_prodi" class="form-control">
                            <option value="">== Pilih Prodi ==</option>
                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Mulai Semester</label>
                        <select name="id_semester" class="form-control">
                            @foreach ($semester as $semester)
                                <option value="{{ $semester->id }}">{{ $semester->nama_semester }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Mulai Tahun Ajaran</label>
                        <select name="id_tahun_ajaran" class="form-control">
                            @foreach ($tahun_ajaran as $tahun_ajaran)
                                <option value="{{ $tahun_ajaran->id }}">{{ $tahun_ajaran->nama_tahun_ajaran }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Jumlah SKS Lulus</label>
                        <input name="jumlah_sks_lulus" type="number" class="form-control"
                            placeholder="Jumlah SKS Lulus">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Jumlah SKS Wajib</label>
                        <input name="jumlah_sks_wajib" type="number" class="form-control"
                            placeholder="Jumlah SKS Wajib">
                    </div>

                    <div class="fv-row mb-5">
                        <label class="form-label">Jumlah SKS Pilihan</label>
                        <input name="jumlah_sks_pilihan" type="number" class="form-control"
                            placeholder="Jumlah SKS Pilihan">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <!-- END Modal Tambah-->
@endsection

@section('css-add')
    <link rel="stylesheet" href="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.css') }}">
@endsection

@section('data-scripts')
    <script src="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        var ListData = function() {
            var table = document.getElementById('table_data');
            var datatable;
            var toolbarBase;

            // Private functions
            var initDataTable = function() {
                // Set date data order
                const tableRows = table.querySelectorAll('tbody tr');

                // Init datatable --- more info on datatables: https://datatables.net/manual/
                datatable = $(table).DataTable({
                    'order': [],
                    "pageLength": 10,
                    "lengthChange": true,
                    "info": true,
                    'columnDefs': [{
                            orderable: false,
                            targets: 10
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search');
                filterSearch.addEventListener('keyup', function(e) {
                    datatable.search(e.target.value).draw();
                });
            }

            return {
                // Public functions
                init: function() {
                    if (!table) {
                        return;
                    }

                    initDataTable();
                    handleSearchDatatable();

                }
            }
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            ListData.init();
        });
    </script>
    <script>
        var fakultas = document.getElementById("id_fakultas");
        if (fakultas && fakultas.value) {
            values = fakultas.value;
            if (values) {
                jQuery.ajax({
                    url: "{{ route('admin.kurikulum.jurusan', '') }}" + "/" + values,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        jQuery('#id_jurusan').empty();
                        jQuery.each(data, function(key, value) {
                            $('#id_jurusan').append('<option value="' + value + '">' + key +
                                '</option>');
                        });

                        var jurusan = document.getElementById("id_jurusan");

                        jQuery.ajax({
                            url: "{{ route('admin.kurikulum.prodi', '') }}" + "/" + jurusan.value,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                console.log(data);
                                jQuery('#id_prodi').empty();
                                jQuery.each(data, function(key, value) {
                                    $('#id_prodi').append('<option value="' + value + '">' +
                                        key + '</option>');
                                });
                            }
                        });
                    }
                });
            } else {
                $('select[name="id_jurusan"]').empty();
            }
        }



        $(document).on('change', '#id_fakultas', function() {
            var fakultas = jQuery(this).val();
            if (fakultas) {
                jQuery.ajax({
                    url: "{{ route('admin.kurikulum.jurusan', '') }}" + "/" + fakultas,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        jQuery('#id_jurusan').empty();
                        jQuery.each(data, function(key, value) {
                            $('#id_jurusan').append('<option value="' + value + ' ">' + key +
                                '</option>');

                        });

                        var jurusan = document.getElementById("id_jurusan");
                        jQuery.ajax({
                            url: "{{ route('admin.kurikulum.prodi', '') }}" + "/" + jurusan
                                .value,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                console.log(data);
                                jQuery('#id_prodi').empty();
                                jQuery.each(data, function(key, value) {
                                    $('#id_prodi').append('<option value="' +
                                        value + '">' + key + '</option>');
                                });
                            }
                        });
                    }
                });
            } else {
                $('select[name="id_jurusan"]').empty();
            }


        });


        $(document).on('change', '#id_jurusan', function() {
            var jurusan = jQuery(this).val();
            if (jurusan) {
                jQuery.ajax({
                    url: "{{ route('admin.kurikulum.prodi', '') }}" + "/" + jurusan,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        jQuery('#id_prodi').empty();
                        jQuery.each(data, function(key, value) {
                            $('#id_prodi').append('<option value="' + value + '">' + key +
                                '</option>');
                        });
                    }
                });
            } else {
                $('select[name="id_prodi"]').empty();
            }
        });


        //Select Option Edit

        var jumlah = document.getElementById("jumlah");
        for (let i = 1; i <= jumlah.value; i++) {
            //jurusan
            $(document).on('change', '#id_fakultas' + i + '', function() {
                var id_jurusan = jQuery(this).val();
                if (id_jurusan) {
                    jQuery.ajax({
                        url: "{{ route('admin.kurikulum.jurusan', '') }}" + "/" + id_jurusan,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            jQuery('#id_jurusan' + i + '').empty();
                            jQuery.each(data, function(key, value) {
                                $('#id_jurusan' + i + '').append('<option value="' + value +
                                    '">' + key + '</option>');
                            });

                            var jurusan = document.getElementById("id_jurusan" + i);
                            jQuery.ajax({
                                url: "{{ route('admin.kurikulum.prodi', '') }}" + "/" +
                                    jurusan.value,
                                type: "GET",
                                dataType: "json",
                                success: function(data) {
                                    console.log(data);
                                    jQuery('#id_prodi' + i).empty();
                                    jQuery.each(data, function(key, value) {
                                        $('#id_prodi' + i).append(
                                            '<option value="' + value + '">' +
                                            key + '</option>');
                                    });
                                }
                            });
                        }
                    });
                } else {
                    $('select[name="id_jurusan' + i + '"]').empty();
                }

                var myInput2 = document.getElementById("id_jurusan" + i);
                if (myInput2 && myInput2.value) {
                    console.log("jurusan = " + myInput2.value);
                    var jurusan = myInput2.value;
                    if (jurusan) {
                        jQuery.ajax({
                            url: "{{ route('admin.kurikulum.prodi', '') }}" + "/" + jurusan,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                var prodi = document.getElementById('prodi' + i);
                                jQuery('#id_prodi' + i).empty();
                                jQuery.each(data, function(key, value) {
                                    if (prodi.value != value) {
                                        $('#id_prodi' + i).append('<option value="' + value +
                                            '" >' + key + '</option>');
                                    } else {
                                        $('#id_prodi' + i).append('<option value="' + value +
                                            '" selected >' + key + '</option>');
                                    }
                                });
                            }
                        });
                    } else {
                        $('select[name="id_prodi"' + i + ']').empty();
                    }
                }

            });

            var myInput2 = document.getElementById("id_fakultas" + i);
            if (myInput2 && myInput2.value) {
                var jurusan = myInput2.value;
                if (jurusan) {
                    jQuery.ajax({
                        url: "{{ route('admin.kurikulum.jurusan', '') }}" + "/" + jurusan,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var prodi = document.getElementById('jurusan' + i);
                            jQuery('#id_jurusan' + i).empty();
                            jQuery.each(data, function(key, value) {
                                if (prodi.value != value) {
                                    $('#id_jurusan' + i).append('<option value="' + value + '" >' +
                                        key + '</option>');
                                } else {
                                    $('#id_jurusan' + i).append('<option value="' + value +
                                        '" selected >' + key + '</option>');
                                }
                            });
                        }
                    });
                } else {
                    $('select[name="id_jurusan"' + i + ']').empty();
                }
            }

            //prodi
            $(document).on('change', '#id_jurusan' + i + '', function() {
                var id_jurusan = jQuery(this).val();
                if (id_jurusan) {
                    jQuery.ajax({
                        url: "{{ route('admin.kurikulum.prodi', '') }}" + "/" + id_jurusan,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            jQuery('#id_prodi' + i + '').empty();
                            jQuery.each(data, function(key, value) {
                                $('#id_prodi' + i + '').append('<option value="' + value +
                                    '">' + key + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="id_prodi' + i + '"]').empty();
                }
            });

            var myInput2 = document.getElementById("jurusan" + i);
            if (myInput2 && myInput2.value) {
                var jurusan = myInput2.value;
                if (jurusan) {
                    jQuery.ajax({
                        url: "{{ route('admin.kurikulum.prodi', '') }}" + "/" + jurusan,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var prodi = document.getElementById('prodi' + i);
                            jQuery('#id_prodi' + i).empty();
                            jQuery.each(data, function(key, value) {
                                if (prodi.value != value) {
                                    $('#id_prodi' + i).append('<option value="' + value + '" >' + key +
                                        '</option>');
                                } else {
                                    $('#id_prodi' + i).append('<option value="' + value +
                                        '" selected >' + key + '</option>');
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
@endsection
