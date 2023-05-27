@extends('layouts.adtheme')

@section('title-page')
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Akun Pengguna
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.halamanutama.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">Akun Pengguna</li>
    </ul>
@endsection

@section('content')

    <div class="card">
        <div class="card-header border-0">
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                <li class="nav-item">
                    <a class="nav-link active text-active-primary py-5" data-bs-toggle="tab" href="#users">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary py-5" data-bs-toggle="tab" href="#roles">Role</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary py-5" data-bs-toggle="tab" href="#permissions">Permission</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="users" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack mb-5">
                        <div class="d-flex align-items-center position-relative me-4">
                            <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                            <input type="text" id="table_search_user"
                                class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                placeholder="Search">
                        </div>

                        <div class="d-flex my-2">
                            <button type="button" class="btn btn-primary fw-bolder" data-bs-toggle="modal"
                                data-bs-target="#tambah_user">Tambah</button>
                        </div>
                    </div>
                    <table id="table_users"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th class="min-w-40px">No</th>
                                <th class="min-w-175px">Nama</th>
                                <th class="min-w-175px">Email</th>
                                <th class="min-w-50px">Roles</th>
                                <th class="min-w-200px text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ implode(',',$user->roles()->get()->pluck('name')->toArray()) }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        @can('delete-users')
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    class="pull-left">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- BEGIN Modal Tambah-->
                    <div class="modal fade" tabindex="-1" id="tambah_user">
                        <div class="modal-dialog">
                            <form class="modal-content" action="{{ route('admin.users.admin.tambah') }}" method="post">
                                <div class="modal-header">
                                    <h3 class="modal-title">Tambah Role</h3>
                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    @csrf

                                    <div class="fv-row mb-5">
                                        <label class="form-label" for="name">Nama Lengkap</label>
                                        <input name="name" type="text" class="form-control"
                                            placeholder="Masukan Nama Lengkap" required>
                                    </div>

                                    <div class="fv-row mb-5">
                                        <label class="form-label" for="email">Email</label>
                                        <input name="email" type="email" class="form-control"
                                            placeholder="Masukan Email" required>
                                    </div>

                                    <div class="fv-row">
                                        <label class="form-label" for="password">Password</label>
                                        <input name="password" type="password" class="form-control"
                                            placeholder="Masukan Password" required>
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
                </div>
                <div class="tab-pane fade" id="roles" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack mb-5">
                        <div class="d-flex align-items-center position-relative me-4">
                            <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                            <input type="text" id="table_search_role"
                                class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                placeholder="Search">
                        </div>

                        <div class="d-flex my-2">
                            <button type="button" class="btn btn-primary fw-bolder" data-bs-toggle="modal"
                                data-bs-target="#tambah_role">Tambah</button>
                        </div>
                    </div>
                    <table id="table_roles"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th class="min-w-40px">No</th>
                                <th class="min-w-150px">Nama</th>
                                <th class="min-w-150px">Waktu Dibuat</th>
                                <th class="min-w-150px">Waktu Update</th>
                                <th class="min-w-200px text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($data_roles as $no => $roles)
                                <tr>
                                    <td> {{ ++$no }} </td>
                                    <td> {{ $roles->name }} </td>
                                    <td> {{ $roles->created_at }} </td>
                                    <td> {{ $roles->updated_at }} </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editlistrole{{ $roles->id }}">Edit</button>
                                        <a href="{{ route('admin.users.roles.delete', $roles->id) }}" type="button"
                                            name="button" class="btn btn-sm btn-danger">Hapus</a>
                                    </td>

                                    <!-- Modal edit kelas-->
                                    <div class="modal fade" id="editlistrole{{ $roles->id }}" data-backdrop="static"
                                        tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Edit Role {{ $roles->name }}</h3>
                                                    <div class="btn btn-icon btn-sm btn-danger ms-2"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="bi bi-x-lg fs-3"></i>
                                                    </div>
                                                </div>
                                                <div class="modal-body">

                                                    <form action="{{ route('admin.users.roles.update', $roles->id) }}"
                                                        method="post">
                                                        @csrf

                                                        <div class="form-group">
                                                            <label class="form-label" for="name_roles">Nama Role</label>
                                                            <input name="name_roles" type="text" class="form-control"
                                                                value="{{ $roles->name }}"
                                                                placeholder="Masukan Nama Roles" required>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-info">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal end-->

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <!-- BEGIN Modal Tambah-->
                    <div class="modal fade" tabindex="-1" id="tambah_role">
                        <div class="modal-dialog">
                            <form class="modal-content" action="{{ route('admin.users.roles.tambah') }}" method="post">
                                <div class="modal-header">
                                    <h3 class="modal-title">Tambah Role</h3>
                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    @csrf

                                    <div class="form-group">
                                        <label class="form-label" for="name_roles">Nama Role</label>
                                        <input name="name_roles" type="text" class="form-control"
                                            placeholder="Masukan Nama Roles" required>
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
                </div>
                <div class="tab-pane fade" id="permissions" role="tabpanel">
                    <div class="d-flex flex-wrap flex-stack mb-5">
                        <div class="d-flex align-items-center position-relative me-4">
                            <i class="bi bi-search position-absolute translate-middle-y top-50 ms-4 fs-4"></i>
                            <input type="text" id="table_search_permission"
                                class="form-control form-control form-control-solid bg-body fw-semibold fs-7 w-250px ps-11"
                                placeholder="Search">
                        </div>

                        <div class="d-flex my-2">
                            <button type="button" class="btn btn-primary fw-bolder" data-bs-toggle="modal"
                                data-bs-target="#tambah_permission">Tambah</button>
                        </div>
                    </div>
                    <table id="table_permission"
                        class="table align-middle table-rounded border table-row-bordered table-row-gray-100 bg-white gy-4 gs-9">
                        <thead class="fs-5 fw-semibold bg-light">
                            <tr>
                                <th class="min-w-40px">No</th>
                                <th class="min-w-150px">Nama</th>
                                <th class="min-w-150px">Waktu Dibuat</th>
                                <th class="min-w-150px">Waktu Update</th>
                                <th class="min-w-200px text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($data_permissions as $no => $permission)
                                <tr>
                                    <td> {{ ++$no }} </td>
                                    <td> {{ $permission->name }} </td>
                                    <td> {{ $permission->created_at }} </td>
                                    <td> {{ $permission->updated_at }} </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editlistpermission{{ $permission->id }}">Edit</button>
                                        <a href="{{ route('admin.users.permission.delete', $permission->id) }}"
                                            type="button" name="button" class="btn btn-sm btn-danger">Hapus</a>
                                    </td>

                                    <!-- Modal edit kelas-->
                                    <div class="modal fade" id="editlistpermission{{ $permission->id }}"
                                        data-backdrop="static" tabindex="-1" role="dialog"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Edit Permission {{ $permission->name }}</h3>
                                                    <div class="btn btn-icon btn-sm btn-danger ms-2"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="bi bi-x-lg fs-3"></i>
                                                    </div>
                                                </div>
                                                <div class="modal-body">

                                                    <form
                                                        action="{{ route('admin.users.permission.update', $permission->id) }}"
                                                        method="post">
                                                        @csrf

                                                        <div class="form-group">
                                                            <label class="form-label" for="name_permission">Nama
                                                                Permission</label>
                                                            <input name="name_permission" type="text"
                                                                class="form-control" value="{{ $permission->name }}"
                                                                placeholder="Masukan Nama Permission" required>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-info">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal end-->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="modal fade" tabindex="-1" id="tambah_permission">
                        <div class="modal-dialog">
                            <form class="modal-content" action="{{ route('admin.users.permission.tambah') }}"
                                method="post">
                                <div class="modal-header">
                                    <h3 class="modal-title">Tambah Permission</h3>
                                    <div class="btn btn-icon btn-sm btn-danger ms-2" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    @csrf

                                    <div class="form-group">
                                        <label class="form-label" for="name_roles">Nama Permission </label>
                                        <input name="name_permission" type="text" class="form-control"
                                            placeholder="Masukan Nama Permission" required>
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
                </div>
            </div>

        </div>
    </div>
@endsection

@section('css-add')
    <link rel="stylesheet" href="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.css') }}">
@endsection

@section('data-scripts')
    <script src="{{ asset('adtheme/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        var ListUser = function() {
            var table = document.getElementById('table_users');
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
                            targets: 4
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_user');
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

        var ListRole = function() {
            var table = document.getElementById('table_roles');
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
                            targets: 4
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_role');
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

        var ListPermission = function() {
            var table = document.getElementById('table_permission');
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
                            targets: 4
                        }, // Disable ordering on column 6 (actions)
                    ]
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.getElementById('table_search_permission');
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
            ListUser.init();
            ListRole.init();
            ListPermission.init();
        });
    </script>
@endsection
