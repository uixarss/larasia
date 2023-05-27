@extends('layouts.adtheme')

@section('toolbar')
    <div class="app-toolbar  py-3 py-lg-6 ">
        <div class="app-container container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 my-4">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Kalender Akademik
                </h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="page-content">
        @can('manage-users')
            @include('admin.kalenderakademik.modal-calendar')
            @include('admin.kalenderakademik.modal-list-remainder')
        @endcan
        <div id='wrap'>
            <div class="content-frame">


                <div class="content-frame">
                    <div id='external-events-b'>
                        <!-- <button class="btn btn-primary">Halaman Utama <i class="fa fa-home"></i></button> -->
                        @can('manage-users')
                            <h4>List Remainder</h4>
                            <button type="submit" class="btn btn-primary">Kembali Halaman Utama</button>
                        @endcan
                        <div id='external-events-list'>
                            @can('manage-users')
                                @if ($listRemainder)
                                    @foreach ($listRemainder as $remainder)
                                        <div style="padding: 4px; border: 1px solid {{ $remainder->color }}; background-color: {{ $remainder->color }}"
                                            class='fc-event event text-center'
                                            data-event='{"id":"{{ $remainder->id }}","title":"{{ $remainder->title }}","color":"{{ $remainder->color }}","start":"{{ $remainder->start }}","end":"{{ $remainder->end }}"}'>
                                            {{ $remainder->title }}
                                        </div>
                                    @endforeach
                                @endif
                            @endcan
                        </div>
                        @can('manage-users')
                            <p>
                                <input type='checkbox' id='drop-remove' />
                                <label for='drop-remove'>remove after drop</label>
                                <button class="btn btn-sm btn-success" id="newListRemainder"
                                    style="font-size: 1em; width: 100%;">Tambah List Remainder</button>
                            </p>
                        @endcan
                    </div>

                    <div id="calendar-list">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-calendar"></span> List Seluruh Kegiatan Kampus
                                </h3>
                                {{ $events->links() }}
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    @foreach ($events as $event)
                                        <div class="list-group border-bottom">
                                            <div class="list-group-item"><span class="fa fa-circle"
                                                    style="color:{{ $event->color }}"></span>
                                                <b>{{ $event->title }}</b>
                                                <p class="push-up-10">
                                                    <span>
                                                        <p class="push-down-0">Deskripsi :</p>
                                                    </span>
                                                    {{ $event->description }}
                                                </p>
                                                <p class="push-up-20">Mulai : {{ $event->start }}</p>
                                                <p>Sampai : {{ $event->end }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="content-frame padding-bottom-0">
                    <div id='calendar' data-route-load-events="{{ route('routeLoadEvents') }}"
                        data-route-update-events="{{ route('routeUpdateEvents') }}"
                        data-route-store-events="{{ route('routeStoreEvents') }}"
                        data-route-delete-events="{{ route('routeDeleteEvents') }}"
                        data-route-delete-list-remainder="{{ route('routeDeleteListRemainder') }}"
                        data-route-update-list-remainder="{{ route('routeUpdateListRemainder') }}"
                        data-route-store-list-remainder="{{ route('routeStoreListRemainder') }}"></div>
                </div>

                <div style='clear:both'></div>
            </div>
        </div>
    </div>
@endsection

@section('css-add')
    <link rel="stylesheet" type="text/css" id="theme" href="{{ asset('admin/css/theme-default-kalender.css') }}" />
    <link href="{{ asset('assets/fullcalendar/packages/core/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('assets/fullcalendar/packages/daygrid/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('assets/fullcalendar/packages/timegrid/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('assets/fullcalendar/packages/list/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('assets/fullcalendar/css/style.css') }}" rel='stylesheet' />
@endsection

@section('data-scripts')
    <script src="{{ asset('assets/fullcalendar/packages/core/main.js') }}"></script>
    <script src="{{ asset('assets/fullcalendar/packages/interaction/main.js') }}"></script>
    <script src="{{ asset('assets/fullcalendar/packages/daygrid/main.js') }}"></script>
    <script src="{{ asset('assets/fullcalendar/packages/timegrid/main.js') }}"></script>
    <script src="{{ asset('assets/fullcalendar/packages/list/main.js') }}"></script>
    <script src="{{ asset('assets/fullcalendar/packages/core/locales-all.js') }}"></script>
    <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('assets/fullcalendar/js/script.js') }}"></script>
    <script src="{{ asset('assets/fullcalendar/js/calendar.js') }}"></script>
@endsection
