@extends('layouts.joliadmin')

@section('content')


    <!-- START BREADCRUMB -->
    <ul class="breadcrumb push-down-0">
        <li><a href="{{ route('guru.halamanutama.index') }}">Halaman Utama</a></li>
        <li class="active">Chat </li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- START CONTENT FRAME -->
    <div class="content-frame">
        <!-- START CONTENT FRAME TOP -->
        <div class="content-frame-top">
            <div class="page-title">
                <!-- <h2><span class="fa fa-comment"></span> Chat <small>(1 unread)</small></h2> -->
                <h2><span class="fa fa-comment"></span> Chat Application</h2>

            </div>

            <div class="pull-right">
                <a class="btn btn-primary active" href="#chat" role="tab" data-toggle="tab"><span
                        class="fa fa-comment"></span> Mahasiswa</a>
                <!-- <a class="btn btn-primary" href="#kontak" role="tab" data-toggle="tab"><span class="fa fa-phone"></span> Orang Tua Mahasiswa</a> -->
            </div>
        </div>
        <!-- END CONTENT FRAME TOP -->

        <div class="tab-content">

            <div class="tab-pane active" id="chat">
                <div class="content-frame-left">

                    <!-- <div class="content-frame-top-left">
              <div class="input-group">
                <div class="input-group-addon">
                  <span class="fa fa-search"></span>
                </div>
                <input type="text" class="form-control" placeholder="Cari Disini ?">
                <div class="input-group-btn ">
                  <button class="btn btn-primary">Search</button>
                </div>
              </div>

            </div> -->


                    <div class="panel-body mail" style="height: 500px; overflow-y:scroll">

                        <div class="list-group list-group-contacts border-bottom push-down-10">
                            @foreach ($data_siswa as $siswa)
                                <a href="#" class="list-group-item push-down-10 active" id="{{ $siswa->user_id }}">
                                    @if ($siswa->unread)
                                        <span class="pending">{{ $siswa->unread }}</span>
                                    @endif

                                    <!-- <div class="border-bottom">
                    <div class="mail-date push-up-10 pull-right">Today, 11:21</div>

                  </div> -->
                                    <div class="list-group-status status-online"></div>
                                    <img src="{{ asset('admin/assets/images/users/user7.jpg') }}" class="pull-left"
                                        alt="Nadia Ali">
                                    <span class="contacts-title">{{ $siswa->nama_mahasiswa }}</span>
                                    <p>{{ $siswa->email }}.</p>

                                </a>
                            @endforeach

                        </div>

                    </div>

                </div>
            </div>

            <div class="tab-pane" id="kontak">

                <div class="content-frame-left">

                    <!-- <div class="content-frame-top-left">
              <div class="input-group">
                <div class="input-group-addon">
                  <span class="fa fa-search"></span>
                </div>
                <input type="text" class="form-control" placeholder="Cari Disini ?">
                <div class="input-group-btn ">
                  <button class="btn btn-primary">Search</button>
                </div>
              </div>

            </div> -->

                    <div class="panel-body mail" style="height: 500px; overflow-y:scroll">
                        <div class="list-group list-group-contacts border-bottom push-down-10">
                            @foreach ($data_ortu as $siswa)
                                <a href="#" class="list-group-item push-down-10 active" id="{{ $siswa->user_id }}">
                                    @if ($siswa->unread)
                                        <span class="pending">{{ $siswa->unread }}</span>
                                    @endif

                                    <!-- <div class="border-bottom">
                    <div class="mail-date push-up-10 pull-right">Today, 11:21</div>

                  </div> -->
                                    <div class="list-group-status status-online"></div>
                                    <img src="{{ asset('admin/assets/images/users/user7.jpg') }}" class="pull-left"
                                        alt="Nadia Ali">
                                    <span class="contacts-title">{{ $siswa->nama_orangtua }}</span>
                                    <p>{{ $siswa->email_orangtua }}.</p>


                                </a>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!-- START CONTENT FRAME BODY -->
        <div class="content-frame-body" id="messages">

        </div>
        <!-- END CONTENT FRAME BODY -->
    </div>
    <!-- END CONTENT FRAME -->

@endsection

@section('data-scripts')
    <script type="text/javascript" src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <script>
        var receiver_id = '';
        var my_id = "{{ Auth::id() }}";
        $(document).ready(function() {

            // ajax setup form csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('d06c23f33da76f4be629', {
                cluster: 'ap1',
                forceTLS: true
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                // alert(JSON.stringify(data));
                if (my_id == data.from) {
                    $('#' + data.to).click();
                } else if (my_id == data.to) {
                    if (receiver_id == data.from) {
                        // if receiver is selected, reload the selected user ...
                        $('#' + data.from).click();
                    } else {
                        // if receiver is not seleted, add notification for that user
                        var pending = parseInt($('#' + data.from).find('.pending').html());

                        if (pending) {
                            $('#' + data.from).find('.pending').html(pending + 1);
                        } else {
                            $('#' + data.from).append('<span class="pending">1</span>');
                        }
                    }
                }
            });

            $('.list-group-item').click(function() {
                $('.list-group-item').removeClass('active');
                $(this).addClass('active');
                $(this).find('.pending').remove();

                receiver_id = $(this).attr('id');
                console.log(receiver_id);
                $.ajax({
                    type: "get",
                    url: "message/" + receiver_id, // need to create this route
                    data: "",
                    cache: false,
                    success: function(data) {
                        $('#messages').html(data);
                        scrollToBottomFunc();
                    }
                });
            });

            $(document).on('keyup', '.input-text input', function(e) {
                var message = $(this).val();

                // check if enter key is pressed and message is not null also receiver is selected
                if (e.keyCode == 13 && message != '' && receiver_id != '') {
                    $(this).val(''); // while pressed enter text box will be empty

                    var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                    $.ajax({
                        type: "post",
                        url: "message", // need to create this post route
                        data: datastr,
                        cache: false,
                        success: function(data) {

                        },
                        error: function(jqXHR, status, err) {},
                        complete: function() {
                            scrollToBottomFunc();
                        }
                    })
                }
            });




        });


        // make a function to scroll down auto
        function scrollToBottomFunc() {
            $('.message-wrapper').animate({
                scrollTop: $('.message-wrapper').get(0).scrollHeight
            }, 50);
        }
    </script>
@endsection

@section('css-add')
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 7px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #a7a7a7;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #929292;
        }

        ul {
            margin: 0;
            padding: 0;
        }

        li {
            list-style: none;
        }

        .user-wrapper,
        .message-wrapper {
            border: 1px solid #dddddd;
            overflow-y: auto;
        }

        .user-wrapper {
            height: 600px;
        }

        .user {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
        }

        .user:hover {
            background: #eeeeee;
        }

        .user:last-child {
            margin-bottom: 0;
        }

        .pending {
            position: absolute;
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }

        .media-left {
            margin: 0 10px;
        }

        .media-left img {
            width: 64px;
            border-radius: 64px;
        }

        .media-body p {
            margin: 6px 0;
        }

        .message-wrapper {
            padding: 10px;
            height: 536px;
            background: #eeeeee;
        }

        .messages .message {
            margin-bottom: 15px;
        }

        .messages .message:last-child {
            margin-bottom: 0;
        }

        .received,
        .sent {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }

        .received {
            background: #ffffff;
        }

        .sent {
            background: #3bebff;
            float: right;
            text-align: right;
        }

        .message p {
            margin: 5px 0;
        }

        .date {
            color: #777777;
            font-size: 12px;
        }

        .active {
            background: #eeeeee;
        }

        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 15px 0 0 0;
            display: inline-block;
            border-radius: 4px;
            box-sizing: border-box;
            outline: none;
            border: 1px solid #cccccc;
        }

        input[type=text]:focus {
            border: 1px solid #aaaaaa;
        }
    </style>
@endsection

{{-- @extends('layouts.adtheme')

@section('content')
    <div class="d-flex flex-column flex-lg-row">
        <div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
            <div class="card card-flush">
                <div class="card-body pt-5">
                    <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_toolbar, #kt_app_toolbar, #kt_footer, #kt_app_footer, #kt_chat_contacts_header"
                        data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_contacts_body"
                        data-kt-scroll-offset="5px" style="max-height: 1738px;">
                        @foreach ($data_siswa as $siswa)
                            <div class="d-flex flex-stack py-4" id="{{ $siswa->user_id }}">
                                <div class="d-flex align-items-center">
                                    <div class="symbol  symbol-45px symbol-circle">
                                        <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">M</span>
                                    </div>
                                    <div class="ms-5">
                                        <a href="#"
                                            class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">{{ $siswa->nama_mahasiswa }}</a>
                                        <div class="fw-semibold text-muted">{{ $siswa->email }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="d-flex justify-content-center flex-column me-3">
                            <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Message</a>
                            <div class="mb-0 lh-1">
                                <span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
                                <span class="fs-7 fw-semibold text-muted">Active</span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-body" id="kt_chat_messenger_body">
                    <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto" data-kt-element="messages" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_app_toolbar, #kt_toolbar, #kt_footer, #kt_app_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer"
                        data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_messenger_body"
                        data-kt-scroll-offset="5px" style="max-height: 1590px;">
                    </div>
                </div>
                <div class="card-footer pt-4" id="kt_chat_messenger_footer">
                    <textarea class="form-control form-control-flush mb-3" rows="1" data-kt-element="input"
                        placeholder="Type a message"></textarea>
                    <div class="d-flex flex-stack">
                        <button class="btn btn-primary" type="button" data-kt-element="send">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
