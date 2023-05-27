@extends('layouts.adtheme')

@section('content')
@include('admin.kalenderakademik.modal-calendar')
@include('admin.kalenderakademik.modal-list-remainder')

<div class="content-frame-left">
    <div id='external-events'>
        <h4>List Kalender Akademik</h4>

        <div id='external-events-list'>
            @isset($listRemainder)
                @forelse($listRemainder as $remainder)
                    <div id="boxListRemainder {{ $remainder->id }}"
                        style="padding: 4px; border: 1px solid {{ $remainder->color }}; background-color: {{ $remainder->color }}"
                        class='fc-event event text-center'
                        data-event='{"id":"{{ $remainder->id }}","title":"{{ $remainder->title }}","color":"{{ $remainder->color }}","start":"{{ $remainder->start }}","end":"{{ $remainder->end }}"}'>
                        {{ $remainder->title }}
                    </div>
                @empty
                    <p>Tidak ada List Kalender Akademik</p>
                @endforelse
            @endisset
        </div>

        <p>
            <input type='checkbox' id='drop-remove' />
            <label for='drop-remove'>remove after drop</label>
            <button class="btn btn-sm btn-success" id="newListRemainder" style="font-size: 1em; width: 100%;">Tambah List Kalender Akademik</button>
        </p>
    </div>
</div>
    <div id='calendar'
        data-route-load-events="{{ route('routeLoadEvents') }}"
        data-route-update-events="{{ route('routeUpdateEvents') }}"
        data-route-store-events="{{ route('routeStoreEvents') }}"
        data-route-delete-events="{{ route('routeDeleteEvents') }}"
        data-route-delete-list-remainder="{{ route('routeDeleteListRemainder') }}"
        data-route-update-list-remainder="{{ route('routeUpdateListRemainder') }}"
        data-route-store-list-remainder="{{ route('routeStoreListRemainder') }}">
    </div>
@endsection

@section('css-add')
    <link href="{{ asset('assets/fullcalendar/packages/core/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('assets/fullcalendar/packages/daygrid/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('assets/fullcalendar/packages/timegrid/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('assets/fullcalendar/packages/list/main.css') }}" rel='stylesheet' />

    <link href="{{ asset('assets/fullcalendar/css/style.css') }}" rel='stylesheet' />
    <link href="{{ asset('adtheme/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('data-scripts')
    <script src="{{ asset('assets/fullcalendar/packages/core/main.js') }}"></script>
    <script src="{{ asset('assets/fullcalendar/packages/interaction/main.js') }}"></script>
    <script src="{{ asset('assets/fullcalendar/packages/daygrid/main.js') }}"></script>
    <script src="{{ asset('assets/fullcalendar/packages/timegrid/main.js') }}"></script>
    <script src="{{ asset('assets/fullcalendar/packages/list/main.js') }}"></script>

    <script src="{{ asset('assets/fullcalendar/packages/core/locales-all.js') }}"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> --}}

    <script src="{{ asset('assets/fullcalendar/js/script.js') }}"></script>
    <script src="{{ asset('assets/fullcalendar/js/calendar.js') }}"></script>

    {{-- <script src="{{ asset('adtheme/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script> --}}
@endsection
