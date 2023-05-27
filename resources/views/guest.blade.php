@extends('layouts.guest')

@section('add-css')
<meta name="csrf-token" content="{{ csrf_token() }}">
  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/pivot.min.js"></script> -->


    <!-- load pivot table -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/pivot.min.js" integrity="sha512-XgJh9jgd6gAHu9PcRBBAp0Hda8Tg87zi09Q2639t0tQpFFQhGpeCgaiEFji36Ozijjx9agZxB0w53edOFGCQ0g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/pivot.min.css" integrity="sha512-BDStKWno6Ga+5cOFT9BUnl9erQFzfj+Qmr5MDnuGqTQ/QYDO1LPdonnF6V6lBO6JI13wg29/XmPsufxmCJ8TvQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- end pivot -->

@endsection

@section('content')

<section class="container-fluid py-5" style="margin-top:-20px;">
        <h5 class="mb-3" align="left" style="margin-left: 10px;">Jadwal Hari Ini</h5>
            <div class="row mb-4">
                    <div class="col-md-4">
                       <div id="carouselJadwal" class="carousel slide" data-ride="carousel" style="max-width:100%;height:auto;">  
                            <div class="carousel-inner">    
                                @foreach ($jadwals as $key => $value)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card" style="background:#3C6382; border-radius: 25px;;height:auto;">
                                                <div class="card-body" style="background:#3C6382; border-radius: 25px;">
                                                    <h6 class="card-title" style="padding-left:40px; color: white;">{{$value->Ruang}} / {{$value->Kelas}}</h6>
                                                    <pre><h6 class="card-subtitle mb-2"  style="padding-left:40px; color: white; padding-top: 5px;">{{$value->jadwal}}</h6></pre>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                              <a class="carousel-control-prev" href="#carouselJadwal" data-slide="prev">
                                <span class="carousel-control-prev-icon""></span>
                              </a>
                              <a class="carousel-control-next" href="#carouselJadwal" data-slide="next">
                                <span class="carousel-control-next-icon""></span>
                              </a>
                        </div>

                    </div>
                    <div class="col-md-4">
                       <div id="carousel2" class="carousel slide" data-ride="carousel" style="max-width:100%;height:auto;">  
                            <div class="carousel-inner">    
                                @foreach ($jadwals2 as $key => $value)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card" style="background:#235072; border-radius: 25px;;height:auto;">
                                                <div class="card-body" style="background:#235072; border-radius: 25px;">
                                                    <h6 class="card-title" style="padding-left:40px; color: white;">{{$value->Ruang}} / {{$value->Kelas}}</h6>
                                                    <pre><h6 class="card-subtitle mb-2"  style="padding-left:40px; color: white; padding-top: 5px;">{{$value->jadwal}}</h6></pre>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                              <a class="carousel-control-prev" href="#carousel2" data-slide="prev">
                                <span class="carousel-control-prev-icon""></span>
                              </a>
                              <a class="carousel-control-next" href="#carousel2" data-slide="next">
                                <span class="carousel-control-next-icon""></span>
                              </a>
                        </div>

                    </div>
                    <div class="col-md-4">
                       <div id="carouselJadwal3" class="carousel slide" data-ride="carousel" style="max-width:100%;height:auto;">  
                            <div class="carousel-inner">    
                                @foreach ($jadwals3 as $key => $value)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card" style="background:#0a3d62; border-radius: 25px;;height:auto;">
                                                <div class="card-body" style="background:#0a3d62; border-radius: 25px;">
                                                    <h6 class="card-title" style="padding-left:40px; color: white;">{{$value->Ruang}} / {{$value->Kelas}}</h6>
                                                    <pre><h6 class="card-subtitle mb-2"  style="padding-left:40px; color: white;padding-top: 5px;">{{$value->jadwal }}</h6></pre>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                              <a class="carousel-control-prev" href="#carouselJadwal3" data-slide="prev">
                                <span class="carousel-control-prev-icon""></span>
                              </a>
                              <a class="carousel-control-next" href="#carouselJadwal3" data-slide="next">
                                <span class="carousel-control-next-icon""></span>
                              </a>
                        </div>

                    </div>      
            </div>
    <div class="row mb-4">
        <div class="col-md-6">
                <h5 class="mb-3" align="left" style="margin-left: 10px;">Pengumuman</h5>
                <div id="carouselInfo" class="carousel slide" data-ride="carousel" style="margin-top: -10px; max-width:100%;height:auto;;">  
                    <div class="carousel-inner">    
                        @foreach ($data_pengumuman as $key => $value)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card" style="background:#60a3bc; border-radius: 25px;;height:auto;">
                                        <div class="card-body" style="background:#60a3bc; border-radius: 25px;">
                                            <h4 class="card-title" style="padding-left:60px;">{{$value->judul_pengumuman}}</h4>
                                            <h6 class="card-subtitle mb-2"  style="padding-left:60px; color: white;">{{\Carbon\Carbon::parse($value->tanggal_pengumuman)->format('d M Y')}}</h6>
                                            <p class="card-text"  style="padding-left:60px;">{{$value->isi_pengumuman}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                      <a class="carousel-control-prev" href="#carouselInfo" data-slide="prev">
                        <span class="carousel-control-prev-icon""></span>
                      </a>
                      <a class="carousel-control-next" href="#carouselInfo" data-slide="next">
                        <span class="carousel-control-next-icon""></span>
                      </a>
                </div>
                
        </div>
        <div class="col-md-6">
            <h5 class="mb-3" align="left" style="margin-left: 10px;">Kalendek Akademik</h5>
                <div class="card" style="margin-top: -10px;background-color:#b2e0eb;">
                    <div class="card-body" style="background-color:#b2e0eb; border-radius: 7px;">
                        <div class="calendar" id="calendar" style="height:100%"></div>
                    </div>
                </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function () {

            var SITEURL = "{{ url('/') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({
                editable: false,
                events: SITEURL + "/guest",
                displayEventTime: false,
                editable: false,
                contentHeight: 'auto',
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: false,
                selectHelper: false
               
            });

        });

        function displayMessage(message) {
            toastr.success(message, 'Event');
        } 

        $.ajax({
                    type        : 'ajax',
                    url         : "<?php echo URL::to('/get_jadwal'); ?>",
                    method      : 'get',
                    dataType    : 'json',
                    success     : function(response){
                        $("#table_pivot").pivot(response,{
                            rows: ["Kelas"],
                            cols: ["Ruang"],
                            aggregator: $.pivotUtilities.aggregatorTemplates.listUnique()(["jadwal"]),
                           // aggregator: "List Unique Values",
                           // vals: ["jadwal"],
                            rendererName: "Table",
                            rendererOptions: {table: {rowTotals: false, colTotals: false,}},
                        });
                    },
                    error: function(e) {
                        console.log("Not Found");
                    }
                });

    </script>
</section>

@endsection

@section('add-js')
@endsection
