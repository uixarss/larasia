@extends('layouts.joliadmin')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="panel-default">
        <div class="panel-heading">
          Add Event
        </div>

        <div class="panel-body">
          <h2>Task : Add Data</h2>
          <form class="" action="{{route('admin.kalenderakademik.store')}}" method="post">
            {{csrf_field()}}
            <label for="">Enter Name of Event</label>
            <input type="text" class="form-control" name="title" placeholder="Enter Name of Event" >

            <label for="">Enter Color</label>
            <input type="color" class="form-control" name="color" placeholder="Enter Collor" >

            <label for="">Enter Strat Date</label>
            <input type="date" class="form-control" name="tanggal_mulai" placeholder="Enter Strat Date" >

            <label for="">Enter End Date</label>
            <input type="date" class="form-control" name="tanggal_akhir" placeholder="Enter End Date">

            <input type="submit" name="submit" class="btn btn-primary" value="Add Event Data">

          </form>

        </div>
      </div>

    </div>

  </div>

</div>

@stop
