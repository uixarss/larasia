@extends('layouts.joliadmin')

@section('content')


  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
      <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
      <li class="active">Reminder</li>
  </ul>
  <!-- END BREADCRUMB -->

  <!-- PAGE TITLE -->
  <div class="page-title">
      <h2><span class="fa fa-arrow-circle-o-left"></span>Tambah Reminder</h2>
  </div>
  <!-- END PAGE TITLE -->

  <div class="page-content-wrap">
    <div class="row">
      <div class="col-md-12">

        <!-- START CONTENT FRAME -->
        <div class="content-frame">

          <!-- START CONTENT FRAME TOP -->
          <div class="content-frame-top">
              <div class="page-title">
                  <h2><span class="fa fa-calendar"></span> Calendar</h2>
              </div>
              <div class="pull-right">
                  <button class="btn btn-default content-frame-left-toggle"><span class="fa fa-bars"></span></button>
              </div>
          </div>
          <!-- END CONTENT FRAME TOP -->

          <!-- START CONTENT FRAME LEFT -->
          <div class="content-frame-left">
              <h4>New Event</h4>
              <div class="form-group">
                  <div class="input-group">
                      <input type="text" class="form-control" id="new-event-text" placeholder="Event text..."/>
                      <div class="input-group-btn">
                          <button class="btn btn-primary" id="new-event">Add</button>
                      </div>
                  </div>
              </div>

              <h4>External Events</h4>
              <div class="list-group border-bottom" id="external-events">
                  <a class="list-group-item external-event">Lorem ipsum dolor</a>
                  <a class="list-group-item external-event">Nam a nisi et nisi</a>
                  <a class="list-group-item external-event">Donec tristique eu</a>
                  <a class="list-group-item external-event">Vestibulum cursus</a>
                  <a class="list-group-item external-event">Etiam euismod</a>
                  <a class="list-group-item external-event">Sed pharetra dolor</a>
              </div>

              <div class="push-up-10">
                  <label class="check">
                      <input type="checkbox" class="icheckbox" id="drop-remove"/> Remove after drop
                  </label>
              </div>

              <div class="panel panel-default push-up-10">
                  <div class="panel-body padding-top-0">
                      <h4>Fullcalendar</h4>
                      <p>FullCalendar is a jQuery plugin that provides a full-sized, drag & drop event calendar like the one below. It uses AJAX to fetch events on-the-fly and is easily configured to use your own feed format. It is visually customizable with a rich API.</p>
                  </div>
              </div>
          </div>
          <!-- END CONTENT FRAME LEFT -->

          <!-- START CONTENT FRAME BODY -->
          <div class="content-frame-body padding-bottom-0">
            <div class="row">
              <div class="col-md-12">
                <div id="alert_holder">
                  <div class="calender">
                  <div id="calendar"></div>

                  </div>

                </div>
              </div>

            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
@stop