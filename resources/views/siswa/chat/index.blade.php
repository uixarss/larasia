@extends('layouts.joliadmin-top')

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
@stop

@section('content')


<!-- START BREADCRUMB -->
<ul class="breadcrumb push-down-0">
    <li><a href="{{ route('guru.halamanutama.index') }}">Halaman Utama</a></li>
    <li class="active">Chat Guru</li>
</ul>
<!-- END BREADCRUMB -->

<!-- START CONTENT FRAME -->
<div class="content-frame">
    <!-- START CONTENT FRAME TOP -->
    <div class="content-frame-top">
        <div class="page-title">
            <h2><span class="fa fa-comment"></span> Chat </h2>
        </div>

        <div class="pull-right">
            <a class="btn btn-primary active" href="#chat" role="tab" data-toggle="tab"><span class="fa fa-comment"></span> Chat</a>
            <a class="btn btn-primary" href="#kontak" role="tab" data-toggle="tab"><span class="fa fa-phone"></span> Kontak Siswa</a>
        </div>
    </div>
    <!-- END CONTENT FRAME TOP -->

    <div class="tab-content">

        <div class="tab-pane active" id="chat">
            <div class="content-frame-left">

                <div class="content-frame-top-left">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="fa fa-search"></span>
                        </div>
                        <input id="search" type="text" class="form-control" placeholder="Cari Disini ?">
                        <div class="input-group-btn ">
                            <button class="btn btn-primary">Search</button>
                        </div>
                    </div>

                </div>


                <div class="panel-body mail" style="height: 500px; overflow-y:scroll">

                    <div class="list-group list-group-contacts push-down-10">
                        @foreach($data_guru as $guru)
                        <a href="#" class="list-group-item push-down-10 active" id="{{ $guru->user_id }}">
                            @if($guru->unread)
                            <span class="pending">{{ $guru->unread }}</span>
                            @endif

                            <!-- <div class="border-bottom">
                <div class="mail-date push-up-10 pull-right">Today, 11:21</div>

              </div> -->
                            <div class="list-group-status status-online"></div>
                            <img src="{{asset('admin/assets/images/users/user7.jpg')}}" class="pull-left" alt="Nadia Ali">
                            <span class="contacts-title">{{$guru->nama_dosen}}</span>
                            <p>{{$guru->email}}.</p>

                        </a>
                        @endforeach

                    </div>

                </div>

            </div>
        </div>

        <div class="tab-pane" id="kontak">

            <div class="content-frame-left">

                <div class="content-frame-top-left">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="fa fa-search"></span>
                        </div>
                        <input id="search2" type="text" class="form-control" placeholder="Cari Disini ?">
                        <div class="input-group-btn ">
                            <button class="btn btn-primary">Search</button>
                        </div>
                    </div>

                </div>

                <div class="panel-body mail">
                    <div class="panel panel-default">
                        <div class="panel-heading ui-draggable-handle">
                            <h3 class="panel-title">Kontak Guru</h3>
                        </div>
                        <div class="panel-body list-group list-group-contacts">

                            <a href="{{ route('siswa.chat.index') }}" class="list-group-item">
                                <img src="{{asset('admin/assets/images/users/user5.jpg')}}" class="pull-left" alt="Dmitry Ivaniuk">
                                <!-- <div href="" type="button" class="btn btn-default btn-sm pull-right"><span class="glyphicon glyphicon-send"></span></div> -->
                                <span class="contacts-title">Maman Supratman S.Pd</span>
                                <p>Matematika</p>
                            </a>

                            <a href="{{ route('siswa.chat.index') }}" class="list-group-item">
                                <img src="{{asset('admin/assets/images/users/user3.jpg')}}" class="pull-left" alt="Dmitry Ivaniuk">
                                <!-- <div href="" type="button" class="btn btn-default btn-sm pull-right"><span class="glyphicon glyphicon-send"></span></div> -->
                                <span class="contacts-title">Mimin Kartini S.Pd</span>
                                <p>Biologi</p>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- START CONTENT FRAME BODY -->
    <div class="content-frame-body" id="messages">

    </div>

    <!-- <div class="panel panel-default push-up-10">
        <div class="panel-body panel-body-search">
            <div class="input-group">
                <div class="input-group-btn">
                    <button class="btn btn-default"><span class="fa fa-camera"></span></button>
                    <button class="btn btn-default"><span class="fa fa-chain"></span></button>
                </div>
                <input type="text" class="form-control" placeholder="Your message...">
                <div class="input-group-btn">
                    <button class="btn btn-default">Send</button>
                </div>
            </div>
        </div>
    </div> -->

</div>
<!-- END CONTENT FRAME BODY -->
</div>
<!-- END CONTENT FRAME -->

@stop

@section('data-scripts')
<script type="text/javascript" src="https://js.pusher.com/6.0/pusher.min.js"></script>

<script type="text/javascript">
    var $searchBox = $('#search');
    var $userDivs = $('.list-group-item');

    $searchBox.on('input', function() {
      var scope = this;
      if (!scope.value || scope.value == '') {
        $userDivs.show();
        return;
      }

      $userDivs.each(function(i, div) {
        var $div = $(div);
        var $div_title = $(div).find('.contacts-title');
        var str = $div_title.text().toUpperCase();
        if(str.indexOf(scope.value.toUpperCase()) >= 0){
            $div.show();
        }else{
            $div.hide();
        }
        // $div.toggle($div.text().toLowerCase().indexOf(scope.value.toLowerCase()) > -1);
      })
    });
</script>

<script type="text/javascript">
    var $searchBox = $('#search2');
    var $userDivs = $('.list-group-item');

    $searchBox.on('input', function() {
      var scope = this;
      if (!scope.value || scope.value == '') {
        $userDivs.show();
        return;
      }

      $userDivs.each(function(i, div) {
        var $div = $(div);
        var $div_title = $(div).find('.contacts-title');
        var str = $div_title.text().toUpperCase();
        if(str.indexOf(scope.value.toUpperCase()) >= 0){
            $div.show();
        }else{
            $div.hide();
        }
        // $div.toggle($div.text().toLowerCase().indexOf(scope.value.toLowerCase()) > -1);
      })
    });
</script>

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
            // console.log(receiver_id);
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
@stop